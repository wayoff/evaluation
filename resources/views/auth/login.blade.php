@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    @include('auth.login-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
