<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PollController extends Controller
{
    // Get all polls (with pagination & latest first)
    public function index()
    {
        $polls = Poll::withCount('votes')
            ->orderByDesc('created_at')
            ->paginate(10);

        return response()->json($polls);
    }

    // Get active polls (not expired)
    public function active()
    {
        $polls = Poll::where('expires_at', '>', now())
            ->orderByDesc('created_at')
            ->withCount('votes')
            ->paginate(10);

        return response()->json($polls);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string',
            'category_id'   => 'nullable|exists:categories,id',
            'is_anonymous'  => 'nullable|boolean',
            'expires_at'    => 'nullable|date|after:now',
            'options'       => 'required|array|min:2|max:10',
            'options.*'     => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            $poll = Poll::create([
                'user_id'      => Auth::id() ?? 1,
                'category_id'  => $request->category_id,
                'title'        => $request->title,
                'description'  => $request->description,
                'is_anonymous' => $request->boolean('is_anonymous') ?? true,
                'expires_at'   => $request->expires_at ?? now()->addDays(7),
                'public_id'    => Str::uuid()->toString(), // generate UUID
            ]);

            foreach ($request->options as $optionText) {
                $poll->options()->create([
                    'text' => $optionText // ✅ correct column name
                ]);
            }

            DB::commit();

            return response()->json([
                'message' => 'Poll created successfully',
                'poll'    => $poll->load('options')
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => 'Something went wrong. Please try again.',
                'debug' => $e->getMessage()
            ], 500);
        }
    }

    // Get single poll details (with vote counts per option)
    public function show($id)
    {
        $poll = Poll::with('votes')->findOrFail($id);

        // Aggregate vote counts per option
        $results = $poll->votes->groupBy('option')->map->count();

        return response()->json([
            'poll'    => $poll->only(['id', 'question', 'options', 'expires_at']),
            'results' => $results,
        ]);
    }

    public function pollResults($pollId)
    {
        $poll = Poll::with('options.votes')->findOrFail($pollId);

        $results = $poll->options->map(function ($option) {
            return [
                'option' => $option->option_text,
                'votes' => $option->votes->count()
            ];
        });

        return response()->json($results);
    }

    public function results($publicId)
    {
        $poll = Poll::with('options')->where('public_id', $publicId)->firstOrFail();
        // Prepare results with option text and vote count
        $results = $poll->options->map(function ($option) {
            return [
                'option' => $option->text,
                'votes' => $option->votes_count, // Assuming votes_count is a column in options table
            ];
        });

        $response =  response()->json([
            'poll' => [
                'id' => $poll->id,
                'question' => $poll->title,
            ],
            'results' => $results,
        ]);

        // dd($response);

        return $response;
    }

    public function publicPoll($publicId)
    {
        $poll = Poll::with('options.votes')
            ->where('public_id', $publicId)
            ->first();

        if (!$poll) {
            return response()->json(['error' => 'Poll not found.'], 404);
        }

        $hasVoted = Vote::where('poll_id', $poll->id)
            ->where('voter_ip', request()->ip())
            ->exists();

        // Prepare results (only if poll is closed)
        $results = null;
        if (!$poll->is_closed) {
            $results = $poll->options->map(function ($option) {
                return [
                    'option' => $option->text,
                    'votes' => $option->votes_count,
                ];
            });
        }

        return response()->json([
            'poll' => [
                'question'    => $poll->title,
                'description' => $poll->description,
                'is_active'   => $poll->is_active,
                'created_at'  => $poll->created_at,
            ],
            'options' => $poll->options->map(function ($option) {
                return [
                    'id'   => $option->id,
                    'text' => $option->text,
                ];
            }),
            'results' => $results,
            'has_voted' => $hasVoted,
        ]);
    }

    public function closePoll($id)
    {
        $poll = Poll::where('user_id', auth()->id())->findOrFail($id);
        $poll->update(['is_closed' => true]);
        return response()->json(['message' => 'Poll closed']);
    }

    public function getByCategory($id)
    {
        $polls = Poll::with('category')
            ->where('category_id', $id)
            ->latest()
            ->get()
            ->map(function ($poll) {
                $poll->created_diff = $poll->created_at->diffForHumans();
                return $poll;
            });

        return response()->json($polls);
    }
}
