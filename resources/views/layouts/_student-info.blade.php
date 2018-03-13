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
      <td></td>
      <td></td>
    </tr>
  </table>
</div>