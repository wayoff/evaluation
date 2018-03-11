@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Questions</div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('questions.store') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-3 control-label">Title</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" required value="{{ $question->title }}" required autofocus>

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
                        <input type="text" class="form-control" name="description" required value="{{ $question->description }}" required>

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
                            'value' => 'Always'
                        ],
                        [
                            'label' => '2nd Choice',
                            'value' => 'Often'
                        ],
                        [
                            'label' => '3rd Choice',
                            'value' => 'Sometimes'
                        ],
                        [
                            'label' => '4th Choice',
                            'value' => 'Seldom'
                        ],
                        [
                            'label' => '5th Choice',
                            'value' => 'Never'
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
@endsection
