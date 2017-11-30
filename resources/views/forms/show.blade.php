@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Form: <i>{{ $form->title }}</i>

                    <span class="pull-right">
                        <a href="{{ route('forms.edit', $form->id) }}" class="btn btn-info btn-xs">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                    </span>
                </div>

                <div class="panel-body">
                    <div class="col-md-6">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                Faculty

                                <span class="pull-right">
                                    <a href="{{ route('faculties.create', $form->id) }}" class="btn btn-info btn-xs">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                </span>
                            </div>
                            <div class="panel-body">
                                No users associated with this form
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                Questions
                            </div>
                            <div class="panel-body">
                                <div class="list-group">
                                    @foreach($form->questions as $key => $question)
                                        <a href="{{ route('questions.edit', $question->id) }}" class="list-group-item">
                                            {{ $key + 1 }}. {{ $question->title }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection