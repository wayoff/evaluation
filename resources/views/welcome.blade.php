@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="{{ !auth()->guest() ? 'col-md-12' : 'col-md-8' }}">
                <h3 style="margin-top: 0px">Online Faculty Evaluation System</h3>
                <div>
                    is developed to serve as a useful tool for easy accessibility and less hassle of works of the administration and students of the institution in conducting faculty evaluations. <br />
                    A Comprehensive Student Faculty Evaluation involves the systematic observation (measurement) of relevant faculty performance to determine the degree to which that performance is consonant with the values and needs of the educational institution. 
                </div>
                <div class="panel panel-primary" style="margin-top: 10px;">
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
                                            @if(!$form['exists']) 
                                                <a href="/answers/{{ $form['evaluation_id'] }}" class="btn btn-default btn-block">
                                                    Evaluate
                                                </a>
                                            @else
                                                <button class="btn btn-default btn-block" disabled>
                                                    Evaluate
                                                </button>
                                            @endif
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
