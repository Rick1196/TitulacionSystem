@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="container">
            <h1>
            <p class="text-center">
                Listado de tesistas
                <button class="btn btn-primary btn-sm" data-toggle="modal"  data-target="#create-tesista">
                    <i class="fas fa-user-plus"></i>
                </button>
            </p></h1>
            <h3>
                <p class="text-center">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <p class="text-center">{{ $message }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif
                </p>
            </h3>
        </div><br>
        <div class="table-responsive-xl">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cuenta</th>
                        <th scope="col">Carrera</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($tesistas as $tesista)
                        <tr>
                            <td>{{$tesista->nombre.' '.$tesista->paterno.' '.$tesista->materno}}</td>
                            <td>{{$tesista->cuenta}}</td>
                            <td>{{$tesista->descripcion}}</td>
                            <td>{{$tesista->email}}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal"  data-target="#edit{{$tesista->id}}"><i class="fas fa-user-edit"></i></button>
                                <form action="{{ route('tesistas.destroy',$tesista->id) }}" method="POST"> 
                                    @csrf
                                    @method('DELETE')
                                    <button  type="submit" class="btn btn-danger btn-sm"><i class="fas fa-user-minus"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
        <div class="mx-auto" style="width: 200px;">
        {{$tesistas->links()}}
        </div>
        @foreach($tesistas as $tesista)
            <div class="modal fade" id="edit{{$tesista->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                     <edit-tesista info="{{$tesista->id}}"></edit-tesista>
                    </div>
            </div>
        @endforeach
        <div class="modal fade" id="create-tesista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
             <create-tesista></create-tesista>
            </div>
        </div>
    </div>
@endsection
