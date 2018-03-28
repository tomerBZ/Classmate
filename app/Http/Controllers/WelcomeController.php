<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users['users'] = User::where('id', '!=', Auth::id())->get();
        if (Auth::check()) {
            $users['friendRequests'] = Auth::user()->FriendRequests()->get();
            $users['friends'] = Auth::user()->friends()->get();

            if ($users['friends']->isNotEmpty()) {
                $users['users'] = $users['users']->diff($users['friends']);
            }

            $users['notFriendsYet'] = Auth::user()->unapprovedFriends()->get();
            if ($users['notFriendsYet']->isNotEmpty()) {
                $users['users'] = $users['users']->diff($users['notFriendsYet']);
            }
        }

        return view('welcome', ['users' => $users]);
    }
}
