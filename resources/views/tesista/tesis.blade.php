@extends('layouts.tesista')
@section('content')
    <div class="container">
        <create-tesis usr="{{Auth::user()->id}}"></create-tesis>
    </div>
@endsection