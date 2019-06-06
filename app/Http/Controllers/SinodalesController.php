<?php

namespace App\Http\Controllers;

use App\Sinodal;
use Illuminate\Http\Request;
use DB;
use View;
use App\User;
use App\Role;
class SinodalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sinodales = DB::select("SELECT CONCAT(nombre, ' ', paterno,' ', materno) nombre, id from evaluadores");
        return $sinodales;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $data)
    {
        
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
                'identificador' => 'required',
                'name' => 'required',   
                'email' => 'required|unique:users|email',
                'password' => 'required|min:8',  
            ],
            [
                'name.required' => 'El NOMBRE es un campo requerido',
                'paterno.required' => 'El APELLIDO PATERNO es un campo requerido',
                'materno.required' => 'El APELLIDO MATENRO es un campo requerido',
                'identificador.required' => 'La CUENTA es un campo requerido',
                'email.required' => 'El EMAIL es un campo requerido',
                'password.required' => 'La CONTRASEÑA es un campo requerido',
                'password.min' => 'La CONTRASEÑA debe tener minimo 8 caracteres',
                'email.unique' => 'Esta cuenta de correo ya esta en uso',
                'email.email' => 'ingrese un EMAIL valido'
            ]
        );
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'sinodal')->first());
        DB::table('evaluadores')->insert(
            ['nombre' => $data['name'], 
            'paterno' => $data['paterno'],
            'materno' => $data['materno'],
            'identificador' => $data['identificador'],
            'usuario' => $user->id]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sinodal  $sinodal
     * @return \Illuminate\Http\Response
     */
    public function show(Sinodal $sinodal)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sinodal  $sinodal
     * @return \Illuminate\Http\Response
     */
    public function edit(Sinodal $sinodal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sinodal  $sinodal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sinodal $sinodal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sinodal  $sinodal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sinodal $sinodal)
    {
        DB::table('users')->delete($sinodal->usuario);
        return redirect()->route('admin.sinodales')->with('success','Sinodal eliminado exitosamente');
    }

    public function sinodalesCrud()
    {
        $sinodales = DB::table('evaluadores')
        ->join('users', 'users.id', '=', 'evaluadores.usuario')
        ->select('evaluadores.*', 'users.email')->orderBy('created_at', 'desc')
        ->paginate(10);
        return  View::make("admin/sinodales",compact('sinodales'));
    }

    public function updateCascade(Request $data)
    {
        $sinodal = $data['sinodal'];
        $nombre = $data['nombre'];
        $paterno= $data['paterno'];
        $materno = $data['materno'];
        $identificador = $data['identificador'];
        $this->validate(
            $data, 
            [
                'nombre' => 'required',
                'paterno' => 'required',
                'materno' => 'required',
                'identificador' => 'required'     
            ],
            [
                'nombre.required' => 'El NOMBRE es un campo requerido',
                'paterno.required' => 'El APELLIDO PATERNO es un campo requerido',
                'materno.required' => 'El APELLIDO MATENRO es un campo requerido',
                'identificador.required' => 'La NUMERO de EMPLEADO es un campo requerido'
            ]
        );
        DB::table('evaluadores')
        ->where('id', $sinodal)
        ->update([
            'nombre' => $nombre,
            'paterno' => $paterno,
            'materno' => $materno,
            'identificador' => $identificador
        ]);
    }


}
