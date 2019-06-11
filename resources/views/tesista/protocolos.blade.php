@extends('layouts.tesista')
@section('content')
    <div class="container">
        @foreach($protocolos as $protocolo)
        <div class="card" >
            <div class="card-body">
                <h5 class="card-title">{{$protocolo->tema}}</h5>
                <p class="card-text">Fecha de registro {{$protocolo->fecha_alta}}</p>
                <a href="#" class="card-link">Ver estado</a>
            </div>
        </div><br>
        @endforeach
    </div>
    {{$protocolos->links()}}
@endsection