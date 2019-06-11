<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use DB;
use View;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';
    public function redirectTo(){
        if(Auth::user()->hasRole('admin')){
            return '/admin';
        }elseif (Auth::user()->hasRole('tesista')) {
            return '/tesista';
        }elseif (Auth::user()->hasRole('titulacion')) {
            return '/titulacion/inicio';
        }
        elseif (Auth::user()->hasRole('sinodal')) {
            return '/sinodales/inicio';
        }
    
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {   
        /*
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'paterno' => ['required', 'string'],
            'materno' => ['required', 'string'],
            'carrera' => ['required'],
            'cuenta'=>['required', 'string', 'unique:sustentantes']
        ]);*/
        $rules = [
            'name' => 'required|string|max:255',
            'paterno' => 'required|string',
            'materno' => 'required|string',
            'email'=>'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'carrera' =>'required',
            'cuenta' => 'required|string|unique:sustentantes'
        ];
        $messages = [
            'name.required'=>'El nombre es necesario',
            'paterno.required'=>'El apellido paterno es necesario',
            'materno.required'=>'El apellido materno es necesario',
            'email.required'=>'El email es necesario',
            'email.email'=>'Ingrese un email valido',
            'email.unique'=>'El email ingresado ya esta en uso',
            'password.required'=>'El password es necesario',
            'password.min'=>'El password debe tener minimo 8 caracteres',
            'password.confirmed'=>'Los password no coinciden',
            'carrera.required'=>'Indicar una carrera es necesario',
            'cuenta.required'=>'Indicar el numero de cuenta es necesario',
            'cuenta.unique'=>'El numero de cuenta ya esta en uso'
        ];
        return Validator::make($data, $rules, $messages);
        /*
        return $this->validate(
            $data, 
            [
                'name' => 'required|string|max:255',
                'paterno' => 'required|string',
                'materno' => 'required|string',
                'email'=>'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
                'carrera' =>'required',
                'cuenta' => 'required|string|unique:sustentantes'
            ],
            [
                'name.required'=>'El nombre es necesario',
                'paterno.required'=>'El apellido paterno es necesario',
                'materno.required'=>'El apellido materno es necesario',
                'email.required'=>'El email es necesario',
                'email.email'=>'Ingrese un email valido',
                'email.unique'=>'El email ingresado ya esta en uso',
                'password.required'=>'El password es necesario',
                'password.min'=>'El password debe tener minimo 8 caracteres',
                'password.confirmed'=>'Los password no coinciden',
                'carrera.required'=>'Indicar una carrera es necesario',
                'cuenta.required'=>'Indicar el numero de cuenta es necesario',
                'cuenta.unique'=>'El numero de cuenta ya esta en uso'
            ]
        );*/
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->roles()->attach(Role::where('name', 'tesista')->first());
        DB::table('sustentantes')->insert(
            ['nombre'=>$data['name'],
            'paterno'=>$data['paterno'],
            'materno'=>$data['materno'],
            'cuenta'=>$data['cuenta'],
            'carrera'=>$data['carrera'],
            'usuario'=>$user->id
            ]

        );
        return $user;
    }

    public function registerLink()
    {
        $carreras = DB::table('carreras')->get();
        return  View::make("auth/register",compact('carreras'));
    }
}
