<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Faculty</title>
</head>
<body>
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
</body>
</html>