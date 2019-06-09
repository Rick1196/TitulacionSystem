@extends('layouts.tesista')
@section('content')
    <div class="container">
        <create-rep-out usr="{{Auth::user()->id}}"></create-rep-out>
    </div>
@endsection