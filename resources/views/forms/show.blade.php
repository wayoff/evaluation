@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Form: <i>{{ $form->title }}</i> </div>

                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Faculty
                            </div>
                            <div class="panel-body">
                                // list of faculties
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Questions
                            </div>
                            <div class="panel-body">
                                @foreach($form->questions as $question)
                                    <div class="list-group">
                                        <a href="{{ route('questions.edit', $question->id) }}" class="list-group-item">
                                            {{ $question->title }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection