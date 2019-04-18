@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h3>My Discussions</h3>

                <div class="card">
                    @foreach ($discussions as $discussion)
                    <article class="card-body">
                        <h6 class="card-subtitle float-right">Created {{ $discussion->created_at->diffForHumans() }}</h6>
                        <h4 class="card-title"> <a href="{{ $discussion->path() }}">{{ $discussion->title }}</a> </h4>

                        <h5 class="card-text">{{ str_limit($discussion->body, 25) }}</h5>
                        <h6 class="card-subtitle float-left"><b>Category: </b>{{ $discussion->category->name }}</h6>
                        <br>
                        <h6 class="card-subtitle">Answers: {{ $discussion->answers()->count() }}</h5>
                    </article>
                    <hr>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
@endsection