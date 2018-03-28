<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = collect(new Posts);
        $friendsWithPosts = Auth::user()->friends()->with('posts.user')->get();

        if ($friendsWithPosts->isNotEmpty() || Auth::user()->posts()->get()->isNotEmpty()) {
            foreach ($friendsWithPosts as $friend) {
                $posts = $posts->merge($friend->posts);
            }
            $posts = $posts->merge(Auth::user()->posts()->get())->sortByDesc('created_at');
        }

        return view('home', ['posts' => $posts]);
    }
}
