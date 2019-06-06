<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use View;
class ProtocolosController extends Controller
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

    public function protocolos_listar($usr)
    {
        //en esta funcion debe de ir un union para todas las tablas de los protocolo
        $protocolos = DB::table('sustentando')
        ->join('articulo','sustentando.id' ,'=','articulo.sustentando')
        ->join('versiones' , 'sustentando.id', '=','versiones.sustentado')
        ->join('sustentantes_sustentando', 'versiones.id', '=', 'sustentantes_sustentando.version')
        ->join('sustentantes' , 'sustentantes_sustentando.sustentante', '=', 'sustentantes.id')
        ->where('usuario',$usr)->orderBy('versiones.fecha','ASC')->paginate(10);
        return  View::make("tesista/protocolos",compact('protocolos'));
    }

    public function postArticulo(Request $request){
        $this->validate(
            $request, 
            [
                'tema' => 'required',
                'titulo' => 'required',
                'area' => 'required',
                'asesor' => 'required',
                'coasesor' => 'required',   
                'revista' => 'required',
                'indice' => 'required',  
                'desc' => 'required', 
                'refs' => 'required' 
            ],
            [
                'tema.required' => 'Indicar el tema es necesario',
                'titulo.required' => 'Un TITULO es requerido',
                'area.required' => 'Seleccionar un AREA academica es necesario',
                'asesor.required' => 'Seleccionar un asesor es necesario',
                'coasesor.required' => 'Seleccionar un coasesor es necesario',
                'revista.required' => 'El nombre de la revista es necesario',
                'indice.required' => 'El indice es necesario',
                'desc.required' => 'Una descripcion es necesaria',
                'refs.required' => 'Indicar tus referencias es necesario',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('sustentando')->insertGetId(
            ['tema' => $request['tema'], 
            'fecha_alta' => Carbon::now()]
        );
        //registrar tipo protocolo
        DB::table('articulo')->insert(
            [
                'titulo_tentativo' => $request['titulo'], 
                'asesor' => $request['asesor'],
                'coasesor' => $request['coasesor'],
                'revista' => $request['revista'],
                'indice' => $request['indice'],
                'descripcion' => $request['desc'],
                'referencias' => $request['refs'],
                'area' =>$request['area'],
                'sustentando' => $sustentando
            ]   
        );
        $version = DB::table('versiones')->insertGetId(
            ['sustentado' => $sustentando, 
            'fecha' => Carbon::now()]
        );
        foreach ($request['sus'] as $sustentante) {
            DB::table('sustentantes_sustentando')->insert(
                ['sustentante' => $sustentante, 
                'version' => $version]
            );
        }

    }

    public function postEnsayo(Request $request){
        $this->validate(
            $request, 
            [
                'tema' => 'required',
                'area' => 'required',
                'asesor' => 'required',
                'desc' => 'required',   
                'just' => 'required',
                'crono' => 'required',  
                'refs' => 'required' 
            ],
            [
                'tema.required' => 'Indicar el tema es necesario',
                'area.required' => 'Seleccionar un AREA academica es necesario',
                'asesor.required' => 'Seleccionar un asesor es necesario',
                'desc.required' => 'Una descripcion es necesaria',
                'just.required' => 'Una justificacion es necesaria',
                'crono.required' => 'Presentar un cronograma es necesaro',
                'refs.required' => 'Indicar tus referencias es necesario',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('sustentando')->insertGetId(
            ['tema' => $request['tema'], 
            'fecha_alta' => Carbon::now()]
        );
        //registrar tipo protocolo
        DB::table('ensayo')->insert(
            [
                'tema' => $request['titulo'], 
                'asesor' => $request['asesor'],
                'area' => $request['area'],
                'descripcion' => $request['desc'],
                'justificacion' => $request['just'],
                'cronograma' => $request['crono'],
                'referencias' => $request['refs'],
                'sustentando' => $sustentando
            ]   
        );
        $version = DB::table('versiones')->insertGetId(
            ['sustentado' => $sustentando, 
            'fecha' => Carbon::now()]
        );
        foreach ($request['sus'] as $sustentante) {
            DB::table('sustentantes_sustentando')->insert(
                ['sustentante' => $sustentante, 
                'version' => $version]
            );
        }

    }

    public function postExpLab(Request $request){
        $this->validate(
            $request, 
            [
                'tema' => 'required',
                'inicio' => 'required',
                'fin' => 'required',
                'area' => 'required',
                'asesor' => 'required',
                'desc_exp' => 'required', 
                'refs' => 'required',
                'just' => 'required',
                'crono' => 'required',
                'obj' => 'required',
            ],
            [
                'tema.required' => 'Indicar el tema es necesario',
                'inicio.required' => 'Indicar el inicio de la experiencia',
                'fin.required' => 'indicar el final de la experiencia',
                'area.required' => 'Seleccionar un AREA academica es necesario',
                'asesor.required' => 'Seleccionar un asesor es necesario',
                'desc_exp.required' => 'Describir la experiencia laboral',
                'just.required' => 'Indicar una justificacion',
                'refs.required' => 'Indicar las referencias/bibliografia',
                'crono.required' => 'Indicar tu cronograma de actividades',
                'obj.required' => 'Indicar el objetivo de la experiencia laboral',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('sustentando')->insertGetId(
            ['tema' => $request['tema'], 
            'fecha_alta' => Carbon::now()]
        );
        //registrar tipo protocolo
        DB::table('memoria_laboral')->insert(
            [
                'inicio' => $request['inicio'], 
                'fin' => $request['fin'],
                'asesor' => $request['asesor'],
                'area' => $request['area'],
                'desc_experiencia' => $request['desc_exp'],
                'justificacion' => $request['just'],
                'objetivo' => $request['obj'],
                'referencias' =>$request['refs'],
                'cronograma' =>$request['crono'],
                'sustentando' => $sustentando
            ]   
        );
        $version = DB::table('versiones')->insertGetId(
            ['sustentado' => $sustentando, 
            'fecha' => Carbon::now()]
        );
        foreach ($request['sus'] as $sustentante) {
            DB::table('sustentantes_sustentando')->insert(
                ['sustentante' => $sustentante, 
                'version' => $version]
            );
        }

    }

    public function postAppCon(Request $request){
        $this->validate(
            $request, 
            [
                'tema' => 'required',
                'titulo' => 'required',
                'asesor' => 'required',
                'plant' => 'required',
                'just' => 'required',
                'obj' => 'required', 
                'metodologia' => 'required',
                'refs' => 'required',
                'crono' => 'required',
                'obj' => 'required',
            ],
            [
                'tema.required' => 'Indicar el tema es necesario',
                'titulo.required' => 'Indicar el titulo del reporte',
                'asesor.required' => 'indicar un asesor',
                'plant.required' => 'Describir un planteamiento',
                'just.required' => 'Describir una justificacion',
                'obj.required' => 'Describir un objetivo',
                'metodologia.required' => 'Describir una metodologia',
                'refs.required' => 'Indicar las referencias utilizadas',
                'crono.required' => 'Indicar tu cronograma de actividades',
                'obj.required' => 'Indicar el objetivo de la experiencia laboral',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('sustentando')->insertGetId(
            ['tema' => $request['tema'], 
            'fecha_alta' => Carbon::now()]
        );
        //registrar tipo protocolo
        DB::table('aplicacion_conocimiento')->insert(
            [
                'titulo' => $request['titulo'], 
                'asesor' => $request['asesor'],
                'area' => $request['area'],
                'planteamiento' => $request['plant'],
                'justificacion' => $request['just'],
                'objetivo' => $request['obj'],
                'metodologia' => $request['metodologia'],
                'referencias' =>$request['refs'],
                'cronograma' =>$request['crono'],
                'sustentando' => $sustentando
            ]   
        );
        $version = DB::table('versiones')->insertGetId(
            ['sustentado' => $sustentando, 
            'fecha' => Carbon::now()]
        );
        foreach ($request['sus'] as $sustentante) {
            DB::table('sustentantes_sustentando')->insert(
                ['sustentante' => $sustentante, 
                'version' => $version]
            );
        }

    }

    public function postRepAut(Request $request){
        $this->validate(
            $request, 
            [
                'tema' => 'required',
                'titulo' => 'required',
                'inicio' => 'required',
                'fin' => 'required',
                'asesor' => 'required',
                'area' => 'required', 
                'plant' => 'required',
                'just' => 'required',
                'obj' => 'required',
                'crono' => 'required',
                'refs' => 'required',
            ],
            [
                'tema.required' => 'Indicar el tema es necesario',
                'titulo.required' => 'Indicar el titulo del reporte',
                'inicio.required' => 'indicar un la fecha de inicio',
                'fin.required' => 'indicar la fecha de termino',
                'asesor.required' => 'Indicar un asesor',
                'area.required' => 'Indicar un area administrativa',
                'plant.required' => 'Describir un planteamiento',
                'just.required' => 'Describir una justificacion',
                'obj.required' => 'Describir un objetivo',
                'refs.required' => 'Indicar las referencias utilizadas',
                'crono.required' => 'Indicar tu cronograma de actividades'
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('sustentando')->insertGetId(
            ['tema' => $request['tema'], 
            'fecha_alta' => Carbon::now()]
        );
        //registrar tipo protocolo
        DB::table('autoempleo')->insert(
            [
                'titulo' => $request['titulo'], 
                'inicio' => $request['inicio'],
                'fin' => $request['fin'],
                'asesor' => $request['asesor'],
                'area' => $request['area'],
                'planteamiento' => $request['plant'],
                'justificacion' => $request['just'],
                'objetivo' => $request['obj'],
                'referencias' =>$request['refs'],
                'cronograma' =>$request['crono'],
                'sustentando' => $sustentando
            ]   
        );
        $version = DB::table('versiones')->insertGetId(
            ['sustentado' => $sustentando, 
            'fecha' => Carbon::now()]
        );
        foreach ($request['sus'] as $sustentante) {
            DB::table('sustentantes_sustentando')->insert(
                ['sustentante' => $sustentante, 
                'version' => $version]
            );
        }

    }

    public function postResInv(Request $request){
        $this->validate(
            $request, 
            [
                'tema' => 'required',
                'responsable' => 'required',
                'asesor' => 'required',
                'coasesor' => 'required',
                'area' => 'required',
                'titulo_proyecto' => 'required', 
                'desc' => 'required',
                'titulo_reporte' => 'required',
                'obj' => 'required',
                'crono' => 'required',
                'refs' => 'required',
            ],
            [
                'tema.required' => 'Indicar el tema es necesario',
                'responsable.required' => 'Indicar un responsable de la residencia de investigacion',
                'asesor.required' => 'Indicar un asesor',
                'coasesor.required' => 'indicar un coasesor',
                'area.required' => 'indicar un area academica',
                'titulo_proyecto.required' => 'indicar el titulo de proyecto',
                'desc.required' => 'Describir el proyecto',
                'titulo_reporte.required' => 'indicar el titulo del reporte',
                'obj.required' => 'Describir un objetivo',
                'refs.required' => 'Indicar las referencias utilizadas',
                'crono.required' => 'Indicar tu cronograma de actividades'
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('sustentando')->insertGetId(
            ['tema' => $request['tema'], 
            'fecha_alta' => Carbon::now()]
        );
        //registrar tipo protocolo
        DB::table('investigacion')->insert(
            [
                'responsable' => $request['responsable'], 
                'asesor' => $request['asesor'],
                'coasesor' => $request['coasesor'],
                'area' => $request['area'],
                'titulo_proyecto' => $request['area'],
                'descripcion' => $request['desc'],
                'titulo_reporte' => $request['titulo_reporte'],
                'objetivo' => $request['obj'],
                'referencias' =>$request['refs'],
                'cronograma' =>$request['crono'],
                'sustentando' => $sustentando
            ]   
        );
        $version = DB::table('versiones')->insertGetId(
            ['sustentado' => $sustentando, 
            'fecha' => Carbon::now()]
        );
        foreach ($request['sus'] as $sustentante) {
            DB::table('sustentantes_sustentando')->insert(
                ['sustentante' => $sustentante, 
                'version' => $version]
            );
        }

    }

    public function postTesina(Request $request){
        $this->validate(
            $request, 
            [
                'tema' => 'required',
                'titulo' => 'required',
                'asesor' => 'required',
                'area' => 'required',
                'plant' => 'required',   
                'just' => 'required',
                'obj' => 'required',  
                'metodologia' => 'required',  
                'crono' => 'required', 
                'refs' => 'required' 
            ],
            [
                'tema.required' => 'Indicar el tema es necesario',
                'titulo.required' => 'indicar un titulo es necesario',
                'asesor.required' => 'indicar un asesor es necesario',
                'area.required' => 'indicar un area es necesario',
                'plant.required' => 'describir un planteamiento',
                'just.required' => 'describir una justificacion',
                'obj.required' => 'describir un objetivo',
                'metodologia.required' => 'describir una metodologia',
                'crono.required' => 'Indicar tu cronograma de actividades',
                'refs.required' => 'Indicar tus referencias es necesario',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('sustentando')->insertGetId(
            ['tema' => $request['tema'], 
            'fecha_alta' => Carbon::now()]
        );
        //registrar tipo protocolo
        DB::table('tesina')->insert(
            [
                'titulo' => $request['titulo'], 
                'asesor' => $request['asesor'],
                'area' => $request['area'],
                'planteamiento' => $request['plant'],
                'justificacion' => $request['just'],
                'objetivo' => $request['obj'],
                'metodologia' => $request['metodologia'],
                'cronograma' => $request['crono'],
                'referencias' =>$request['refs'],
                'sustentando' => $sustentando
            ]   
        );
        $version = DB::table('versiones')->insertGetId(
            ['sustentado' => $sustentando, 
            'fecha' => Carbon::now()]
        );
        foreach ($request['sus'] as $sustentante) {
            DB::table('sustentantes_sustentando')->insert(
                ['sustentante' => $sustentante, 
                'version' => $version]
            );
        }

    }

    public function postTesis(Request $request){
        $this->validate(
            $request, 
            [
                'tema' => 'required',
                'titulo' => 'required',
                'asesor' => 'required',
                'coasesor' => 'required',
                'area' => 'required',
                'planteamiento' => 'required', 
                'just' => 'required',
                'hipotesis' => 'required',
                'obj' => 'required',
                'metodologia' => 'required',
                'crono' => 'required',
                'refs' => 'required',
            ],
            [
                'tema.required' => 'Indicar el tema es necesario',
                'titulo.required' => 'indicar un titulo',
                'asesor.required' => 'Indicar un asesor',
                'coasesor.required' => 'indicar un coasesor',
                'area.required' => 'indicar un area academica',
                'planteamiento.required' => 'describir un planteamiento',
                'just.required' => 'describir una justificacion',
                'hipotesis.required' => 'describir una hipotesis',
                'obj.required' => 'describir un objetivo',
                'metodologia.required' => 'describir una metodologia',
                'refs.required' => 'Indicar las referencias utilizadas',
                'crono.required' => 'Indicar tu cronograma de actividades'
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('sustentando')->insertGetId(
            ['tema' => $request['tema'], 
            'fecha_alta' => Carbon::now()]
        );
        //registrar tipo protocolo
        DB::table('tesis')->insert(
            [
                'titulo' => $request['titulo'], 
                'asesor' => $request['asesor'],
                'coasesor' => $request['coasesor'],
                'area' => $request['area'],
                'planteamiento' => $request['planteamiento'],
                'justificacion' => $request['just'],
                'hipotesis' => $request['hipotesis'],
                'objetivo' => $request['obj'],
                'metodologia' => $request['metodologia'],
                'referencias' =>$request['refs'],
                'cronograma' =>$request['crono'],
                'sustentando' => $sustentando
            ]   
        );
        $version = DB::table('versiones')->insertGetId(
            ['sustentado' => $sustentando, 
            'fecha' => Carbon::now()]
        );
        foreach ($request['sus'] as $sustentante) {
            DB::table('sustentantes_sustentando')->insert(
                ['sustentante' => $sustentante, 
                'version' => $version]
            );
        }

    }
}
