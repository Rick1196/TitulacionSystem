@extends('layouts.tesista')
@section('content')
    @foreach($protocolos as $protocolo)
        {!! $protocolo->descripcion !!}
    @endforeach
    {{$protocolos->links()}}
@endsection