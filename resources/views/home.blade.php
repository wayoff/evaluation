@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">On going evaluation</h3>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>TITLE</th>
                        <th>START DATE</th>
                        <th>END DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                    <tr>
                        <td>
                            <a href="/forms/{{$form->id}}">{{ $form->title }}</a>
                        </td>
                        <td>{{ $form->start_date }}</td>
                        <td>{{ $form->end_date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="panel panel-primary">
        <div class="panel-heading">Recently evaluated professor</div>

        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>EVALUATION</th>
                        <th>STUDENT NAME</th>
                        <th>PROFESSOR</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($answers as $answer)
                        <tr>
                            <td>{{ $answer->id }}</td>
                            <td>{{ $answer->evaluation->form->title }}</td>
                            <td>{{ $answer->user->name }}</td>
                            <td>{{ $answer->evaluation->user->name }}</td>
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
@endsection
