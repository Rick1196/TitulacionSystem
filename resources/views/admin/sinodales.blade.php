@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="container">
            <h1>
            <p class="text-center">
                Listado de sinodales
                <button class="btn btn-primary btn-sm" data-toggle="modal"  data-target="#create-sinodal">
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
                        <th scope="col">Identificador</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                        @foreach ($sinodales as $sinodal)
                        <tr>
                            <td>{{$sinodal->nombre.' '.$sinodal->paterno.' '.$sinodal->materno}}</td>
                            <td>{{$sinodal->identificador}}</td>
                            <td>{{$sinodal->email}}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-toggle="modal"  data-target="#edit{{$sinodal->id}}"><i class="fas fa-user-edit"></i></button>
                                <form action="{{ route('sinodales.dest',$sinodal->id) }}" method="POST">
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
        {{$sinodales->links()}}
        </div>
        @foreach($sinodales as $sinodal)
            <div class="modal fade" id="edit{{$sinodal->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                     <edit-sinodal info="{{$sinodal->id}}"></edit-sinodal>
                    </div>
            </div>
        @endforeach
        <div class="modal fade" id="create-sinodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
             <create-sinodal></create-sinodal>
            </div>
        </div>
    </div>
@endsection
