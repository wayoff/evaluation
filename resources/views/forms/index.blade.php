@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Forms</div>

        <div class="panel-body">
            <table class="table-striped table table-bordered">
                <thead>
                    <tr>
                       <th colspan="10" class="text-right">
                            <a class="btn btn-primary" href="{{ route('forms.create') }}">
                                Create
                            </a>
                       </th> 
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Total Questions</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                        <tr>
                            <td> {{ str_pad($form->id, 5, '0', STR_PAD_LEFT) }} </td>
                            <td> <a href="{{ route('forms.show', $form->id) }}">{{ $form->title }} </a></td>
                            <td> {{ $form->questions->count() }} </td>
                            <td>
                                {{ $form->start_date->format('Y-m-d') }} - {{ $form->end_date->format('Y-m-d') }}
                            </td>
                            <td>
                                <form action="{{ route('forms.destroy', $form->id) }}" method="POST" class="form-inline form-delete" role="form">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                
                                    <a href="{{ route('forms.edit', $form->id) }}" class="btn btn-info btn-xs">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($forms->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">
                                No Forms
                            </td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            {!! $forms->render() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
