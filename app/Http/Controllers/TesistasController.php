<?php

namespace App\Http\Controllers;

use App\Tesista;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use DB;
use View;
class TesistasController extends Controller
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
    public function store(Request $data)
    {
        $this->validate(
            $data, 
            [
                'paterno' => 'required',
                'materno' => 'required',
                'cuenta' => 'required|unique:sustentantes',
                'name' => 'required',   
                'email' => 'required|unique:users|email',
                'password' => 'required|min:8',
                'carrera' => 'required'
            ],
            [
                'name.required' => 'El NOMBRE es un campo requerido',
                'paterno.required' => 'El APELLIDO PATERNO es un campo requerido',
                'materno.required' => 'El APELLIDO MATENRO es un campo requerido',
                'cuenta.required' => 'La CUENTA es un campo requerido',
                'cuenta.unique' => 'Este numero de cuenta ya esta registrado',
                'email.required' => 'El EMAIL es un campo requerido',
                'password.required' => 'La CONTRASEÑA es un campo requerido',
                'password.min' => 'La CONTRASEÑA debe tener minimo 8 caracteres',
                'email.unique' => 'Esta cuenta de correo ya esta en uso',
                'email.email' => 'Ingrese un EMAIL valido',
                'carrera.required' => 'Seleccione una carrera'
            ]
        );
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'tesista')->first());
        DB::table('sustentantes')->insert(
            ['nombre' => $data['name'], 
            'paterno' => $data['paterno'],
            'materno' => $data['materno'],
            'cuenta' => $data['cuenta'],
            'usuario' => $user->id,
            'carrera' => $data['carrera']]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tesista  $tesista
     * @return \Illuminate\Http\Response
     */
    public function show(Tesista $tesista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tesista  $tesista
     * @return \Illuminate\Http\Response
     */
    public function edit(Tesista $tesista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tesista  $tesista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tesista $tesista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tesista  $tesista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tesista $tesista)
    {
        DB::table('users')->delete($tesista->usuario);
        return redirect()->route('admin.tesistas')->with('success','Tesista eliminado exitosamente');

    }

    public function tesistasCrud()
    {
        $tesistas = DB::table('sustentantes')
        ->join('users', 'users.id', '=', 'sustentantes.usuario')
        ->join('carreras', 'carreras.id', '=', 'sustentantes.carrera')
        ->select('sustentantes.*', 'carreras.descripcion', 'users.email')->orderBy('created_at', 'desc')
        ->paginate(10);
        return  View::make("admin/tesistas",compact('tesistas'));
    }

    public function updateCascade(Request $data)
    {
        $tesista = $data['tesista'];
        $nombre = $data['nombre'];
        $paterno= $data['paterno'];
        $materno = $data['materno'];
        $cuenta = $data['cuenta'];
        $carrera = $data['carrera'];
        $this->validate(
            $data, 
            [
                'nombre' => 'required',
                'paterno' => 'required',
                'materno' => 'required',
                'cuenta' => 'required'     
            ],
            [
                'nombre.required' => 'El NOMBRE es un campo requerido',
                'paterno.required' => 'El APELLIDO PATERNO es un campo requerido',
                'materno.required' => 'El APELLIDO MATENRO es un campo requerido',
                'cuenta.required' => 'La CUENTA es un campo requerido'
            ]
        );
        DB::table('sustentantes')
        ->where('id', $tesista)
        ->update([
            'nombre' => $nombre,
            'paterno' => $paterno,
            'materno' => $materno,
            'cuenta' => $cuenta,
            'carrera' => $carrera
        ]);
    }

    public function getTesista(Request $data){
        $tesista = DB::table('sustentantes')
        ->join('users', 'users.id', '=', 'sustentantes.usuario')
        ->join('carreras', 'carreras.id', '=', 'sustentantes.carrera')
        ->select('sustentantes.*', 'carreras.descripcion', 'users.email')
        ->where('sustentantes.usuario', '=', $data['id'])->get();
        return $tesista;
    }
}
