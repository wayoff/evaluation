@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
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
                    </div>
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach($form->evaluations as $evaluation )
                                <a href="/forms/{{$form->id}}/faculties/{{$evaluation->user_id}}" class="list-group-item">{{ $evaluation->user->name }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        Questions
                    </div>
                    <div class="panel-body">
                        @foreach($form->categories as $category)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"> {{ $category->title }} </h3>
                                </div>
                                <div class="panel-body">
                                    <div class="list-group">
                                        @foreach($category->questions as $key => $question)
                                            <a href="{{ route('questions.edit', $question->id) }}" class="list-group-item">
                                                {{ $key + 1 }}. {{ $question->title }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection