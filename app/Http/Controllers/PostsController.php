<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\Posts;
use App\Rules\AlphaSpaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts', ['posts' => Auth::user()->posts()->latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(StoreRequest $request)
    {
        $new_post = Posts::create([
            'user_id' => Auth::user()->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);
        if ($new_post) {
            return redirect()->back()->with('msg', [
                'status' => 'success',
                'body' => 'You\'re post had been added!'
            ]);
        }
    }
}
