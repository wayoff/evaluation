@extends('layouts.app-sidemenu')

@section('content')
    <div class="panel panel-primary">
        <div class="panel-heading">Forms</div>

        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('forms.update', $form->id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-3 control-label">Title</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="title" value="{{ $form->title }}" required autofocus>

                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('start_date') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-3 control-label">Start Date</label>

                    <div class="col-md-6">
                        <input type="date" class="form-control" name="start_date" value="{{ $form->start_date }}" required autofocus>

                        @if ($errors->has('start_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('start_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('end_date') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-3 control-label">End Date</label>

                    <div class="col-md-6">
                        <input type="date" class="form-control" name="end_date" value="{{ $form->end_date }}" required autofocus>

                        @if ($errors->has('end_date'))
                            <span class="help-block">
                                <strong>{{ $errors->first('end_date') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-12">
                    @php
                        $chunks = $categories->chunk(2);
                    @endphp
                    
                    @foreach($chunks as $chunk)
                        <div class="col-md-12">
                            @foreach($chunk as $category)
                                <div class="col-md-6">
                                    <div class="checkbox">
                                      <label>
                                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                                {{ $form->categories->where('id', $category->id)->first() ? 'checked' : '' }}
                                            >
                                            {{ $category->title }}
                                      </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
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