@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-header">Add role</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.store') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="displayName">Role Display Name:</label>
                                <input type="text" class="form-control{{ $errors->has('displayName') ? ' is-invalid' : '' }}" id="displayName" name="displayName">
                                
                                @if ($errors->has('displayName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('displayName') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Role Name:</label>
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name">
                                
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea name="description" id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" rows="8"></textarea>
                                
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection