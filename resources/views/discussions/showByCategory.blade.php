@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 ">
                <h3>Discussions</h3>

                <div class="card">
                    <div class="card-body">
                        @if($discussions->count() > 0)
                        
                            @foreach ($discussions as $discussion)

                                <article class="card-text">
                                    <h6 class="card-subtitle float-right">Created {{ $discussion->created_at->diffForHumans() }}</h6>

                                    <h4 class="card-title"><a href="{{ $discussion->path() }}">{{ $discussion->title }}</a></h4>

                                    <h5 class="card-title">{{ str_limit($discussion->body, 10) }}</h5>

                                    <h5 class="card-subtitle">Answers: {{ $discussion->answers()->count() }}</h5>
                            
                                </article>
                            
                            @endforeach

                        @else
                        <h5 class="card-title">There are no discussions in this category!<h5>
                        @endif
                    </div>
                </div>
            </div>

           @include('discussions.categories.categories')
           
        </div>
    </div>
@endsection