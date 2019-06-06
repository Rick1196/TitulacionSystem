<template>
    <div class="container">
      <div class="container">
                <cabeza :usr="usr" v-model="protocolo.tema" tipo="Artículo especializado para publicar en revista indizada"></cabeza>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Título tentativo del artículo especializado</label>
                <input type="text"  class="form-control" v-model="protocolo.titulo" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Especificar claramente el qué, es decir, el objeto de estudio.">
                <small id="passwordHelpBlock" class="form-text text-muted " v-if="errores.titulo">
                    <div class="font-weight-bold text-uppercase"  style="color:red">
                        {{errores.titulo[0]}}
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


            <div class="form-row">
                <div class="col">
                    <label for="inputEmail4">Nombre de la revista indizada</label>
                    <input type="text" v-model="protocolo.revista"  class="form-control" >
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.revista">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.revista[0]}}
                        </div>
                    </small>
                </div>
                <div class="col">
                    <label for="inputEmail4">Nombre del índice</label>
                    <input type="text"  class="form-control" v-model="protocolo.indice" placeholder="Nombre y URL que avale la pertenencia de la revista  a algún índice">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.indice">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.indice[0]}}
                        </div>
                    </small>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Descripción general (resumen) del artículo especializado</label>
                <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.desc" :init="{plugins: 'table help'}" initial-value="Mencionar el contexto o antecedentes, planteamiento del problema, objetivos y metodología."></editor>
                <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.desc">
                    <div class="font-weight-bold text-uppercase"  style="color:red">
                        {{errores.desc[0]}}
                    </div>
                </small>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Referencias y/o fuentes de información</label>
                <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.refs" :init="{plugins: 'table help'}"></editor>
                <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.refs">
                    <div class="font-weight-bold text-uppercase"  style="color:red">
                        {{errores.refs[0]}}
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
        <div class="form-group">
              <label for="exampleInputEmail1">Título</label>
              <input type="text" disabled class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Debe especificar claramente el qué, es decir, el objeto de estudio.">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Asesor</label>
                <input type="text" disabled class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre del asesor adscrito a la UAEM (propuesto por el sustentante).">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Área académica</label>
                <input type="text" disabled class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="La que corresponda según la Coordinación de Docencia.">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Planteamiento de la investigación documental o traducción crítica</label>
                <textarea class="form-control" disabled id="exampleFormControlTextarea1" rows="3">
                  Presentar una descripción general del tema que se pretende abordar o traducir, con las características de una monografía.
                  Mostrar la actualidad y la relevancia del tema.
                  Establecer la vinculación con el área de estudio. 
                </textarea>
            </div>
            <div class="form-group">
              <label for="inputEmail4">Justificación</label>
              <textarea class="form-control" disabled id="exampleFormControlTextarea1" rows="3">
                Describir la necesidad de desarrollar el tema que se propone, a través de  una exposición clara y concisa sobre la importancia, el impacto y los beneficios de la investigación documental que se pretende realizar. Así mismo, mencionar los alcances y limitaciones de la investigación.
              </textarea>
            </div>
            <div class="form-group">
              <label for="inputEmail4">Objetivo general</label>
              <textarea class="form-control" disabled id="exampleFormControlTextarea1" rows="3">
                Indicar qué se pretende investigar. Incluir verbo en infinitivo que esté relacionado con el sentido de ‘describir, documentar’, entre otros.
              </textarea>
            </div>
            <div class="form-group">
              <label for="inputEmail4">Metodología</label>
              <textarea class="form-control" disabled id="exampleFormControlTextarea1" rows="3">
                Describir las técnicas y los métodos para alcanzar el objetivo planteado. 
              </textarea>
            </div>
            <div class="form-group">
              <label for="inputEmail4">Referencias y/o fuentes de información</label>
              <textarea class="form-control" disabled id="exampleFormControlTextarea1" rows="3">
                Citar las fuentes académicas oficiales consultadas (revistas, artículos, libros y páginas  de empresas e instituciones reconocidas) y definir el sistema de referencias seleccionado (Harvard, Chicago, Vancouver, APA, Sistema Numerado).
              </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Planificación de actividades</label>
                <input type="text" disabled class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Incluir la secuencia en que realizará las actividades relativas al trabajo. ">
            </div>
            <div class="alert alert-warning" role="alert">
                <p>
                El tema tendrá una vigencia de dos años, a partir de la fecha de aceptación (Ver Art. 86, Fracc. VII, del Reglamento de Evaluación Profesional).
                </p>
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
            let url = `/postArticulo`;
            axios.post(url,
                {
                    titulo:this.protocolo.titulo,
                    area:this.protocolo.area,
                    asesor:this.protocolo.asesor.id,
                    coasesor:this.protocolo.coasesor.id,
                    revista:this.protocolo.revista,
                    indice:this.protocolo.indice,
                    desc:this.protocolo.desc,
                    refs:this.protocolo.refs,
                    usr:this.usr,
                    tema:this.protocolo.tema,
                    sus:this.protocolo.sus
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



