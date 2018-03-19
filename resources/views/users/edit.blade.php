@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Update</div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('users.update', $user->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}


                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Last Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required autofocus>

                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">First Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required autofocus>

                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('middle_name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Middle Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="middle_name" value="{{ $user->middle_name }}" autofocus>

                        @if ($errors->has('middle_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('middle_name') }}</strong>
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
                            <input type="radio" class="form--user-type" name="user_type" value="1" {{ $user->user_type == 'admin' ? 'checked' : '' }}>
                            Admin
                          </label>
                        </div>

                        <div class="radio">
                          <label>
                            <input type="radio" class="form--user-type" name="user_type" value="2" {{ $user->user_type == 'faculty' ? 'checked' : '' }}>
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
                
                @if($user->isFaculty())
                    <div class="form-group faculty_info">
                        <label class="col-md-4 control-label">Department</label>

                        <div class="col-md-6">
                            <input type="" class="form-control" name="department" value="{{$user->department}}">
                        </div>
                    </div>
                @endif


                @if($user->isStudent())
                    <div class="form-group student_info">
                        <label for="student_professor" class="col-md-4 control-label"> Student Info</label>

                        <div class="col-md-7 col-md-offset-4">
                            <div class="form-group">
                                <label for="">Student No:</label>
                                <input type="text" class="form-control" name="student_no" id="student_no" placeholder="Student No" value="{{$user->username}}">
                            </div>
                            <div class="form-group">
                                <label for="">Division:</label>
                                <select name="academic_attended" class="form-control division" id="division">
                                    <option value="Senior High" {{ $user->student->academic_attended == 'Senior High' ? 'selected' : '' }} > Senior High</option>
                                    <option value="College" {{ $user->student->academic_attended == 'College' ? 'selected' : '' }}> College</option>
                                </select>
                            </div>
                        <div class="form-group">
                            <label for="">Year Level:</label>
                            <input type="text" class="form-control" name="yr_level" id="yr_level" placeholder="Year Level" value="{{ $user->student->yr_level }}">
                        </div>
                        <div class="form-group strands">
                            <label for="">Strands:</label>
                            @php
                                $strands = [
                                    'Accounting, Business and Management',
                                    'Home Economics',
                                    'Information and Communication Technology',
                                    'Science, Technology, Engineering and Math',
                                    'Humanities and Social Studies',
                                ];
                            @endphp
                            <select name="strands" class="form-control" id="strands">
                                @foreach($strands as $strand)
                                    <option
                                        {{ $user->student->strand == $strand ? 'selected' : '' }}
                                        value="{{ $strand }}"> {{ $strand }} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group course">
                            <label for="">Course:</label>
                            @php
                                $courses = [
                                    'Bachelor of Science in Information Technology',
                                    'Bachelor of Science in Computer Engineering',
                                    'Bachelor of Science in Hospitality Management',
                                    'Bachelor of Science in Tourism Management',
                                ];
                            @endphp

                            <select name="course" class="form-control" id="course">
                                @foreach($courses as $course)
                                    <option
                                        {{ $user->student->course == $course ? 'selected' : '' }}
                                        value="{{ $course }}"> {{ $course }} </option>
                                @endforeach
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
@endsection

@section('scripts')
    <script type="text/javascript">
        $('.strands, .course').hide();
        $( function() {
            var username = $('#username');
            var user_type = $("input[name='user_type']:checked").val();
            var studentAdditionalInfoContainer = function(userType) {
                if (userType == 2) {
                    $('.faculty_info').show();
                } else {
                    $('.faculty_info').hide();
                }

                if (userType != 3) {
                    $('.student_info').hide();
                    username.attr('readonly', false);
                } else {
                    $('.student_info').show();
                    username.attr('readonly', true);
                }

                student2ndAdditionalInfoContainer($('#division').val());
            };

            var student2ndAdditionalInfoContainer = function(value) {
                if (value == 'Senior High') {
                    $('.course').hide();
                    $('#course').val('');
                    $('.strands').show();
                } else {
                    $('.strands').hide();
                    $('#strands').val('');
                    $('.course').show();
                }
            }

            $('.form--user-type').on('click', function() {
                var userType = $(this).val();
                studentAdditionalInfoContainer(userType);
            });


            $('#student_no').on('keyup', function(e) {
                username.val(e.target.value);
            });

            $('.division').on('change', function() {
                var value = $(this).val();
                student2ndAdditionalInfoContainer(value);
            });

            studentAdditionalInfoContainer(user_type);
        })
    </script>
@endsection