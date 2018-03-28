@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Categories</div>

        <div class="panel-body">
            <table class="table-striped table table-bordered">
                <thead>
                    <tr>
                       <th colspan="10" class="text-right">
                            <a class="btn btn-primary" href="{{ route('categories.create') }}">
                                Create
                            </a>
                       </th> 
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        {{-- <th>Description</th> --}}
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $question)
                        <tr>
                            <td> {{ str_pad($question->id, 5, '0', STR_PAD_LEFT) }} </td>
                            <td> {{ $question->title }} </td>
                            {{-- <td> {{ $question->description }} </td> --}}
                            <td>
                                <form action="{{ route('categories.destroy', $question->id) }}" method="POST" class="form-inline form-delete" role="form">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                
                                    <a href="{{ route('categories.edit', $question->id) }}" class="btn btn-info btn-xs">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-xs">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if($categories->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">
                                No Category
                            </td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">
                            {!! $categories->render() !!}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
