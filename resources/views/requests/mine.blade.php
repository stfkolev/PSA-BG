@extends('layouts.app')

@section('content')
<div class="container">

    
    <div class="row justify-content-center">
        @foreach ($requests as $request)
        <div class="col-md-4">
            
            <div class="card">
                <a href="/profile/{{ isset($request->user->customurl) ? $request->user->customurl : $request->user->id }}"><img class="card-img-top" width="18rem" src="{{ $request->user->avatar }}" alt="{{ $request->user->name}} avatar">
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"> <span class="float-left">Type:</span> <span class="float-right">{{ $request->type }}</span> </li>
                    <li class="list-group-item float-left"> <span class="float-left">Topic:</span> <span class="float-right">{{ $request->topic }}</span> </li>
                    <li class="list-group-item"><span class="float-left">Created: </span> <span class="float-right">{{ $request->created_at->diffForHumans() }}</span> </li>
                </ul>

                <div class="card-body">
                    <a href="{{ route('requests.view', $request->id) }}" class="btn btn-primary float-right">View</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection
