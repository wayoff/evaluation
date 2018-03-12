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
            <div class="col-md-offset-2 col-md-8">
                <canvas id="myChart" width="200" height="200"></canvas>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Answer</th>
                        <th>Count</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $labels = [];
                        $counts = [];
                    @endphp
                    @foreach($answer->studentAnswers->groupBy('value') as $key => $group)
                        @php 
                            $labels[] = $key;
                            $counts[] = $group->count();
                        @endphp
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

@section('scripts')
    <script type="text/javascript">
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: '# of Answers',
                    data: {!! json_encode($counts) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                }
            }
        });
    </script>
@endsection
