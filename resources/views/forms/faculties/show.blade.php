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
                    <div class="row">
                        <div class="col-md-offset-2 col-md-8">
                            <canvas id="myChart" width="200" height="200"></canvas>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered">
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
                            @foreach($studentAnswers->groupBy('value') as $key => $group)
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
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Question</th>
                                <th>Always</th>
                                <th>Often</th>
                                <th>Sometimes</th>
                                <th>Seldom</th>
                                <th>Never</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentAnswers->groupBy('question_id') as $key => $value)
                                <tr>
                                    <td> {{ $value[0]['question']['title'] }} </td>
                                    <td class="text-center">
                                        {{ $value->where('value', 'Always')->count() / $evaluation->answers->count() * 100 }} %
                                    </td>
                                    <td class="text-center">
                                        {{ $value->where('value', 'Often')->count() / $evaluation->answers->count() * 100 }} %
                                    </td>
                                    <td class="text-center">
                                        {{ $value->where('value', 'Sometimes')->count() / $evaluation->answers->count() * 100 }} %
                                    </td>
                                    <td class="text-center">
                                        {{ $value->where('value', 'Seldom')->count() / $evaluation->answers->count() * 100 }} %
                                    </td>
                                    <td class="text-center">
                                        {{ $value->where('value', 'Never')->count() / $evaluation->answers->count() * 100 }} %
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        @foreach($studentAnswers->groupBy('category_id') as $group)
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Always</th>
                                    <th>Often</th>
                                    <th>Sometimes</th>
                                    <th>Seldom</th>
                                    <th>Never</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> {{$group[0]['category']['title']}} </td>
                                    <td class="text-center">
                                        {{ number_format($group->where('value', 'Always')->count() / $group->count() * 100, 2) }} %
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($group->where('value', 'Often')->count() / $group->count() * 100, 2) }} %
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($group->where('value', 'Sometimes')->count() / $group->count() * 100, 2) }} %
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($group->where('value', 'Seldom')->count() / $group->count() * 100, 2) }} %
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($group->where('value', 'Never')->count() / $group->count() * 100, 2) }} %
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="/forms/{{$form->id}}/faculties/{{$facultyId}}/pdf" class="btn btn-danger btn-lg">
                PDF
            </a>
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