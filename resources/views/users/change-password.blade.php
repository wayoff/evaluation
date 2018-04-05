@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Change Password
                </div>

                <div class="panel-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="/auth/change-password" method="POST" class="form" role="form">
                        {!! csrf_field() !!}

                        <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                            <label class="" for="">Old Password</label>
                            <input type="password" class="form-control" name="current_password" id="" placeholder="">
                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif  

                        </div>
                        <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label class="" for="">New Password</label>
                            <input type="password" class="form-control" name="new_password" id="" placeholder="">
                            @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="" for="">Confirm New Password</label>
                            <input type="password" class="form-control"  name="new_password_confirmation" id="" placeholder="">
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
