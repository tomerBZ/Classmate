<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StoreRequest;
use App\Models\User;
use App\Rules\AlphaSpaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function addFriend(User $user)
    {
        Auth::user()->addFriend($user->id);

        return redirect()->back()->with('msg', [
            'status' => 'success',
            'body'   => 'You have added a new fried'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show()
    {
        return view('editProfile', ['user' => Auth::user()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request)
    {
        $request->validate([
            'name'     => ['nullable', new AlphaSpaces],
            'email'    => 'nullable|email|unique:users,email,'. Auth::user()->id,
            'class'    => 'nullable|numeric',
            'birthday' => 'nullable|date_format:Y-m-d'
        ]);
        $user = Auth::user();
        $user->update($request->all());

        return redirect()->back()->with('msg', [
            'status' => 'success',
            'body'   => 'You have update your details'
        ]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy()
    {
        $user = Auth::user();
        Auth::logout();
        $user->posts()->delete();
        $user->delete();

        return redirect('/');
    }

    public function approveFriend(User $user)
    {
        $connectedUser = Auth::user();
        $connectedUser->addAndApproveFriendRequest($user->id);
        $user->removeFriend($connectedUser->id);
        $user->addAndApproveFriendRequest($connectedUser->id);
        return redirect()->back()->with('msg', [
            'status' => 'success',
            'body'   => 'You have added a new friend'
        ]);
    }
}
