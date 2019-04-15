@extends('layouts.app')

@section('content')
<div class="container target">
    <div class="row">
        <div class="col-sm-3">

            <!--left col-->
            <div class="card">
            <img class="card-img-top" src="{{ $user[0]->avatar }}" alt="{{ $user[0]->name }} avatar" />

                <div class="card-body">
                    <h5 class="card-title">{{ $user[0]->name }}</h5>
                    <p class="card-text">
                        
                       @if(isset($user[0]->description))
                            {{ $user[0]->description }}
                       @else
                            No description set.
                       @endif
                    </p>
                </div>

                <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span class="float-left">Shots</span> <span class="float-right"> {{ count($user[0]->shots) }}</span></li>
                    <li class="list-group-item">Likes</li>
                    <li class="list-group-item">Topics</li>
                    <li class="list-group-item"><span class="float-left">Requests</span> <span class="float-right"> {{ count($user[0]->requests) }}</span></li>
                    <li class="list-group-item"><span class="float-left">Replies</span> <span class="float-right"> {{ count($user[0]->replies) }} </span></li>
                </ul>

                <div class="card-body">
                    <a href="#" class="btn btn-primary float-left">Message</a>
                    <a href="#" class="btn btn-secondary float-right">Friend</a>
                </div>
            </div>
        </div>
        <!--/col-3-->
        <!-- http://lorempixel.com/600/200/sports -->
        <div class="col-sm-9" style="" contenteditable="false">
            <div class="card">
                <div class="card-body">
                    <h5 class="d-flex card-title justify-content-center">Activity</h5>
                </div>
            </div>
            
            <br>
            <div class="card-columns">
                @foreach ($user[0]->shots as $shot)
                <div class="card">
                        <a href="/shot/{{ $shot->id }}"><img class="card-img-top" src="{{ $shot->image }}" alt="Card image cap" style="max-width: 18rem; max-height:18rem;"></a>

                    <div class="card-body">

                        <h5 class="card-title">{{ $shot->title }}</h5>
                        <p class="card-text">{{ $shot->description }}.</p>
                    
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
