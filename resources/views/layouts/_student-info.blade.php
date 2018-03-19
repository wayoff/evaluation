<div class="container">
  <table class="table table-bordered" style="background: white;">
    <tr>
      <td>Name</td>
      <td><strong> {{ auth()->user()->name }}  </strong> </td>
      <td> Student No </td>
      <td><strong>{{ auth()->user()->student->student_no }} </strong> </td>
    </tr>
    <tr>
      <td>Division</td>
      <td><strong>{{ auth()->user()->student->academic_attended }} </strong> </td>
      <td>Year Level</td>
      <td><strong>{{ auth()->user()->student->yr_level }}</strong></td>
    </tr>
    <tr>
      <td colspan="4" class="text-center">
        @if(auth()->user()->student->academic_attended == 'College')
          Course: <strong>{{auth()->user()->student->course}}</strong>
        @else
          Strands: <strong>{{auth()->user()->student->strands}}</strong>
        @endif
      </td>
    </tr>
  </table>
</div>