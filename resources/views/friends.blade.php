@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>My Profile</h3>
                        <div class="actions d-flex justify-content-center align-items-center">
                            <a href="{{ route('show.profile') }}" class="btn btn-light"><i class="material-icons">mode_edit</i></a>
                            <form action="{{ route('destroy.profile') }}" method="get">
                                <button type="submit" class="btn btn-light"><i class="material-icons">delete_forever</i></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><label>Full Name:</label>  {{ $user->name}}</p>
                        <p><label>Email:</label> {{ $user->email}}</p>
                        <p><label>Class Number:</label> {{ $user->class}}</p>
                        <p><label>Birthday:</label> {{ $user->birthday}}</p>
                        <p><label>Member Since</label> {{ $user->created_at->todatestring()}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
