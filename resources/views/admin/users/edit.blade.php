@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User #{{ $user->id }}</div>
                <div class="card-body">
                        <form method="POST" action="{{ route('users.save', $user->id) }}">
                                {{ csrf_field() }}
    
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="{{ $user->name }}">
                                    
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" placeholder="{{ $user->email }}">
                                    
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password">New password:</label>
                                    <input type="password" class="form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="@for($i = 0; $i < strlen($user->password) / 2.5; $i++)&#9679;@endfor">
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="password_confirmation">Confirm password:</label>
                                    <input type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" name="password_confirmation" placeholder="@for($i = 0; $i < strlen($user->password) / 2.5; $i++)&#9679;@endfor">
                                    
                                    @if ($errors->has('password_confirmation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="created_at">Created at:</label>
                                    <input type="text" class="form-control{{ $errors->has('created_at') ? ' is-invalid' : '' }}" id="created_at" name="created_at" placeholder="{{ $user->created_at }}" disabled>
                                    
                                    @if ($errors->has('created_at'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('created_at') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="updated_at">Updated at:</label>
                                    <input type="text" class="form-control{{ $errors->has('updated_at') ? ' is-invalid' : '' }}" id="updated_at" name="updated_at" placeholder="{{ $user->updated_at }}" disabled>
                                    
                                    @if ($errors->has('updated_at'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('updated_at') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="description">Description:</label>
                                    <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="8" placeholder="{{ $user->description ?: 'No description set' }}"></textarea>
                                    
                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label for="custom_url">Custom URL:</label>
                                    <input type="text" class="form-control{{ $errors->has('custom_url') ? ' is-invalid' : '' }}" id="custom_url" name="custom_url" placeholder="{{ $user->customurl ?: 'Not set' }}">
                                    
                                    @if ($errors->has('custom_url'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('custom_url') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
