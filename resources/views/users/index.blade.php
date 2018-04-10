@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            Users
        </div>

        <div class="panel-body">
            <div class="col-md-5">
                <form action="/users/import" method="POST" class="form-inline" role="form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="sr-only" for="">label</label>
                        <input type="file" class="form-control" name="list" placeholder="Choose a file">
                    </div>
                
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
            <div class="col-md-4">
                <form action="/users" method="get" class="form-inline" style="margin-bottom: 10px;" role="form">
                
                    <div class="form-group">
                        <label class="sr-only" for="">Search</label>
                        <input type="text" class="form-control" name="q" placeholder="Search">
                    </div>
                
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-md-3 text-right">
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    Create
                </a>
                <a href="/users/students/delete" class="btn btn-danger btn-del-students">
                    Delete All Students
                </a>
            </div>
            <table class="table-striped table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Type</th>
                        <th>Trimester</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($users->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">
                                No user was found
                            </td>
                        </tr>
                    @endif
                    @foreach($users as $user)
                        <tr>
                            <td> {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }} </td>
                            <td> {{ $user->name }} </td>
                            <td> {{ $user->username }} </td>
                            <td> {{ $user->user_type }} </td>
                            <td> {{ $user->trimester }} </td>
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

@section('scripts')
    <script>
        $( function() {
            $('.btn-del-students').on('click', function(e) {
                if (confirm('Are you sure to delete all students? ')) {
                    return true;
                }

                e.preventDefault()
            })
        });
    </script>
@stop
