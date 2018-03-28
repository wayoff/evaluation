@extends('layouts.app-sidemenu')

@section('content')
<div class="panel panel-primary">
    <div class="panel-heading">Category: {{ $category->title }}</div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('categories.update', $category->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                <label for="name" class="col-md-3 control-label">Title</label>

                <div class="col-md-6">
                    <input type="text" class="form-control" name="title" value="{{ $category->title }}" required autofocus>

                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                @php
                    $chunks = $questions->chunk(2);
                @endphp
                
                @foreach($chunks as $chunk)
                    <div class="col-md-12">
                        @foreach($chunk as $question)
                            <div class="col-md-6">
                                <div class="checkbox">
                                  <label>
                                    <input type="checkbox" name="questions[]"
                                        value="{{ $question->id }}"
                                        {{ $category->questions->where('id', $question->id)->first() ? 'checked' : '' }}
                                    >{{ $question->title }} {{ $question->id }}
                                  </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
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
