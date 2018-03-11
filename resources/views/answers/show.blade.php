@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Evaluation info</div>

        <div class="panel-body">
            <table class="table table-bordered">
                <tr>
                    <td> Student ID </td>
                    <td> {{ $answer->user->student->student_no }} </td>
                    <td> Name </td>
                    <td> {{ $answer->user->name }} </td>
                </tr>
                <tr>
                    <td> Academic division </td>
                    <td> {{ $answer->user->student->academic_attended }} </td>
                    <td> ID </td>
                    <td> {{ $answer->user->id }} </td>
                </tr>
                <tr>
                    <td> Professor name</td>
                    <td> {{ $answer->evaluation->user->name }} </td>
                    <td> Professor id </td>
                    <td> {{ $answer->evaluation->user->id }} </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading">Student Evaluation</div>

        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th> Question </th>
                        <th> Answer </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($answer->studentAnswers as $key => $studentAnswer)
                        <tr>
                            <td>{{$key + 1}}) {{ $studentAnswer->question->title }} </td>
                            <td> {{ $studentAnswer->value }} </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="20">
                            Comment: <br />
                            {{ $answer->comment }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="panel panel-warning">
        <div class="panel-heading">Student Statistics</div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Answer</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($answer->studentAnswers->groupBy('value') as $key => $group)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $group->count() }}</td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
            {{-- pie graph --}}

        </div>
    </div>
@endsection
