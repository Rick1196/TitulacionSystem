@extends('layouts.tesista')
@section('content')
    <div class="container">
        <create-mem-exp usr="{{Auth::user()->id}}"></create-mem-exp>
    </div>
@endsection