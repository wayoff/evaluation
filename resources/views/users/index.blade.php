@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Users</div>

        <div class="panel-body">
            <div class="pull-right">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    Create
                </a>
            </div>
            <table class="table-striped table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td> {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->username }} </td>
                            <td> {{ $user->user_type }} </td>
                            <td>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="form-inline form-delete" role="form">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-xs">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            {!! $users->render() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
