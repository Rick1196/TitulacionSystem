@extends('layouts.titulacion')
@section('content')
    <div class="container">
        @if($resumen->modalidad == 1)
            <rep-art user="{{Auth::user()->id}}" version="{{$resumen->version}}" modalidad="{{$resumen->modalidad}}"></rep-art>
        @elseif($resumen->modalidad == 2)
            <rep-ensayo user="{{Auth::user()->id}}" version="{{$resumen->version}}" modalidad="{{$resumen->modalidad}}"></rep-ensayo>
        @elseif($resumen->modalidad == 3)
            <rep-exp user="{{Auth::user()->id}}" version="{{$resumen->version}}" modalidad="{{$resumen->modalidad}}"></rep-exp>
        @elseif($resumen->modalidad == 4)
            <rep-con user="{{Auth::user()->id}}" version="{{$resumen->version}}" modalidad="{{$resumen->modalidad}}"></rep-con>
        @elseif($resumen->modalidad == 5)
            <rep-aut user="{{Auth::user()->id}}" version="{{$resumen->version}}" modalidad="{{$resumen->modalidad}}"></rep-aut>
        @elseif($resumen->modalidad == 6)
            <rep-inv user="{{Auth::user()->id}}" version="{{$resumen->version}}" modalidad="{{$resumen->modalidad}}"></rep-inv>
        @elseif($resumen->modalidad == 7)
            <rep-tesina user="{{Auth::user()->id}}" version="{{$resumen->version}}" modalidad="{{$resumen->modalidad}}"></rep-tesina>
        @elseif($resumen->modalidad == 8)
            <rep-tesis user="{{Auth::user()->id}}" version="{{$resumen->version}}" modalidad="{{$resumen->modalidad}}"></rep-tesis>
        @endif

    </div>
@endsection