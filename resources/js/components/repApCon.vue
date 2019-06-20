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
            <label for="exampleInputEmail1">Título</label>
            <input disabled type="text"  class="form-control" v-model="protocolo.titulo" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Especificar claramente el qué, es decir, el objeto de estudio.">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Asesor</label>
            <div class="input-group mb-3">
                <input disabled type="text" class="form-control" v-model="protocolo.asesor"  disabled placeholder="Nombre del asesor adscrito a la UAEM (propuesto por el sustentante)." aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary"  type="button btn-primary btn-md" v-on:click="asignacion = 0" data-toggle="modal" data-target="#buscador">Buscar <i class="fas fa-search"></i></button>
                </div>
            </div>
        </div>
        <div class="form-group">
                <label for="exampleInputEmail1">Área académica</label>
                <input disabled type="text"  class="form-control" disabled v-model="protocolo.area" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
        <div class="form-group">
            <label for="inputEmail4">Planteamiento del problema</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" initial-value="Exponer de manera general la problemática que se abordó y los conocimientos que se aplicaron para la resolución del problema. 
                Mostrar la actualidad y la relevancia del tema.
                Establecer la vinculación con el área de estudio." v-model="protocolo.plant" :init="{plugins: 'table help'}"></editor>
        </div>
        <div class="form-group">
            <label for="inputEmail4">Justificación</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" initial-value="Exponer de forma clara y concisa la importancia, el impacto, los beneficios y la aportación en la solución del problema, como resultado de la experiencia laboral. Así mismo, mencionar los alcances y limitaciones del problema descrito." 
            v-model="protocolo.just" :init="{plugins: 'table help'}"></editor>
        </div>
        <div class="form-group">
            <label for="inputEmail4">Objetivo general</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" initial-value="Indicar qué se logró con la aplicación del conocimiento. Incluir verbo en infinitivo que esté relacionado con el sentido de ‘documentar o describir’, entre otros." 
            v-model="protocolo.obj" :init="{plugins: 'table help'}"></editor>
        </div>
        <div class="form-group">
            <label for="inputEmail4">Metodología</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" initial-value="Describir las técnicas y los métodos para alcanzar el objetivo planteado." 
            v-model="protocolo.metodologia" :init="{plugins: 'table help'}"></editor>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Referencias y/o fuentes de información</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" initial-value="Citar las fuentes académicas oficiales consultadas (revistas, artículos, libros y páginas  de empresas e instituciones reconocidas) y definir el sistema de referencias seleccionado (Harvard, Chicago, Vancouver, APA, Sistema Numerado)." v-model="protocolo.refs" :init="{plugins: 'table help'}"></editor>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Planificación de actividades</label>
            <editor disabled api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" initial-value="Citar las fuentes académicas oficiales consultadas (revistas, artículos, libros y páginas  de empresas e instituciones reconocidas) y definir el sistema de referencias seleccionado (Harvard, Chicago, Vancouver, APA, Sistema Numerado)." v-model="protocolo.crono" :init="{plugins: 'table help'}"></editor>
        </div>


            <div class="alert alert-warning" role="alert" v-if="dictamen != 1">
                <p>
                    Indique lo más claro y preciso posible las correcciones que se deben realizar en cada apartado.
                        Si considera que no deben hacer correcciones, coloque la palabra Ninguna en el apartado correspondiente.
                </p>
            </div>

            <div v-if="dictamen != 1">
                <div class="form-group">
                    <label for="exampleInputEmail1">Titulo</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.titulo" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.titulo">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.titulo[0]}}
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
                    <label for="exampleInputEmail1">Planteamiento del problema</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.plant" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.plant">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.plant[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Justificación</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.just" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.just">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.just[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Objetivo general</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.just" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.just">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.just[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Metodología</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.metodologia" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.metodologia">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.metodologia[0]}}
                        </div>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Referencias y/o fuentes de información</label>
                    <editor  api-key="nbugyxrcgxzt221o0ipcx4yj8r0zsnth1nyfrn4bv9zpodwk" v-model="cosas.refs" :init="{plugins: 'table help'}"></editor>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.refs">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.refs[0]}}
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
                titulo:'Ninguna',
                area:'Ninguna',
                plant:'Ninguna',
                metodologia:'Ninguna',
                just:'Ninguna',
                obj:'Ninguna',
                refs:'Ninguna',
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
                    titulo:this.protocolo.titulo,
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


