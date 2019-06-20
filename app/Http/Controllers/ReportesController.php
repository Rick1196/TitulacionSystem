<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use View;
use Carbon\Carbon;
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
       ->select('v.id as version','s.tema','s.fecha_alta','s.folio','s.id as sustentando','s.modalidad as modalidad','m.descripcion as mod_desc','m.id as mod')
       ->where('e.usuario',Auth::user()->id)
       ->orderBy('v.fecha','DESC')
       ->paginate(10);
       return View::make("sinodal/home",compact('protocolos'));
    }

    public function getTipos()
    {
        return DB::table('tipo_dictamen')->get();
    }

    public function getEval(Request $data)
    {
        $usr = $data['usr'];
        $sinodal = DB::table('evaluadores')
        ->join('users as u','evaluadores.usuario','=','u.id')
        ->where('u.id',$usr)->get();
        return $sinodal;
    }

    public function getReporte(Request $data)
    {   
        $version= $data['version'];
        $resumen = DB::select("select versiones.id version, modalidad from versiones inner join sustentando s on versiones.sustentado = s.id where versiones.id = :ver",['ver'=>$version])[0];
        return View::make("sinodal/reporte",compact('resumen'));
    }

    public function getData(Request $data){
        $resumen = NULL;
        $modo = $data['mod'];
        if($modo == 1){
            $version= $data['version'];
            $resumen = DB::select("SELECT   sustentando.tema tema,sustentando.modalidad modalidad, sustentando.folio folio, a.id art_id, a.titulo_tentativo titulo, a.revista revista, a.indice indice, a.descripcion descripcion, a.referencias refs ,  aa.nombre area,  UPPER(concat(e.nombre, ' ',e.paterno,' ' ,e.materno)) asesor, UPPER(concat(e2.nombre,' ' ,e2.paterno,' ' ,e2.materno))coasesor from sustentando inner join versiones v on sustentando.id = v.sustentado inner join articulo a on sustentando.id = a.sustentando inner join area_academica aa on a.area = aa.id inner join evaluadores e on a.asesor = e.id inner join evaluadores e2 on a.coasesor = e2.id inner join modalidades m on sustentando.modalidad = m.id where  v.id = :ver",['ver'=>$version]);
        }
        elseif($modo == 2){
            $version= $data['version'];
            $resumen = DB::select("SELECT aa.nombre area, sustentando.tema tema, sustentando.modalidad modalidad, sustentando.folio folio, a.id art_id, a.tema tema, a.descripcion descripcion, a.justificacion just, a.cronograma crono,a.referencias refs,UPPER(concat(e.nombre, ' ',e.paterno,' ' ,e.materno)) asesor from sustentando inner join versiones v on sustentando.id = v.sustentado inner join ensayo a on sustentando.id = a.sustentando inner join area_academica aa on a.area = aa.id inner join evaluadores e on a.asesor = e.id inner join modalidades m on sustentando.modalidad = m.id where  v.id = :ver",['ver'=>$version]);
        }
        elseif($modo == 3){
            $version= $data['version'];
            $resumen = DB::select("SELECT aa.nombre area, sustentando.tema tema, sustentando.modalidad modalidad, sustentando.folio folio, a.id art_id, a.inicio inicio, a.fin fin, a.desc_experiencia descripcion, a.justificacion just,a.objetivo obj, a.referencias refs,a.cronograma crono,UPPER(concat(e.nombre, ' ',e.paterno,' ' ,e.materno)) asesor from sustentando inner join versiones v on sustentando.id = v.sustentado inner join memoria_laboral a on sustentando.id = a.sustentando inner join area_academica aa on a.area = aa.id inner join evaluadores e on a.asesor = e.id inner join modalidades m on sustentando.modalidad = m.id where  v.id = :ver",['ver'=>$version]);
        }
        elseif ($modo == 4) {
            $version= $data['version'];
            $resumen = DB::select("SELECT aa.nombre area, sustentando.tema tema, sustentando.modalidad modalidad, sustentando.folio folio, a.id art_id,a.titulo titulo,a.planteamiento plant, a.justificacion just, a.objetivo obj, a.metodologia metodologia, a.referencias refs, a.cronograma crono ,UPPER(concat(e.nombre, ' ',e.paterno,' ' ,e.materno)) asesor from sustentando inner join versiones v on sustentando.id = v.sustentado inner join aplicacion_conocimiento a on sustentando.id = a.sustentando inner join area_academica aa on a.area = aa.id inner join evaluadores e on a.asesor = e.id inner join modalidades m on sustentando.modalidad = m.id where  v.id = :ver",['ver'=>$version]);
        }elseif ($modo == 5) {
            $version= $data['version'];
            $resumen = DB::select("SELECT aa.nombre area, sustentando.tema tema, sustentando.modalidad modalidad, sustentando.folio folio, a.id art_id,a.titulo titulo, a.inicio inicio, a.fin fin, a.planteamiento plant, a.justificacion just, a.objetivo obj, a.referencias refs, a.cronograma crono,UPPER(concat(e.nombre, ' ',e.paterno,' ' ,e.materno)) asesor from sustentando inner join versiones v on sustentando.id = v.sustentado inner join autoempleo a on sustentando.id = a.sustentando inner join area_academica aa on a.area = aa.id inner join evaluadores e on a.asesor = e.id inner join modalidades m on sustentando.modalidad = m.id where  v.id = :ver",['ver'=>$version]);
        }elseif ($modo == 6) {
            $version= $data['version'];
            $resumen = DB::select("SELECT aa.nombre area, sustentando.tema tema, sustentando.modalidad modalidad, sustentando.folio folio, a.id art_id,a.responsable responsable,a.titulo_proyecto titulo_proyecto, a.descripcion descripcion, a.titulo_reporte titulo_reporte, a.objetivo obj, a.clave clave, a.inicio inicio,a.fin fin , a.cronograma crono,UPPER(concat(e.nombre, ' ',e.paterno,' ' ,e.materno)) asesor,UPPER(concat(e2.nombre,' ' ,e2.paterno,' ' ,e2.materno))coasesor from sustentando inner join versiones v on sustentando.id = v.sustentado inner join investigacion a on sustentando.id = a.sustentando inner join area_academica aa on a.area = aa.id inner join evaluadores e on a.asesor = e.id inner join evaluadores e2 on a.coasesor = e2.id  inner join modalidades m on sustentando.modalidad = m.id where  v.id = :ver",['ver'=>$version]);
        }elseif ($modo == 7) {
            $version= $data['version'];
            $resumen = DB::select("SELECT aa.nombre area, sustentando.tema tema, sustentando.modalidad modalidad, sustentando.folio folio, a.id art_id,a.titulo titulo, a.planteamiento plant, a.justificacion just, a.objetivo obj,a.metodologia metodologia, a.referencias refs, a.cronograma crono,UPPER(concat(e.nombre, ' ',e.paterno,' ' ,e.materno)) asesor from sustentando inner join versiones v on sustentando.id = v.sustentado inner join tesina a on sustentando.id = a.sustentando inner join area_academica aa on a.area = aa.id inner join evaluadores e on a.asesor = e.id inner join modalidades m on sustentando.modalidad = m.id where  v.id = :ver",['ver'=>$version]);
        }elseif ($modo == 8) {
            $version= $data['version'];
            $resumen = DB::select("SELECT aa.nombre area, sustentando.tema tema, sustentando.modalidad modalidad, sustentando.folio folio, a.id art_id,a.titulo titulo,a.justificacion just,a.planteamiento planteamiento, a.objetivo obj, a.hipotesis, a.cronograma crono,a.metodologia metodologia,UPPER(concat(e.nombre, ' ',e.paterno,' ' ,e.materno)) asesor,UPPER(concat(e2.nombre,' ' ,e2.paterno,' ' ,e2.materno))coasesor from sustentando inner join versiones v on sustentando.id = v.sustentado inner join tesis a on sustentando.id = a.sustentando inner join area_academica aa on a.area = aa.id inner join evaluadores e on a.asesor = e.id inner join evaluadores e2 on a.coasesor = e2.id  inner join modalidades m on sustentando.modalidad = m.id where  v.id = :ver",['ver'=>$version]);
        }
        return $resumen;
    }

    public function postArticuloNo(Request $request){
        $this->validate(
            $request, 
            [
                'titulo'=>'required',
                'area'=>'required',
                'revista'=>'required',
                'indice'=>'required',
                'desc'=>'required',
                'refs'=>'required',
                'otras'=>'required',
                'sugerencias'=>'required' 
            ],
            [
                'titulo.required' => 'Indicar observaciones del titulo es necesario',
                'area.required' => 'Indicar observaciones del area es necesario',
                'revista.required' => 'Indicar observaciones de la revista es necesario',
                'indice.required' => 'Indicar observaciones del indice es necesario',
                'desc.required' => 'Indicar observaciones de la descripcion es necesario',
                'refs.required' => 'Indicar observaciones de las referencias es necesario',
                'otras.required' => 'Indicar otras observaciones  es necesario',
                'sugerencias.required' => 'Indicar sugerencias es necesario',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('reportes')->insertGetId(
            ['titulo' => $request['titulo'], 
            'fecha' => Carbon::now(),
            'sugerencias'=>$request['sugerencias'],
            'evalueador' =>$request['eval'],
            'dictamen' =>$request['dictamen'],
            'versiones' =>$request['version'],
            ]
        );
        //registrar tipo protocolo
        DB::table('obs_articulo')->insert(
            [
                'titulo_tentativo' => $request['titulo'], 
                'indice' => $request['indice'],
                'revista' => $request['revista'],
                'descripcion' => $request['desc'],
                'referencias' => $request['refs'],
                'area' => $request['area'],
                'otras' => $request['otras'],
                'sugerencias' => $request['sugs'],
                'reporte' => $sustentando
            ]   
        );

    }

    public function postTesinaNo(Request $request){
        $this->validate(
            $request, 
            [
                'titulo'=>'required',
                'area'=>'required',
                'plant'=>'required',
                'just'=>'required',
                'obj'=>'required',
                'metodologia'=>'required',
                'refs'=>'required',
                'crono'=>'required',
                'otras'=>'required'
            ],
            [
                'titulo.required' => 'Indicar observaciones del titulo es necesario',
                'area.required' => 'Indicar observaciones del area es necesario',
                'plant.required' => 'Indicar observaciones del planteamiento es necesario',
                'just.required' => 'Indicar observaciones de la justificacion es necesario',
                'obj.required' => 'Indicar observaciones del objetivo de actividades es necesario',
                'metodologia.required' => 'Indicar observaciones de la metodologia es necesario',
                'refs.required' => 'Indicar observaciones de las referencias es necesario',
                'crono.required' => 'Indicar observaciones del cronograma de actividades es necesario',
                'otras.required' => 'Indicar otras observaciones  es necesario',
                'sugerencias.required' => 'Indicar sugerencias es necesario',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('reportes')->insertGetId(
            ['titulo' => $request['titulo'], 
            'fecha' => Carbon::now(),
            'sugerencias'=>$request['sugerencias'],
            'evalueador' =>$request['eval'],
            'dictamen' =>$request['dictamen'],
            'versiones' =>$request['version'],
            ]
        );
        //registrar tipo protocolo
        DB::table('obs_tesina')->insert(
            [
                'titulo' => $request['titulo'], 
                'area' => $request['area'],
                'planteamiento' => $request['plant'],
                'justificacion' => $request['just'],
                'objetivo' => $request['obj'],
                'metodologia' => $request['metodologia'],
                'referencias' => $request['refs'],
                'cronograma' => $request['area'],
                'otras' => $request['otras'],
                'sugerencias' => $request['sugs'],
                'reporte' => $sustentando
            ]   
        );

    }

    public function postEnsayoNo(Request $request){
        $this->validate(
            $request, 
            [
                'tema'=>'Ninguna',
                'area'=>'Ninguna',
                'desc'=>'Ninguna',
                'just'=>'Ninguna',
                'refs'=>'Ninguna',
                'crono'=>'Ninguna',
                'otras'=>'Ninguna',
                'sugerencias'=>'Ninguna'
            ],
            [
                'tema.required' => 'Indicar observaciones del titulo es necesario',
                'area.required' => 'Indicar observaciones del area es necesario',
                'desc.required' => 'Indicar observaciones de la descripcion es necesario',
                'just.required' => 'Indicar observaciones de la justificacion es necesario',
                'crono.required' => 'Indicar observaciones del cronograma de actividades es necesario',
                'refs.required' => 'Indicar observaciones de las referencias es necesario',
                'otras.required' => 'Indicar otras observaciones  es necesario',
                'sugerencias.required' => 'Indicar sugerencias es necesario',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('reportes')->insertGetId(
            ['titulo' => $request['titulo'], 
            'fecha' => Carbon::now(),
            'sugerencias'=>$request['sugerencias'],
            'evalueador' =>$request['eval'],
            'dictamen' =>$request['dictamen'],
            'versiones' =>$request['version'],
            ]
        );
        //registrar tipo protocolo
        DB::table('obs_ensayo')->insert(
            [
                'tema' => $request['titulo'], 
                'area' => $request['area'],
                'descripcion' => $request['desc'],
                'justificacion' => $request['just'],
                'referencias' => $request['refs'],
                'cronograma' => $request['area'],
                'otras' => $request['otras'],
                'sugerencias' => $request['sugs'],
                'reporte' => $sustentando
            ]   
        );

    }

    public function postAutoNo(Request $request){
        $this->validate(
            $request, 
            [
                'titulo'=>'required',
                'periodo'=>'required',
                'area'=>'required',
                'plant'=>'required',
                'just'=>'required',
                'obj'=>'required',
                'refs'=>'required',
                'crono'=>'required',
                'otras'=>'required',
                'sugerencias'=>'required'
            ],
            [
                'titulo.required' => 'Indicar observaciones del titulo es necesario',
                'periodo.required' => 'Indicar observaciones del periodo de participacion es necesario',
                'area.required' => 'Indicar observaciones del area academica es necesario',
                'plant.required' => 'Indicar observaciones del planteamiento es necesario',
                'just.required' => 'Indicar observaciones de la justificacion es necesario',
                'obj.required' => 'Indicar observaciones del objetivo es necesario',
                'crono.required' => 'Indicar observaciones del cronograma de actividades es necesario',
                'refs.required' => 'Indicar observaciones de las referencias es necesario',
                'otras.required' => 'Indicar otras observaciones  es necesario',
                'sugerencias.required' => 'Indicar sugerencias es necesario',
            ]
        );
        //registrar en sustentando
        $sustentando = DB::table('reportes')->insertGetId(
            ['titulo' => $request['titulo'], 
            'fecha' => Carbon::now(),
            'sugerencias'=>$request['sugerencias'],
            'evalueador' =>$request['eval'],
            'dictamen' =>$request['dictamen'],
            'versiones' =>$request['version'],
            ]
        );
        //registrar tipo protocolo
        DB::table('obs_autoempleo')->insert(
            [
                'titulo' => $request['titulo'], 
                'periodo' => $request['periodo'],
                'area' => $request['area'],
                'planteamiento' => $request['plant'],
                'justificacion' => $request['just'],
                'objetivo' => $request['obj'],
                'otras' => $request['otras'],
                'sugerencias' => $request['sugs'],
                'reporte' => $sustentando
            ]   
        );

    }

    public function postAppNo(Request $request){
        //registrar en sustentando
        $sustentando = DB::table('reportes')->insertGetId(
            ['titulo' => $request['titulo'], 
            'fecha' => Carbon::now(),
            'sugerencias'=>$request['sugerencias'],
            'evaluador' =>$request['eval'],
            'dictamen' =>$request['dictamen'],
            'versiones' =>$request['version'],
            ]
        );
        //registrar tipo protocolo
        DB::table('obs_app_conocimiento')->insert(
            [
                'titulo' => $request['titulo'], 
                'area' => $request['area'],
                'planteamiento' => $request['plant'],
                'metodologia' => $request['metodologia'],
                'justificacion' => $request['just'],
                'objetivo' => $request['obj'],
                'referencias' => $request['refs'],
                'cronograma' => $request['crono'],
                'otras' => $request['otras'],
                'sugerencias' => $request['sugs'],
                'reporte' => $sustentando
            ]   
        );

    }

    public function postSi(Request $request){
        //registrar en sustentando
        $sustentando = DB::table('reportes')->insertGetId(
            ['titulo' => $request['titulo'], 
            'fecha' => Carbon::now(),
            'sugerencias'=>"Ninguna",
            'evaluador' =>$request['eval'],
            'dictamen' =>1,
            'versiones' =>$request['version'],
            ]
        );

    }
}
