@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session()->has('msg'))
                    <div class="alert alert-{{ session()->get('msg')['status'] }}">
                        {{ session()->get('msg')['body'] }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3>My Profile</h3>
                        <a href="{{ route('my.profile') }}" class="btn btn-light"><i class="material-icons">undo</i></a>
                    </div>
                    <div class="card-body">
                        <form action="{{route('edit.profile')}}" method="POST">
                            @method('PUT')
                            @csrf
                            <div class="form-group row">
                                <label for="name"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Full Name') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                           name="name" value="{{ $user->name }}" required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="class"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Class Number') }}</label>
                                <div class="col-md-6">
                                    <input id="class" type="text"
                                           class="form-control{{ $errors->has('class') ? ' is-invalid' : '' }}"
                                           name="class" value="{{ $user->class }}" required>

                                    @if ($errors->has('class'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('class') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="birthday"
                                       class="col-md-3 col-form-label text-md-right">{{ __('Birthday') }}</label>
                                <div class="col-md-6">
                                    <input id="birthday" type="date"
                                           class="form-control{{ $errors->has('birthday') ? ' is-invalid' : '' }}"
                                           name="birthday" value="{{ $user->birthday }}" required>

                                    @if ($errors->has('birthday'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('birthday') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
