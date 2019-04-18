@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Categories</div>

                    <div class="panel-body">
                        @foreach ($categories as $category)
                            <article>
                                <h4>
                                    <a href="{{ $category->path() }}">
                                        {{ $category->name }}
                                    </a>
                                </h4>
                                <div class="body">{{ $category->description }}</div>
                            </article>

                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection