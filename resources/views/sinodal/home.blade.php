@extends('layouts.titulacion')
@section('content')
    <div class="container">
        @foreach($protocolos as $protocolo)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$protocolo->tema}}</h5>
                <p class="card-text">Fecha de registro: {{$protocolo->fecha_alta}}</p>
                <p class="card-text">Folio: {{$protocolo->folio}}</p>
                <p class="card-text">Modalidad: {{$protocolo->mod_desc}}</p>
                <a href="{{route('post.reporte',['version' => $protocolo->version, 'mod' => $protocolo->modalidad])}}" class="btn btn-primary">Evaluar</a>
            </div>
        </div>
        @endforeach
    </div>
@endsection