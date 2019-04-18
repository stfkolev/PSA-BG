@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(count($shots) > 0)

            <div class="card-columns">
                @foreach($shots as $shot)
                
                  <a href="{{ route('shots.view', $shot->id) }}" class="text-white "> <div class="card text-white" style="max-width: 18rem; max-height: 20rem">
                   <img class="card-img-top" src="{{ $shot->image }}" alt="">
                   
                        <div class="card-img-overlay">
    
                            <h5 class="card-title">{{ $shot->title }}</h5>
                            <p class="card-text"> {{ $shot->description }}</p>

                            
                        </div>
                    </div>
                </a>

                @endforeach
            </div>

            @else
                <span class="d-flex justify-content-center">You have no shots!</span>
            @endif
        </div>
    </div>
</div>
@endsection
