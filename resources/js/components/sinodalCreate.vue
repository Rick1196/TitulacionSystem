<template>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Creando</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" v-on:click="cerrar()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre(s)</label>
                    <input type="text" class="form-control" id="nombre" v-model="sinodal.nombre" placeholder="Nombre">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.name">
                        {{errores.name[0]}}
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
                    <input type="text" class="form-control" id="mail"  v-model="sinodal.email" placeholder="Email@">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.email">
                        {{errores.email[0]}}
                    </small>
                </div>
                <div class="form-group col-md-6">
                    <label for="cuenta">Password</label>
                    <input type="password" class="form-control" v-model="sinodal.pass" id="cuenta" placeholder="Password">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.password">
                        {{errores.password[0]}}
                    </small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cuenta">Identificador</label>
                    <input type="text" class="form-control" v-model="sinodal.identificador" id="cuenta" placeholder="Identificador">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.identificador">
                        {{errores.identificador[0]}}
                    </small>
                </div>
            </div>
            <br><br>
            <div class="alert alert-success" role="alert" v-if="estado === 1">
                    Creacion exitosa!!
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" v-on:click="cerrar()">Cerrar</button>
            <button type="submit" class="btn btn-primary" v-on:click="postTesista()">Guardar</button>
        </div>
    </div>
</template>
<script>
export default {
    props:['info'],
    data(){
        return{
            sinodal: {
                nombre:'',
                paterno:'',
                materno:'',
                identificador:'',
                email:'',
                pass:'',
            },
            estado: 0,
            errores: []
        }
    },
    methods:{
        postTesista(){
            let url = `/sinodales`;
            axios.post(url,
                {sinodal:this.sinodal.id,
                name:this.sinodal.nombre,
                paterno:this.sinodal.paterno,
                materno:this.sinodal.materno,
                identificador:this.sinodal.identificador,
                password:this.sinodal.pass,
                email:this.sinodal.email
                }
            ).then(response => {
               this.estado = 1;
               this.errores = [];
               
            }).catch(error => {
                console.log(error.response)
                this.errores = error.response.data.errors
            });

        },
        cerrar(){
            location.reload();
        }
    },
    mounted(){

    }
}
</script>