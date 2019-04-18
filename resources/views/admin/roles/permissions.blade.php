@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card">
                <div class="card-header">Permissions for {{ $role->display_name }}</div>

                    <div class="card-body">
                            <form method="POST" action="{{ route('roles.storePermissions', $role->id) }}">
                                @csrf()
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Privilege Display Name</th>
                                        <th>Allow</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($privilegies as $privilege)
                                    <tr>
                                        <td>{{ $privilege->display_name}}</td>

                                        <td>
                                           
                                                <input type="checkbox" name="role_privilegies[]" value="{{ $privilege->name }}" {{ $role->hasPermission($privilege->name) ? 'checked' : '' }}>
                                           
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table> 
                            
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection