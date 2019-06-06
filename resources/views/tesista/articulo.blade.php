@extends('layouts.tesista')
@section('content')
    <div class="container">
        <create-articulo usr="{{Auth::user()->id}}"></create-articulo>
    </div>
@endsection