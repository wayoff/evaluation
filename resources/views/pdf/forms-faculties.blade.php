<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Faculty</title>
</head>
<body>
  <div style="text-align: center;">
    <img src="img/ama.png">
    <h2 style="padding-top:0px; margin-top:0px;padding-bottom: 0px;margin-bottom: 0px;">AMA Computer College</h2>
    <h3 style="padding-top:0px; margin-top:0px;">Mandaluyong Campus</h3>
  </div>

  <table width="100%" style="margin-top:20px;">
    <tr>
      <td> Faculty ID </td>
      <td style="font-weight: bold"> {{ str_pad($user->id, 5, '0', STR_PAD_LEFT) }} </td>
      <td> Faculty Name </td>
      <td style="font-weight: bold"> {{ $user->name }} </td>
    </tr>
    <tr>
      <td> Faculty Department </td>
      <td style="font-weight: bold"> {{ $user->department }} </td>
      <td> Trimester </td>
      <td style="font-weight: bold"> {{ $user->trimester }} </td>
    </tr>
  </table>

  <table width="100%" style="margin-top:20px;border: 1px solid black;padding:5px;">
      <thead>
          <tr>
              <th>Questions</th>
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
                      {{ number_format($value->where('value', 'Always')->count() / $evaluation->answers->count() * 100, 2) }} %
                  </td>
                  <td class="text-center">
                      {{ number_format($value->where('value', 'Often')->count() / $evaluation->answers->count() * 100, 2) }} %
                  </td>
                  <td class="text-center">
                      {{ number_format($value->where('value', 'Sometimes')->count() / $evaluation->answers->count() * 100, 2) }} %
                  </td>
                  <td class="text-center">
                      {{ number_format($value->where('value', 'Seldom')->count() / $evaluation->answers->count() * 100, 2) }} %
                  </td>
                  <td class="text-center">
                      {{ number_format($value->where('value', 'Never')->count() / $evaluation->answers->count() * 100, 2) }} %
                  </td>
              </tr>
          @endforeach
      </tbody>
  </table>

  <table width="100%" style="margin-top:5px ;border: 1px solid black;padding:5px;">
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


<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Grade</h3>
  </div>
  <div class="panel-body">
    <ul>
      <li> Total Student: {{ $evaluation->answers->count() }} </li>
      <li>
        @php
          $sum = 0;
          foreach($studentAnswers->where('category_id', 3)->groupBy('value') as $key => $value) {
            switch($key) {
              case 'Always':
                $sum+= 5 * $value->count();
                break;
              case 'Often':
                $sum+= 4 * $value->count();
                break;
              case 'Sometimes':
                $sum+= 3 * $value->count();
                break;
              case 'Seldom':
                $sum+= 2 * $value->count();
                break;
              case 'Never':
                $sum+= 1 * $value->count();
                break;
            }
          }
        @endphp
        Total Sum of score: {{ $sum }}
      </li>
      <li>Constant: 0.35</li>
      <li>Computation: ({{ $sum }} / {{ $evaluation->answers->count() }} * 0.35)</li>
      <li>
        Final Grade: <strong>{{
          $evaluation->answers->count() > 0
            ? number_format( ($sum / $evaluation->answers->count()) * 0.35, 2)
            : 0
          }} % </strong>
      </li>
    </ul>
  </div>
</div>

  <table width="100%" style="margin-top:20px;">
    <thead>
      <tr>
        <th>Comments</th>
      </tr>
    </thead>
    <tbody>
      @foreach($answers as $answer)
        @if(!empty($answer->comment))
          <tr>
            <td> {{ $answer->comment }} </td>
          </tr>
        @endif
      @endforeach
    </tbody>
  </table>
</body>
</html>