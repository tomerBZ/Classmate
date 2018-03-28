@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                ClassMates
            </div>
            @if (session()->has('msg'))
                <div class="alert alert-{{ session()->get('msg')['status'] }}">
                    {{ session()->get('msg')['body'] }}
                </div>
            @endif
            @guest
                @forelse ($users['users'] as $user)
                    <p>{{ $user->name }}</p>
                @empty
                    <h4>There Are No Classmates Yet</h4>
                @endforelse
            @else
            @forelse ($users['users'] as $user)
                    <div class="d-flex justify-content-center align-items-baseline">
                        <p>{{ $user->name }}</p>
                        <form method="POST" action="{{ route('add.friend', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-light" style="background-color: transparent;border: none"><i class="material-icons">add_circle_outline</i></button>
                        </form>
                    </div>
                @empty
                    <p>All your classmates are on your friends list</p>
                @endforelse
                <h3>Friends List</h3>
                @forelse ($users['friends'] as $friend)
                    <div>
                        <p>{{ $friend->name }}</p>
                    </div>
                @empty
                    <p>You don't have any friends yet</p>
                @endforelse
                <h3>Pending Friend Requests</h3>
                @forelse ($users['notFriendsYet'] as $friend)
                    <div>
                        <p>{{ $friend->name }}</p>
                    </div>
                @empty
                    <p>You don't have any pending requests</p>
                @endforelse
                <h3>Friend Requests</h3>
                @forelse ($users['friendRequests'] as $friend)
                    <div class="d-flex justify-content-center align-items-baseline">
                        <p>{{ $user->name }}</p>
                        <form method="POST" action="{{ route('approve.friend', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-light" style="background-color: transparent;border: none"><i class="material-icons">check</i></button>
                        </form>
                    </div>
                @empty
                    <p>You don't have any pending requests</p>
                @endforelse
            @endguest
        </div>
    </div>
@endsection
