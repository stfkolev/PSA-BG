@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card">
                    <div class="card-header">All roles</div>

                    <div class="card-body">
                           
                            <a href="{{ route('roles.create') }}" class="btn btn-primary row float-right">Add</a>
                            
                            <br>
                            <br>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Role Display Name</th>
                                        <th>Role Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{ $role->display_name}}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>{{ $role->description }}</td>
                                        <td><a href="{{ route('roles.permissions', $role->id) }}">Permissions</a></td>
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