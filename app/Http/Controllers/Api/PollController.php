<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

    // Create a new poll
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question'    => 'required|string|max:255',
            'options'     => 'required|array|min:2|max:10',
            'options.*'   => 'required|string|max:100',
            'expires_at'  => 'nullable|date|after:now',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $poll = Poll::create([
            'user_id'    => Auth::id(),
            'question'   => $request->question,
            'options'    => $request->options,
            'expires_at' => $request->expires_at,
        ]);

        return response()->json([
            'message' => 'Poll created successfully',
            'poll'    => $poll
        ], 201);
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

    public function results($pollId)
    {
        $poll = Poll::with('options')->findOrFail($pollId);

        // Prepare results with option text and vote count
        $results = $poll->options->map(function ($option) {
            return [
                'option' => $option->text,
                'votes' => $option->votes->count(),
            ];
        });

        return response()->json([
            'poll' => [
                'id' => $poll->id,
                'question' => $poll->question,
            ],
            'results' => $results,
        ]);
    }


    public function publicPoll($publicId)
    {
        $poll = Poll::with('options.votes')
            ->where('public_id', $publicId)
            ->first();

        if (!$poll) {
            return response()->json(['error' => 'Poll not found.'], 404);
        }

        // Prepare results (only if poll is closed)
        $results = null;
        if (!$poll->is_active) {
            $results = $poll->options->map(function ($option) {
                return [
                    'option' => $option->text,
                    'votes' => $option->votes->count(),
                ];
            });
        }

        return response()->json([
            'poll' => [
                'question'    => $poll->question,
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
        ]);
    }


    public function closePoll($id)
    {
        $poll = Poll::where('user_id', auth()->id())->findOrFail($id);
        $poll->update(['is_closed' => true]);
        return response()->json(['message' => 'Poll closed']);
    }
}
