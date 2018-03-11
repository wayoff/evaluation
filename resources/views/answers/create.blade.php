@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        {{ $evaluation->form->title }}
                        <span class="pull-right">
                            {{ $evaluation->form->start_date->format('Y-m-d') }} to {{ $evaluation->form->end_date->format('Y-m-d') }}
                        </span>
                    </div>

                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <td>ID: </td>
                                <td>
                                    {{ $evaluation->user->id }}
                                </td>
                                <td>Professor: </td>
                                <td>
                                    {{ $evaluation->user->name }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td colspan="10" class="text-center">
                                    <div class="col-md-offset-1 col-md-2 text-strong">5 - Always</div>
                                    <div class="col-md-2 text-strong">4 - Often</div>
                                    <div class="col-md-2 text-strong">3 - Sometimes</div>
                                    <div class="col-md-2 text-strong">2 - Seldom</div>
                                    <div class="col-md-2 text-strong">1 - Never</div>
                                </td>
                            </tr> --}}
                        </table>
                        <form action="/answers/{{$evaluation->id}}" method="post">
                            {{ csrf_field() }}
                            <table width="100%" class="table-bordered table">
                                @foreach($evaluation->form->questions as $key => $question)
                                    <tr>
                                        <td width="50%">
                                            {{$key + 1 }}) {{ $question->title }}   
                                        </td>
                                        <td width="50%" class="text-center">
                                            @foreach($question->choices as $choice)
                                                <label class="radio-inline">
                                                    <input
                                                        type="radio"
                                                        name="question_{{$question->id}}"
                                                        value="{{$choice->decription}}"
                                                        {{ $choice->order == 3 ? 'checked' : '' }}
                                                    > {{ $choice->decription }}
                                                </label>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="10">
                                        <textarea class="form-control" placeholder="Comment" name="comment"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            Evaluate Professor
                                        </button>
                                    </td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <div class="modal fade in" id="notify_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Notification !!</h4>
                </div>
                <div class="modal-body">
                    Terms on evaluating your professor:
                    <ul>
                        <li>Lorem ipsum dolor sit amet, </li>
                        <li>Lorem ipsum dolor sit amet, </li>
                        <li>Lorem ipsum dolor sit amet, </li>
                        <li>Lorem ipsum dolor sit amet, </li>
                        <li>Lorem ipsum dolor sit amet, </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        $( function() {
            $('#notify_modal').modal('show');
        });
    </script>
@stop
