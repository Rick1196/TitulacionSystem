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
                    <input type="text" class="form-control" id="nombre" v-model="tesista.nombre" placeholder="Nombre">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.name">
                        {{errores.name[0]}}
                    </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="paterno">Apellido paterno</label>
                    <input type="text" class="form-control" v-model="tesista.paterno" id="paterno" placeholder="Paterno">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.paterno">
                        {{errores.paterno[0]}}
                    </small>
                </div>
                <div class="form-group col-md-4">
                    <label for="paterno">Apellido materno</label>
                    <input type="text" class="form-control" v-model="tesista.materno" id="materno" placeholder="Materno">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.materno">
                        {{errores.materno[0]}}
                    </small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="mail">E-mail</label>
                    <input type="text" class="form-control" id="mail"  v-model="tesista.email" placeholder="Email@">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.email">
                        {{errores.email[0]}}
                    </small>
                </div>
                <div class="form-group col-md-6">
                    <label for="cuenta">Password</label>
                    <input type="password" class="form-control" v-model="tesista.pass" id="cuenta" placeholder="Password">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.password">
                        {{errores.password[0]}}
                    </small>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cuenta">Numero de cuenta</label>
                    <input type="text" class="form-control" v-model="tesista.cuenta" id="cuenta" placeholder="Cuenta">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.cuenta">
                        {{errores.cuenta[0]}}
                    </small>
                </div>
                <div class="form-group col-md-6">
                    <label for="cuenta">Carrera</label>
                    <select class="form-control form-control-md" v-model="tesista.carrera">
                        <option v-for="carrera in carreras" :key="carrera.id" :value="carrera.id">{{carrera.descripcion}}</option>
                    </select>
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.carrera">
                        {{errores.carrera[0]}}
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
            tesista: {
                nombre:'',
                paterno:'',
                materno:'',
                cuenta:'',
                email:'',
                pass:'',
                carrera:''
            },
            estado: 0,
            errores: [],
            carreras:[]
        }
    },
    methods:{
        getCarreras(){
            let url = `/get_carreras`;
            axios.get(url).then(response => {
                this.carreras = response.data;
                this.tesista.carrera = this.carreras[0].id;
            }).catch(error => {
                    console.log(error.response)
            });
        },
        postTesista(){
            let url = `/tesistas`;
            axios.post(url,
                {tesista:this.tesista.id,
                name:this.tesista.nombre,
                paterno:this.tesista.paterno,
                materno:this.tesista.materno,
                cuenta:this.tesista.cuenta,
                password:this.tesista.pass,
                email:this.tesista.email,
                carrera:this.tesista.carrera
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
        this.getCarreras();
    }
}
</script>