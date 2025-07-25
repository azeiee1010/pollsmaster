<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'poll_id' => 'required|exists:polls,id',
            'option'  => 'required|string',
        ]);

        $poll = Poll::findOrFail($validated['poll_id']);

        // Check poll expiration
        if ($poll->expires_at && $poll->expires_at < now()) {
            return response()->json(['error' => 'This poll has expired'], 403);
        }

        // Check if the option is valid
        if (!in_array($validated['option'], $poll->options)) {
            return response()->json(['error' => 'Invalid option selected'], 422);
        }

        $voterIp = $request->ip();

        // Prevent duplicate votes by IP
        $alreadyVoted = Vote::where('poll_id', $poll->id)
            ->where('voter_ip', $voterIp)
            ->exists();

        if ($alreadyVoted) {
            return response()->json(['error' => 'You have already voted in this poll'], 403);
        }

        // Create the vote
        $vote = Vote::create([
            'poll_id'  => $poll->id,
            'option'   => $validated['option'],
            'voter_ip' => $voterIp,
            'user_id'  => auth()->check() ? auth()->id() : null,
        ]);

        return response()->json([
            'message' => 'Vote submitted successfully',
            'vote'    => $vote,
        ], 201);
    }
}
