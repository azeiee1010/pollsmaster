<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PollController extends Controller
{
    //

    public function categoryPage($id)
    {
        return view('polls.category', ['categoryId' => $id]);
    }

    public function userPollPage()
    {
        return view('polls.userPoll');
    }
}
