@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->hasRole('tesista'))
                        <p>Tesista</p>
                    @elseif(Auth::user()->hasRole('admin'))
                        <p>Admin</p>
                    @elseif(Auth::user()->hasRole('titulacion'))
                        <p>Titulacion</p>
                    @elseif(Auth::user()->hasRole('sinodal'))
                        <p>Sinodal</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
