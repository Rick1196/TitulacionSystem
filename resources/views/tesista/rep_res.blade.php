@extends('layouts.tesista')
@section('content')
    <div class="container">
        <create-rep-res usr="{{Auth::user()->id}}"></create-rep-res>
    </div>
@endsection