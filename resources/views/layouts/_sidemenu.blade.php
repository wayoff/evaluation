<div class="sidemenu">
  <a href="/" class="sidemenu-item">Dashboard</a>
  <a href="{{ route('users.index') }}" class="sidemenu-item">Users</a>
    <div class="sidemenu-child">
      <a href="{{ route('users.create') }}" class="sidemenu-item">Create</a>
      <a href="{{ route('users.index') }}" class="sidemenu-item">User List</a>
    </div>
  <a href="{{ route('categories.index') }}" class="sidemenu-item">Categories</a>
    <div class="sidemenu-child">
      <a href="{{ route('forms.create') }}" class="sidemenu-item">Create</a>
      <a href="{{ route('forms.index') }}" class="sidemenu-item">Categories List</a>
    </div>
  <a href="{{ route('questions.index') }}" class="sidemenu-item">Questions</a>
    <div class="sidemenu-child">
      <a href="{{ route('questions.create') }}" class="sidemenu-item">Create</a>
      <a href="{{ route('questions.index') }}" class="sidemenu-item">Question List</a>
    </div>
  <a href="{{ route('forms.index') }}" class="sidemenu-item">Evaluations</a>
    <div class="sidemenu-child">
      <a href="{{ route('forms.create') }}" class="sidemenu-item">Create</a>
      <a href="{{ route('forms.index') }}" class="sidemenu-item">Evaluation List</a>
    </div>
</div>


{{-- @if(auth()->user()->user_type == 'admin')
    <li><a href="{{ route('users.index') }}">Users</a></li>
    <li><a href="{{ route('questions.index') }}">Questions</a></li>
    <li><a href="{{ route('forms.index') }}">Forms</a></li>                        
@endif --}}