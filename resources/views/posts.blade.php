@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse($posts as $post)
                <div class="card mb-4">
                    <div class="card-header"><b>Me:</b> {{ $post->title}} </div>
                    <div class="card-body">
                        <p>{{ $post->content}}</p>
                    </div>
                    <div class="card-footer">
                        <p>{{ $post->created_at}}</p>
                    </div>
                </div>
            @empty
                <p>No Posts</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
