<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use View;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function misRevisiones()
    {
       $protocolos = DB::table('revisores_sustentando')
       ->join('sustentando as s','revisores_sustentando.evaluando','=', 's.id')
       ->join('versiones as v','s.id', '=','v.sustentado')
       ->join('evaluadores as e','revisores_sustentando.evaluador','=','e.id')
       ->join('modalidades as m','s.modalidad','=','m.id')
       ->select('v.id as version','s.tema','s.fecha_alta','s.folio','s.id as sustentando','s.modalidad','m.descripcion as mod_desc','m.id as mod')
       ->where('e.usuario',Auth::user()->id)
       ->orderBy('v.fecha','DESC')
       ->paginate(10);
       return View::make("sinodal/home",compact('protocolos'));
    }
}
