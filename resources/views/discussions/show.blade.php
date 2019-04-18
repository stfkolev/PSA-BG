    
@extends('layouts.app')

@section('content')
    <div class="container">
        
        <div class="row justify-content-left">
            <a href="{{ url()->previous() }}">Back</a>
        </div>
        <br>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <h4 class="card-header">{{ $discussion->title }}</h4>

                    <div class="card-body">
                            <img src="{{ $discussion->user->avatar }}" alt="avatar" class="rounded card-subtitle" style="max-width:2rem;max-height: 2rem;">
                            <a class="card-subtitle" href="/profile/{{ isset($discussion->user->customurl) ? $discussion->user->customurl : $discussion->user->id }}">{{ $discussion->user->name }}</a> posted
                            
                            <span class="card-subtitle float-right"> {{ $discussion->created_at->diffForHumans() }}</span>
                        </div>
    
                        <div class="card-body">
                            
                            <div class="card-title">
                                {{ $discussion->body }}
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @foreach ($discussion->answers as $answer)
                    @include('discussions.answer')
                @endforeach
            </div>
        </div>

        @if (Auth::check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="POST" action="{{ $discussion->path() . '/answers' }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                        </div>

                        <button type="submit" class="btn btn-default">Answer</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in this discussion.</p>
        @endif
    </div>
@endsection