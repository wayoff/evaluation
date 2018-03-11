@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Students</h3>
        </div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Submitted</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evaluation->answers as $answer)
                        <tr>
                            <td>{{ $answer->user->name }}</td>
                            <td>{{ $answer->created_at }}</td>
                            <td>
                                <a href="/answers/{{ $answer->id }}/student" class="btn btn-info btn-xs" title="See answers">
                                    <span class="glyphicon glyphicon-eye-open"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">
            Form: <i>{{ $form->title }}</i>
        </div>

        <div class="panel-body">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Statistics</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Answer</th>
                                <th>Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentAnswers->groupBy('value') as $key => $group)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>{{ $group->count() }}</td>
                                </tr>
                            @endforeach 
                        </tbody>
                    </table>
                </div>
                {{-- pie graph --}}
            </div>
        </div>
    </div>
@endsection