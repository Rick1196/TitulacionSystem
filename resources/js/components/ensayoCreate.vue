<template>
    <div class="container">
        <div class="container">
            <cabeza :usr="usr" v-model="protocolo.tema" tipo="Ensayo"></cabeza>
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
            <label for="inputEmail4">Descripción del tema</label>
            <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.desc" :init="{plugins: 'table help'}" initial-value="
                Presentar una descripción general del tema que se pretende abordar.
                Mostrar la actualidad y la relevancia del tema.
                Establecer la vinculación con el área de estudio.
            "></editor>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.desc">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.desc[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="inputEmail4">Justificación</label>
            <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.just" :init="{plugins: 'table help'}" initial-value="
                Describir la necesidad de abordar el tema, a través de  una exposición clara y concisa sobre la importancia, el impacto y los beneficios del ensayo que se pretende realizar. Así mismo, mencionar los alcances y limitaciones del tema.
            "></editor>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.just">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.just[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="inputEmail4">Referencias y/o fuentes de información</label>
            <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="protocolo.refs" :init="{plugins: 'table help'}"></editor>
            <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.refs">
                <div class="font-weight-bold text-uppercase"  style="color:red">
                    {{errores.refs[0]}}
                </div>
            </small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Planificación de actividades</label>
            <editor api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" initial-value="Citar las fuentes académicas oficiales consultadas (revistas, artículos, libros y páginas  de empresas e instituciones reconocidas) y definir el sistema de referencias seleccionado (Harvard, Chicago, Vancouver, APA, Sistema Numerado)." v-model="protocolo.crono" :init="{plugins: 'table help'}"></editor>
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
                area:'',
                asesor:{
                    id:'',
                    nombre:'',
                },
                desc:'',
                just:'',
                crono:'',
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
            let url = `/postEnsayo`;
            axios.post(url,
                {
                    area:this.protocolo.area,
                    asesor:this.protocolo.asesor.id,
                    desc:this.protocolo.desc,
                    just:this.protocolo.just,
                    crono:this.protocolo.crono,
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


