<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use App\Tesista;
use View;
use DB;
class AdminsController extends Controller
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
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }


    public function getTesista(Request $data){
        $tesista = DB::table('sustentantes')
        ->join('users', 'users.id', '=', 'sustentantes.usuario')
        ->join('carreras', 'carreras.id', '=', 'sustentantes.carrera')
        ->select('sustentantes.*', 'carreras.descripcion', 'users.email')
        ->where('sustentantes.id', '=', $data['id'])->get();
        return $tesista;
    }

    public function getSinodal(Request $data){
        $sinodal = DB::table('evaluadores')
        ->join('users', 'users.id', '=', 'evaluadores.usuario')
        ->select('evaluadores.*', 'users.email')
        ->where('evaluadores.id', '=', $data['id'])->get();
        return $sinodal;
    }

    public function getCarreras()
    {
        return  DB::table('carreras')->get();
    }
}
