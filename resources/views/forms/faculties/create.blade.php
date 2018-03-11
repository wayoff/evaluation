@extends('layouts.app-sidemenu')

@section('content')
  <form-faculties-create
      :form="{{json_encode($form)}}"
  ></form-faculties-create>
@endsection
