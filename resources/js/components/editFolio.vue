<template>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Asignando</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" v-on:click="cerrar()">&times;</button>
        </div>
        <div class="modal-body">
            <br>
            <div class="container">
                <div class="form-group">
                    <label>Folio</label>
                    <input type="email" class="form-control" v-model="folio" id="exampleFormControlInput1" placeholder="Folio">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.folio">
                        <div class="font-weight-bold text-uppercase"  style="color:red">
                            {{errores.folio[0]}}
                        </div>
                    </small>
                </div>
                <label>Seleccionar evaluadores</label>
                <div class="input-group">
                    <input type="text" class="form-control" v-model="filter.nombre" data-toggle="tooltip" data-placement="bottom" title="Opcional" placeholder="Nombre">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" disabled type="button btn-primary">Buscar <i class="fas fa-search"></i></button>
                </div>
                </div>
                <div class="list-group">
                    <button  v-for=" teacher in filteredTeachers" :key="teacher.id" v-on:click="agrega(teacher)" class="list-group-item list-group-item-action">
                        {{teacher.nombre}}
                    </button>
                </div>
            </div>
            <br>
            <label>Seleccionados</label>
            <div class="container">
                <ul class="list-group">
                    <li class="list-group-item" v-for="(evalueador,index) in evalueadores" :key="evalueador.id">
                        {{evalueador.nombre}}
                             <button class="badge badge-primary badge-pill btn btn-primary" v-on:click="elimina(index)"><i class="far fa-trash-alt"></i></button>
                    </li>
                </ul>
            </div>
            <div class="alert alert-success" role="alert" v-if="estado === 1">
                    Registro exitoso!!
            </div>
        </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="cerrar()">Cancelar</button>
            <button type="button" class="btn btn-primary"  v-on:click="guardar()">Guardar</button>
        </div>
    </div>
</template>
<script>
export default {
    props:['proto'],
    data(){
        return{
            sinodales:[],
            filter:{
                nombre:'',
            },
            folio:'',
            evalueadores:[],
            errores:[],
            estado: 0,
        }
    },
    methods:{
        getSinodales(){
            let url = `/sinodales`;
            axios.get(url).then(response => {
                this.sinodales = response.data;
            }).catch(error => {
                    console.log(error.response)
            });
        },
        agrega(t){
            let b = false;
            this.evalueadores.forEach(evaluador => {
                if(evaluador.id === t.id){
                    b = true;
                }
            });
            if(b){
                alert('El evalueador ya fue seleccionado')
            }else{
                if(this.evalueadores.length < 3){
                    this.evalueadores.push(t);
                }else{
                    alert('Solo se tienen permitidos 3 evalueadores por protocolo')
                }
            }
        },
        elimina(index){
            this.evalueadores.splice(index,1);
        },
        guardar(){
            let url = `/postFolio`;
            if(this.evalueadores.length > 2){
                axios.post(url,
                    {
                        eva1:this.evalueadores[0].id,
                        eva2:this.evalueadores[1].id,
                        eva3:this.evalueadores[2].id,
                        folio:this.folio,
                        proto:this.proto
                    }
                ).then(response => {
                    this.errores = [];
                    this.estado = 1;
                    this.folio='';
                    this.evalueadores=[];
                }).catch(error => {
                    console.log(error.response)
                    this.errores = error.response.data.errors
                    this.$root.$emit('error',this.errores.tema);
                });
            }else{
                alert('Debe seleccionar tres evaluadores')
            }
        },
        cerrar(){
            location.reload();
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
        this.getSinodales();
    }
}
</script>

