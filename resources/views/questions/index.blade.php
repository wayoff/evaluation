@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Questions</div>

                <div class="panel-body">
                    <table class="table-striped table table-bordered">
                        <thead>
                            <tr>
                               <th colspan="10" class="text-right">
                                    <a class="btn btn-primary" href="{{ route('questions.create') }}">
                                        Create
                                    </a>
                               </th> 
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($questions as $question)
                                <tr>
                                    <td> {{ str_pad($question->id, 5, '0', STR_PAD_LEFT) }} </td>
                                    <td> {{ $question->title }} </td>
                                    <td> {{ $question->description }} </td>
                                    <td>
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="form-inline form-delete" role="form">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                        
                                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-info btn-xs">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @if($questions->isEmpty())
                                <tr>
                                    <td colspan="10" class="text-center">
                                        No Question
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    {!! $questions->render() !!}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
