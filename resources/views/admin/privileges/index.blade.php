@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="card">
                    <div class="card-header">All privilegies</div>

                    <div class="card-body">
                           
                            <a href="{{ url('/admin/privileges/add')}}" class="btn btn-primary row float-right">Add</a>
                            
                            <br>
                            <br>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Privilege Display Name</th>
                                        <th>Privilege Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($privilegies as $privilege)
                                    <tr>
                                        <td>{{ $privilege->display_name}}</td>
                                        <td>{{ $privilege->name }}</td>
                                        <td>{{ $privilege->description }}</td>
                                        <td>Delete</td>
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