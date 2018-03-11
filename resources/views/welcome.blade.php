@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="{{ !auth()->guest() ? 'col-md-12' : 'col-md-8' }}">
                <div class="panel panel-primary">
                    <div class="panel-heading">On-going evaluation</div>

                    <div class="panel-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    @if(!auth()->guest() && auth()->user()->user_type == 'student')
                                        <th>PROFESSOR'S NAME</th>
                                    @endif
                                    <th>TITLE</th>
                                    <th>START DATE</th>
                                    <th>END DATE</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($forms as $form)
                                <tr>
                                    @if(!auth()->guest() && auth()->user()->user_type == 'student')
                                        <td>{{ $form['name'] }}</td>
                                    @endif
                                    <td>{{ $form['title'] }}</td>
                                    <td>{{ $form['start_date'] }}</td>
                                    <td>{{ $form['end_date'] }}</td>
                                    <th>
                                        @if(!auth()->guest() && auth()->user()->user_type == 'student')
                                            <a href="#" class="btn btn-default btn-block">
                                                Evaluate
                                            </a>
                                        @endif
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @if(auth()->guest())
                <div class="col-md-4">
                    <div class="panel panel-primary">
                        <div class="panel-heading">Log in</div>

                        <div class="panel-body">
                            @include('auth.login-form')
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
