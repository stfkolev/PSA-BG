@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <a href="{{ url()->previous() }}">Back</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Request #{{ $request[0]->id }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="card-body">
                        <p>Size: <strong>{{ $request[0]->size }}</strong></p>
                        <p>Type: <strong>{{ $request[0]->type }}</strong></p>
                        <p>Topic: <strong>{{ $request[0]->topic }}</strong></p>
                        <p>More: <strong>{{ $request[0]->more }}</strong></p>

                        <p>Posted by <a href="/profile/{{ isset($request[0]->user->customurl) ? $request[0]->user->customurl : $request[0]->user->id }}">{{ $request[0]->user->name }}</a> - {{ $request[0]->created_at->diffForHumans() }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
    @if($request[0]->user->id === Auth::user()->id)
   
        <div class="row justify-content-center">
            <div class="col-md-8">
                <center><h5>You cannot reply to your own request!</h5></center>
            </div>
        </div>
    @else
    @permission('manage-requests')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Your reply 
                </div>

                <div class="card-body">
                    <form method="POST" id="replyform" action="{{ route('requests.reply', $request[0]->id) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image:') }}</label>
                            
                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" required>
                                
                                @if ($errors->has('image'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reply') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <br>
    @endpermission
    @endif

    @foreach($request[0]->replies as $reply)
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> <a href="/profile/{{ isset($reply->user->customurl) ? $reply->user->customurl : $reply->user->id }}">{{ $reply->user->name }} </a> replied </div>

                <div class="card-text">
                    <img src="{{ $reply->image }}" alt="" class="d-flex justify-content-center" style="margin: 1rem; max-width: 18rem;max-height: 18rem;"/>
                </div>
            </div>
        </div>
    </div>

    <br>
    @endforeach
</div>


@endsection
