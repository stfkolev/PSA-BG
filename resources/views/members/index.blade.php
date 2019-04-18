@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Participants</div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Registered</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>
                                        <a href="/profile/{{ isset($user->customurl) ? $user->customurl : $user->id }}">
                                            <img src="{{ $user->avatar }}" alt="avatar" class="rounded card-subtitle" style="max-width:2rem;max-height: 2rem;">
                                            {{ $user->name }}
                                        </a>
                                </td>
                               
                                <td>
                                        @if($user->roles->count() > 1)
                                            @foreach($user->roles as $role) 
                                                {{ $role->display_name . ' ' }}
                                            @endforeach
                                        @else
                                            {{ $user->roles[0]->display_name }}
                                        @endif
                                </td>
                                <td>{{ $user->created_at->DiffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
