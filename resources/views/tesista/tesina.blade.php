@extends('layouts.tesista')
@section('content')
    <div class="container">
        <create-tesina usr="{{Auth::user()->id}}"></create-tesina>
    </div>
@endsection