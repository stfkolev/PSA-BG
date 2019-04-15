@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
    <a href="{{ url()->previous() }}">Back</a>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <a href="/shot/{{ $shot[0]->id }}"><img class="card-img-top" src="{{ $shot[0]->image }}" alt=""></a>

                <div class="card-body">

                    <h5 class="card-title">{{ $shot[0]->title }}</h5>
                    <p class="card-text"> {{ $shot[0]->description }}</p>

                    <a href="/profile/{{ isset($shot[0]->user->customurl) ? $shot[0]->user->customurl : $shot[0]->user->id }}" class="card-link float-right">{{ $shot[0]->user->name }}</a>
                </div>
            </div>
        </div>
    </div>

   
</div>
@endsection
