<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Poll;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $polls = Poll::latest()->limit(10)->get();

        return view('dashboard.index', compact('categories', 'polls'));
    }
}
