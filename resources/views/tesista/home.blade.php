@extends('layouts.tesista')
@section('content')
    <div class="container">
        <div class="container">
            <div class="card-deck">
                <div class="card">
                    <img src="{{asset('images/articulo.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Artículo</h5>
                        <p class="card-text">Difundir de manera clara y precisa los resultados de una investigación realizada sobre un área determinada del conocimiento.</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#articulo">Requisitos</button>
                            </div>
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary">Iniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset('images/ensayo.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Ensayo</h5>
                    <p class="card-text">Un ensayo académico analiza, interpreta o evalúa un tema. En otras palabras el ensayo académico intenta resolver un problema por medio de argumentos.</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary"  data-toggle="modal" data-target="#ensayo">Requisitos</button>
                            </div>
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary">Iniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset('images/memoria.jpeg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Memoria de Experiencia Laboral</h5>
                    <p class="card-text">Informe técnico de un proyecto desarrollado para el sector productivo o de servicios, o un resumen de actividades profesionales de innovación de sistemas, aparatos o mejoramiento técnico de algún proceso.</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#exp-lab">Requisitos</button>
                            </div>
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary">Iniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="container">
            <div class="card-deck">
                <div class="card">
                    <img src="{{asset('images/aplicacion.png')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Reporte de Aplicación de conocimiento</h5>
                    <p class="card-text">Escrito que se desarrolla con el objetivo de dar a cononcer una actividad realizada con el fin de aplicar los conocimientos adquiridos a lo largo de la carrera.</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#app-con">Requisitos</button>
                            </div>
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary">Iniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset('images/reporte.jpeg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Reporte de Autoempleo</h5>
                    <p class="card-text">Escrito en el que debe informarse sobre la constitución y desarrollo de una empresa relacionada con el Plan de Estudios cursado por el pasante o pasantes, o con alguna área científica o técnica.</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#rep-aut">Requisitos</button>
                            </div>
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary">Iniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset('images/investigacion.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Reporte de Residencia de Investigación</h5>
                    <p class="card-text">Trabajo escrito en el que se informa sobre la realización de actividades de apoyo a un proyecto de investigación científica, tecnológica o humanística.</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary"  data-toggle="modal" data-target="#rep-res">Requisitos</button>
                            </div>
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary">Iniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="container">
            <div class="card-deck">
                <div class="card">
                    <img src="{{asset('images/tesina.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Tesina</h5>
                    <p class="card-text">Trabajo escrito en el que debe reportarse el desarrollo y resultados de una investigación documental de carácter monográfico, que comprenda un proceso de investigación documental o una traducción crítica relacionada con el Plan de Estudios cursado por el pasante.</p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#tesina">Requisitos</button>
                            </div>
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary">Iniciar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset('images/tesis.jpg')}}" class="card-img-top" alt="...">
                    <div class="card-body">
                    <h5 class="card-title">Tesis</h5>
                    <p class="card-text">Consiste en la presentación de resultados de investigación que surgen de un proceso sistemático de carácter documental o experimental.</p>
                </div>
                <div class="card-footer">
                        <div class="row">
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary" data-toggle="modal" data-target="#tesis">Requisitos</button>
                            </div>
                            <div class="col sm-6">
                                <button class="btn btn-md btn-primary">Iniciar</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    @include('tesista.modals_informativos')
@endsection