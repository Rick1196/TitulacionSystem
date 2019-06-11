@extends('layouts.titulacion')
@section('content')
    <div class="container">
        @foreach($protocolos as $protocolo)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$protocolo->tema}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Alumno: {{$protocolo->nombre.' '.$protocolo->paterno.' '.$protocolo->materno.' '.$protocolo->cuenta}}</h6>
                <h6 class="card-subtitle mb-2 text-muted">Fecha de registro: {{$protocolo->fecha_alta}}</h6>
                <a href="#" class="card-link" data-toggle="modal"  data-target="#edit{{$protocolo->id}}">Asignar folio</a>
            </div>
        </div><br>
        @endforeach
        {{$protocolos->links()}}
    </div>

    @foreach($protocolos as $protocolo)
        <div class="modal fade" id="edit{{$protocolo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <edit-folio proto="{{$protocolo->id}}"></edit-folio>
                </div>
        </div>
    @endforeach
@endsection