@extends('layouts.tesista')
@section('content')
    <div class="container">
        <create-ensayo usr="{{Auth::user()->id}}"></create-ensayo>
    </div>
@endsection