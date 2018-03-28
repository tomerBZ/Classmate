@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @forelse($posts as $post)
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="left">
                                <b>{{ $post->user->name }}</b>
                            </div>
                            <div class="right">
                                <small>Posted At: {{ $post->created_at }}</small>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5>{{ $post->title}}</h5>
                            <p>{{ $post->content}}</p>
                        </div>
                    </div>
                @empty
                    <p>No Posts Yet</p>
                @endforelse
            </div>
            <div class="col-md-4">
                @if (session()->has('msg'))
                    <div class="alert alert-{{ session()->get('msg')['status'] }}">
                        {{ session()->get('msg')['body'] }}
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-header">Add New Post</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('create.post')}}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title"
                                       placeholder="Post Title">
                                @if ($errors->has('title'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="content">Content</label>
                                <textarea name="content" class="form-control{{ $errors->has('content') ? ' is-invalid' : '' }}" id="content"
                                          placeholder="Post Title"></textarea>
                                @if ($errors->has('content'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button class="btn btn-dark">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
