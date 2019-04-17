    @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Discussions</div>

                    <div class="panel-body">
                        @foreach ($discussions as $discussion)
                            <article>
                                <h4>
                                    <a href="{{ $discussion->path() }}">
                                        {{ $discussion->title }}
                                    </a>
                                </h4>
                                <div class="body">{{ $discussion->body }}</div>
                            </article>

                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection