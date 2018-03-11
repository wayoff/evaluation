@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Update</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control" name="username" value="{{ $user->username }}" readonly="true" required>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('user_type') ? ' has-error' : '' }}">
                            {{-- <label for="user_type" class="col-md-4 control-label"></label> --}}

                            <div class="col-md-8 col-md-offset-4">
                                <div class="radio">
                                  <label>
                                    <input type="radio" name="user_type" value="1" {{ $user->user_type == 'admin' ? 'checked' : '' }}>
                                    Admin
                                  </label>
                                </div>

                                <div class="radio">
                                  <label>
                                    <input type="radio" name="user_type" value="2" {{ $user->user_type == 'faculty' ? 'checked' : '' }}>
                                    Faculty
                                  </label>
                                </div>
                                
                                @if($user->isStudent())
                                    <div class="radio">
                                      <label>
                                        <input type="radio" class="form--user-type" name="user_type" value="3" {{ $user->user_type == 'student' ? 'checked' : '' }}>
                                        Student
                                      </label>
                                    </div>
                                @endif

                                @if ($errors->has('user_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @if($user->isStudent())
                            <div class="form-group student_info">
                                <label for="student_professor" class="col-md-4 control-label"> Student Info</label>

                                <div class="col-md-8 col-md-offset-4">
                                    <div class="form-group">
                                        <label for="">Student No:</label>
                                        <input type="text" class="form-control" name="student_no" id="student_no" placeholder="Student No" value="{{$user->username}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Division:</label>
                                        <select name="academic_attended" class="form-control">
                                            <option value="Senior High" {{ $user->academic_attended == 'Senior High' ? 'selected' : '' }} > Senior High</option>
                                            <option value="College" {{ $user->academic_attended == 'College' ? 'selected' : '' }}> College</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group student_info">
                                <label for="student_professor" class="col-md-4 control-label"> Student Professor</label>

                                <div class="col-md-8 col-md-offset-4">
                                    @foreach($faculties as $faculty)
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" value="{{ $faculty->id }}" checked="checked" name="professor_id[]">
                                                (ID: {{ $faculty->id }}) Name: {{ $faculty->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 text-center">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $( function() {
            var username = $('#username');
            var studentAdditionalInfoContainer = function(userType) {
                if (userType != 3) {
                    $('.student_info').hide();
                    username.attr('readonly', false);
                } else {
                    $('.student_info').show();
                    username.attr('readonly', true);
                }
            };

            $('.form--user-type').on('click', function() {
                var userType = $(this).val();
                studentAdditionalInfoContainer(userType);
            });

            $('#student_no').on('keyup', function(e) {
                username.val(e.target.value);
            });

            studentAdditionalInfoContainer({{ $user->user_type == 'student' ? 3 : 0 }});
        })
    </script>
@endsection