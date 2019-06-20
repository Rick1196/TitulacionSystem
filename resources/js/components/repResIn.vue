<template>
    <div class="container">
        <div class="container">
            <div class="form-group">
                <label for="exampleInputEmail1">Nombre del evaluador</label>
                <h3>{{evaluador.nombre+' '+evaluador.paterno+' '+evaluador.materno}}</h3>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Folio del protocolo</label>
                <h3>{{protocolo.folio}}</h3>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Dictamen</label>
                <select class="form-control custom-select my-1 mr-sm-2" v-model="dictamen" >
                    <option v-for="dict in tipo_dictamen" :key="dict.id" :value="dict.id">{{dict.descripcion}}</option>
                </select>
            </div>
            <div class="form-group" v-if="dictamen === 4 || dictamen === 5">
                <label for="exampleInputEmail1">Observaciones</label>
                <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="obs" :init="{plugins: 'table help'}"></editor>
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Periodo de participación </label>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Fecha de inicio</label>
                    <input disabled type="date" v-model="protocolo.inicio" class="form-control" id="inputEmail4" >
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Fecha de fin</label>
                    <input disabled type="date" v-model="protocolo.fin" class="form-control" id="inputPassword4">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre del profesor investigador responsable del proyecto</label>
            <input disabled type="text"  class="form-control" v-model="protocolo.responsable" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre del Profesor Investigador activo en el Sistema Nacional de Investigadores u organismo similar.">
        </div>
        <div class="form-group">
                <label for="exampleInputEmail1">Área académica</label>
                <input type="text"  class="form-control" disabled v-model="protocolo.area" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Asesor</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="protocolo.asesor"  disabled placeholder="Nombre del asesor adscrito a la UAEM (propuesto por el sustentante)." aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Coasesor</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="protocolo.coasesor"   disabled placeholder="Nombre del coasesor adscrito a la UAEM (propuesto por el sustentante)." aria-label="Recipient's username" aria-describedby="basic-addon2">
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Título del proyecto de investigación</label>
            <input disabled type="text"  class="form-control" v-model="protocolo.titulo_proyecto" id="exampleInputEmail1" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Clave de registro del proyecto</label>
            <input disabled type="text"  class="form-control" v-model="protocolo.clave" id="exampleInputEmail1" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Descripción general del proyecto de investigación</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.desc" :init="{plugins: 'table help'}" 
            initial-value="
            Exponer de manera general los antecedentes y el objetivo del proyecto de investigación al que se incorporó.  
            "></editor>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Título del reporte de residencia de investigación</label>
            <input disabled type="text"  class="form-control" v-model="protocolo.titulo_reporte" id="exampleInputEmail1" aria-describedby="emailHelp" >
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Objetivo general de la residencia</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.obj" :init="{plugins: 'table help'}" 
            initial-value="
            Incluir verbo en infinitivo que sea medible u observable.
            "></editor>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Planificación de actividades</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk"  v-model="protocolo.crono" :init="{plugins: 'table help'}"></editor>
        </div>


            <div class="alert alert-warning" role="alert" v-if="dictamen != 1">
                <p>
                    Indique lo más claro y preciso posible las correcciones que se deben realizar en cada apartado.
                        Si considera que no deben hacer correcciones, coloque la palabra Ninguna en el apartado correspondiente.
                </p>
            </div>

            <div v-if="dictamen != 1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Titulo del proyecto de investigación</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.titulo_proyecto" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.titulo_proyecto">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.titulo_proyecto[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Área Académica</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.area" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.area">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.area[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Titulo del reporte de residencia de investigación</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.titulo_reporte" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.titulo_reporte">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.titulo_reporte[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Descripcion general</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.desc" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.desc">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.desc[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Objetivo general</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.obj" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.obj">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.obj[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Planificación de actividades</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.crono" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.crono">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.crono[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Otras</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.otras" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.otras">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.otras[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group" v-if="dictamen ===2">
                    <label for="exampleInputEmail1">Sugerencias</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="coas.sugs" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.sugs">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.sugs[0]}}
                        </div>
                    </small>
                </div>
            </div>
        <button type="button" class="btn btn-primary btn-lg btn-block" @click="guardar()">Guardar reporte</button>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue';
import { constants } from 'crypto';
export default {
    props:['modalidad','version','user'],
    components: {
        'editor': Editor, // <- Important part
     },
    data(){
        return{
            protocolo:'',
            errores:[],
            evaluador:null,
            tipo_dictamen:[],
            sugerencias:'',
            obs:'',
            dictamen:0,
            cosas:{
                titulo_proyecto:'Ninguna',
                titulo_reporte:'Ninguna',
                area:'Ninguna',
                desc:'Ninguna',
                obj:'Ninguna',
                crono:'Ninguna',
                otras:'Ninguna',
                sugerencias:'Ninguna'
            }
        }
    },
    methods:{
        getTipos(){
            let url = `/getTipos`;
            axios.get(url).then(response => {
                console.log(response.data[0])
                this.tipo_dictamen = response.data;
                this.dictamen = this.tipo_dictamen[0].id;
            }).catch(error => {
                    console.log(error)
            });
        },
        getEval(){
            let url = `/getEval/`;
            axios.get(url+`${this.user}`).then(response => {
                console.log(response.data[0])
                this.evaluador = response.data[0];
            }).catch(error => {
                    console.log(error)
            });
        },
        getInfo(){
            let url = `/get_info/`;
            axios.get(url+`${this.version}/${this.modalidad}`).then(response => {
                console.log(response.data[0])
                this.protocolo = response.data[0];
            }).catch(error => {
                    console.log(error)
            });
        },
        guardar(){
            if(this.dictamen === 1){
                let url = `/postSi`;
            axios.post(url,
                {
                    titulo:this.protocolo.tema,
                    sugerencias:'Ninguna',
                    evaluador:this.evaluador.id,
                    version:this.version
                }
                ).then(response => {
                this.errores = [];
                alert("Su reporte ha sido registrado exitosamente")
                window.location.href ='/sinodales/inicio';
                }).catch(error => {
                    console.log(error.response)
                    this.errores = error.response.data.errors
                    this.$root.$emit('error',this.errores.tema);
                });
            }else{
                alert("Reporte registrado exitosamente");
                window.location.href ='/sinodales/inicio';
            }
        }
    },
    mounted(){
        this.getInfo();
        this.getTipos();
        this.getEval();
    }
}
</script>




