<template>
    <div class="container">
        <div class="form-group">
            <label for="exampleInputEmail1">Nombre del evaluador</label>
            <h3>{{evaluador.nombre+' '+evaluador.paterno+' '+evaluador.materno}}</h3>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Folio del protocolo</label>
            <h3>{{folio}}</h3>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Dictamen</label>
            <select class="form-control custom-select my-1 mr-sm-2" v-model="dictamen" >
                <option v-for="dict in tipo_dictamen" :key="dict.id" :value="dict.id">{{dict.descripcion}}</option>
            </select>
        </div>
    </div>
</template>
<script>
import Editor from '@tinymce/tinymce-vue';
import { constants } from 'crypto';
export default {
    props:['usr','folio'],
    components: {
        'editor': Editor, // <- Important part
     },
    data(){
        return{
            evaluador:null,
            tipo_dictamen:[],
            sugerencias:'',
            obs:'',
            dictamen:0,
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
            axios.get(url+`${this.usr}`).then(response => {
                console.log(response.data[0])
                this.evaluador = response.data[0];
            }).catch(error => {
                    console.log(error)
            });
        },
    },
    mounted(){
        this.getTipos();
        this.getEval();
    }
}
</script>
