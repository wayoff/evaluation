@extends('layouts.app')

@section('content')
<div class="container">
    <form-faculties-create
        :form="{{json_encode($form)}}"
    ></form-faculties-create>
</div>
@endsection
