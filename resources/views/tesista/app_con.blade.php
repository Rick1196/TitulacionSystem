@extends('layouts.tesista')
@section('content')
    <div class="container">
        <create-app-con usr="{{Auth::user()->id}}"></create-app-con>
    </div>
@endsection