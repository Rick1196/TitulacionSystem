<template>
    <div class="container"> 
        <div class="container">
            <cabeza :usr="usr" v-model="protocolo.tema" tipo="Reporte de residencia de investigación"></cabeza>
        </div>
         <div class="form-group">
            <label for="exampleInputEmail1">Periodo de participación </label>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Fecha de inicio</label>
                    <input type="date" v-model="protocolo.inicio" class="form-control" id="inputEmail4" >
                    <small id="passwordHelpBlock" class="form-text text-muted " v-if="errores.inicio">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.inicio[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Fecha de fin</label>
                    <input type="date" v-model="protocolo.fin" class="form-control" id="inputPassword4">
                    <small id="passwordHelpBlock" class="form-text text-muted " v-if="errores.fin">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.fin[0]}}
                        </div>
                    </small>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre del profesor investigador responsable del proyecto</label>
            <input type="text"  class="form-control" v-model="protocolo.responsable" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre del Profesor Investigador activo en el Sistema Nacional de Investigadores u organismo similar.">
            <small id="passwordHelpBlock" class="form-text text-muted " v-if="errores.responsable">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.responsable[0]}}
                </div>
            </small>
        </div>
       <div class="form-group">
            <label for="exampleInputEmail1">Área académica</label>
            <select class="form-control custom-select my-1 mr-sm-2" v-model="protocolo.area"  id="exampleFormControlSelect1">
                <option v-for="area in areas" :key="area.id" :value="area.id">{{area.nombre}}</option>
            </select>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.area">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.area[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Asesor</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="protocolo.asesor.nombre"  disabled placeholder="Nombre del asesor adscrito a la UAEM (propuesto por el sustentante)." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary"  type="button btn-primary btn-md" v-on:click="asignacion = 0" data-toggle="modal" data-target="#buscador">Buscar <i class="fas fa-search"></i></button>
                </div>
            </div>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.asesor">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.asesor[0]}}
                </div>
            </small>
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Coasesor</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" v-model="protocolo.coasesor.nombre"   disabled placeholder="Nombre del coasesor adscrito a la UAEM (propuesto por el sustentante)." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary"  type="button" v-on:click="asignacion = 1" data-toggle="modal" data-target="#buscador">Buscar <i class="fas fa-search"></i></button>
                </div>
            </div>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.coasesor">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.coasesor[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Título del proyecto de investigación</label>
            <input type="text"  class="form-control" v-model="protocolo.titulo_proyecto" id="exampleInputEmail1" aria-describedby="emailHelp" >
            <small id="passwordHelpBlock" class="form-text text-muted " v-if="errores.titulo_proyecto">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.titulo_proyecto[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Clave de registro del proyecto</label>
            <input type="text"  class="form-control" v-model="protocolo.clave" id="exampleInputEmail1" aria-describedby="emailHelp" >
            <small id="passwordHelpBlock" class="form-text text-muted " v-if="errores.clave">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.clave[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Descripción general del proyecto de investigación</label>
            <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.desc" :init="{plugins: 'table help'}" 
            initial-value="
            Exponer de manera general los antecedentes y el objetivo del proyecto de investigación al que se incorporó.  
            "></editor>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.desc">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.desc[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Título del reporte de residencia de investigación</label>
            <input type="text"  class="form-control" v-model="protocolo.titulo_reporte" id="exampleInputEmail1" aria-describedby="emailHelp" >
            <small id="passwordHelpBlock" class="form-text text-muted " v-if="errores.titulo_reporte">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.titulo_reporte[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Objetivo general de la residencia</label>
            <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.obj" :init="{plugins: 'table help'}" 
            initial-value="
            Incluir verbo en infinitivo que sea medible u observable.
            "></editor>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.obj">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.obj[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Planificación de actividades</label>
            <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk"  v-model="protocolo.crono" :init="{plugins: 'table help'}"></editor>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.crono">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.crono[0]}}
                </div>
            </small>
        </div>
        <div class="alert alert-warning" role="alert">
            <p>
            El tema tendrá una vigencia de dos años, a partir de la fecha de aceptación (Ver Art. 86, Fracc. VII, del Reglamento de Evaluación Profesional).
            </p>
        </div>
        <button type="button" class="btn btn-primary btn-lg btn-block" v-on:click="guardar()">Guardar y Terminar</button>

        <!--Modal para seleccion de profesores -->
        <div class="modal fade  bd-example-modal-lg" id="buscador" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Buscando profesor <i class="fas fa-search"></i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="filter.nombre" data-toggle="tooltip" data-placement="bottom" title="Opcional" placeholder="Nombre">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" disabled type="button btn-primary">Buscar <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div class="list-group">
                        <button v-on:click="asigna(teacher)" v-for=" teacher in filteredTeachers" :key="teacher.id" class="list-group-item list-group-item-action">
                            {{teacher.nombre}}
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Terminar</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue';
import { constants } from 'crypto';
import Header from './encabezado.vue';
export default {
    props:['usr'],
    components: {
        'editor': Editor, // <- Important part
        'cabeza': Header
     },
     data(){
         return {
            areas:[],
            sinodales:[],
            filter:{
                nombre:'',
            },
            asignacion: 0, //0 -> asesor, 1->coasesor
            protocolo:{
                inicio:'',
                fin:'',
                titulo_proyecto:'',
                area:'',
                asesor:{
                    id:'',
                    nombre:'',
                },
                coasesor:{
                    id:'',
                    nombre:'',
                },
                responsable:'',
                desc:'',
                titulo_reporte:'',
                obj:'',
                crono:'',
                tema:'',
                sus:[]
            },
            errores:[],
         }
     },
     methods:{
        getAreas(){
            let url = `/areas`;
            axios.get(url).then(response => {
                this.areas = response.data;
                this.protocolo.area = this.areas[0].id;
            }).catch(error => {
                    console.log(error.response)
            });
        },
        getSinodales(){
            let url = `/sinodales`;
            axios.get(url).then(response => {
            this.sinodales = response.data;
        }).catch(error => {
                console.log(error.response)
        });
        },
        asigna(sinodal){
            if(this.asignacion == 0){
                this.protocolo.asesor.id = sinodal.id;
                this.protocolo.asesor.nombre = sinodal.nombre;
            }else{
                this.protocolo.coasesor.id = sinodal.id;
                this.protocolo.coasesor.nombre = sinodal.nombre;
            }
        },
        guardar(){
            let url = `/postResInv`;
            axios.post(url,
                {
                    inicio:this.protocolo.inicio,
                    fin:this.protocolo.fin,
                    titulo_proyecto:this.protocolo.titulo_proyecto,
                    area:this.protocolo.area,
                    asesor:this.protocolo.asesor.id,
                    coasesor:this.protocolo.coasesor.id,
                    responsable:this.protocolo.responsable,
                    desc:this.protocolo.desc,
                    titulo_reporte:this.protocolo.titulo_reporte,
                    obj:this.protocolo.obj,
                    crono:this.protocolo.crono,
                    tema:this.protocolo.tema,
                    sus:this.protocolo.sus,
                    clave:this.protocolo.clave,
                    usr:this.usr
                }
            ).then(response => {
               this.errores = [];
               /*
               this.protocolo={
                    titulo:'',
                    area:'',
                    asesor:{
                        id:'',
                        nombre:'',
                    },
                    coasesor:{
                        id:'',
                        nombre:'',
                    },
                    revista:'',
                    indice:'',
                    desc:'',
                    refs:'',
                    tema:'',
                    sus:[]
                };*/
            alert("Su protocolo ha sido registrado exitosamente")
            window.location.href = `/tesista/protocolos_listar/${this.usr}`;
            }).catch(error => {
                console.log(error.response)
                this.errores = error.response.data.errors
                this.$root.$emit('error',this.errores.tema);
            });
        }

     },
    computed: {
        filteredTeachers() {
            return this.sinodales.filter((sinodal) => {
                return sinodal.nombre.toLowerCase().includes(this.filter.nombre.toLowerCase());
            })
        }
    },
     mounted(){
         this.getAreas();
         this.getSinodales();
         this.$root.$on('alumno',(id) => {
            this.protocolo.sus.push(id)
        });
     }
}
</script>



