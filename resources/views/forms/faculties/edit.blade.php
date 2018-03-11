@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Forms - Faculties</div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('forms.store', $form->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-3 control-label">Codes</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" value="" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12 text-center">
                        <br />
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection