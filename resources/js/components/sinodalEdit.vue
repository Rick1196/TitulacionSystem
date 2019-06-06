<template>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Editando: {{sinodal.nombre + ' ' + sinodal.paterno + ' '+ sinodal.materno}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" v-on:click="cerrar()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre(s)</label>
                    <input type="text" class="form-control" id="nombre" v-model="sinodal.nombre" placeholder="Nombre">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.nombre">
                        {{errores.nombre[0]}}
                    </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="paterno">Apellido paterno</label>
                    <input type="text" class="form-control" v-model="sinodal.paterno" id="paterno" placeholder="Paterno">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.paterno">
                        {{errores.paterno[0]}}
                    </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="paterno">Apellido materno</label>
                    <input type="text" class="form-control" v-model="sinodal.materno" id="materno" placeholder="Materno">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.materno">
                        {{errores.materno[0]}}
                    </small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="mail">E-mail</label>
                    <input type="text" class="form-control" id="mail" disabled v-model="sinodal.email" placeholder="Email@">
                </div>
                <div class="form-group col-md-6">
                    <label for="cuenta">Numero de trabajador</label>
                    <input type="text" class="form-control" v-model="sinodal.identificador" id="cuenta" placeholder="Trabajador">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.identificador">
                        {{errores.identificador[0]}}
                    </small>
                </div>
            </div>
            <br><br>
            <div class="alert alert-success" role="alert" v-if="estado === 1">
                    Actualizacion exitosa!!
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="cerrar()">Cerrar</button>
            <button type="submit" class="btn btn-primary" v-on:click="putTesista()">Actualizar</button>
        </div>
    </div>
</template>
<script>
export default {
    props:['info'],
    data(){
        return{
            sinodal: 0,
            estado: 0,
            errores: []
        }
    },
    methods:{
        getSinodal(){
            let url = `/sinodal_info/${this.info}`;
            axios.get(url).then(response => {
                this.sinodal = response.data[0];
            }).catch(error => {
                    console.log(error.response)
            });
        },
        putTesista(){
            let url = `/sinodal_put_cascade`;
            axios.put(url,
                {sinodal:this.sinodal.id,
                nombre:this.sinodal.nombre,
                paterno:this.sinodal.paterno,
                materno:this.sinodal.materno,
                identificador:this.sinodal.identificador,
                }
            ).then(response => {
               this.estado = 1;
               this.errores = [];
               
            }).catch(error => {
                this.errores = error.response.data.errors
            });

        },
        cerrar(){
            location.reload();
        }
    },
    mounted(){
        this.getSinodal();
    }
}
</script>