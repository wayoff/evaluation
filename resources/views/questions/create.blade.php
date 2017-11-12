@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Questions</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('questions.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-3 control-label">Title</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-3 control-label">Description</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="description" value="{{ old('description') }}" required>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        @php
                            $choices = collect([
                                [
                                    'label' => '1st Choice',
                                    'value' => 'Strongly Disagree'
                                ],
                                [
                                    'label' => '2nd Choice',
                                    'value' => 'Disagree'
                                ],
                                [
                                    'label' => '3rd Choice',
                                    'value' => 'Neutral'
                                ],
                                [
                                    'label' => '4th Choice',
                                    'value' => 'Agree'
                                ],
                                [
                                    'label' => '5th Choice',
                                    'value' => 'Strongly Agree'
                                ]
                            ]);
                        @endphp


                        @foreach($choices->chunk(2) as $chunk)
                            <div class="col-md-12">
                                @foreach($chunk as $choice)
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="text" class="col-md-4 control-label"> {{ $choice['label'] }} </label>

                                            <div class="col-md-6">
                                                <input type="text" class="form-control" name="choices[]" required value="{{ $choice['value'] }}" required>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                        <div class="form-group">
                            <div class="col-md-12 text-center">
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
