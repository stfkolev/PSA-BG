@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a New Discussion</div>

                    <div class="panel-body">
                        <form method="POST" action="/discussions">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title">

                                @if ($errors->has('title'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                    <label for="category_id">Category:</label>
                                    <select class="form-control" id="category_id" name="category_id">
                                        @foreach($categories as $category)
                                         <option>{{ $category->name }}</option>
                                         @endforeach
                                    </select>
                                </div>

                            <div class="form-group">
                                <label for="body">Body:</label>
                                <textarea name="body" id="body" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" rows="8"></textarea>

                                @if ($errors->has('body'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection