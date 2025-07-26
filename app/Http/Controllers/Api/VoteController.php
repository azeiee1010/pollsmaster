<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{
    public function vote(Request $request)
    {
        $validated = $request->validate([
            'option_id' => 'required|exists:options,id',
        ]);

        // Fetch the selected option with its poll
        $option = Option::with('poll')->findOrFail($validated['option_id']);
        $poll = $option->poll;

        // Check if poll is expired
        if ($poll->expires_at && $poll->expires_at < now()) {
            return response()->json(['error' => 'This poll has expired'], 403);
        }

        // Use IP for duplicate check
        $voterIp = $request->ip();

        // Attempt to insert the vote (catch duplicate using DB constraint)
        try {
            DB::transaction(function () use ($poll, $option, $voterIp) {
                Vote::create([
                    'poll_id'   => $poll->id,
                    'option_id' => $option->id,
                    'voter_ip'  => $voterIp,
                    'user_id'   => auth()->id(), // null if guest
                ]);

                // Increment option vote count
                $option->increment('votes_count');
            });
        } catch (\Illuminate\Database\QueryException $e) {
            if (str_contains($e->getMessage(), 'votes_poll_id_voter_ip_unique')) {
                return response()->json(['error' => 'You have already voted in this poll'], 403);
            }
            return response()->json(['error' => 'Vote failed.'], 500);
        }

        // Return updated poll results
        $options = Option::where('poll_id', $poll->id)->get(['text', 'votes_count']);

        return response()->json([
            'message' => 'Vote submitted successfully',
            'results' => $options->map(function ($opt) {
                return [
                    'option' => $opt->text,
                    'votes'  => $opt->votes_count,
                ];
            })
        ], 201);
    }
}
