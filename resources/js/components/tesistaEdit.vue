<template>
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Editando: {{tesista.nombre + ' ' + tesista.paterno + ' '+ tesista.materno}}</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" v-on:click="cerrar()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nombre">Nombre(s)</label>
                    <input type="text" class="form-control" id="nombre" v-model="tesista.nombre" placeholder="Nombre">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.nombre">
                        {{errores.nombre[0]}}
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
                    <input type="text" class="form-control" id="mail" disabled v-model="tesista.email" placeholder="Email@">
                </div>
                <div class="form-group col-md-6">
                    <label for="cuenta">Numero de cuenta</label>
                    <input type="text" class="form-control" v-model="tesista.cuenta" id="cuenta" placeholder="Paterno">
                    <small id="passwordHelpBlock" class="form-text text-muted" v-if="errores.cuenta">
                        {{errores.cuenta[0]}}
                    </small>
                </div>
            </div>
            <div>
                <select class="form-control form-control-sm" v-model="tesista.carrera">
                    <option v-for="carrera in carreras" :key="carrera.id" :value="carrera.id">{{carrera.descripcion}}</option>
                </select>
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
            tesista: 0,
            carreras: [],
            estado: 0,
            errores: []
        }
    },
    methods:{
        getTesita(){
            let url = `/tesista_info/${this.info}`;
            axios.get(url).then(response => {
                this.tesista = response.data[0];
            }).catch(error => {
                    console.log(error.response)
            });
        },
        getCarreras(){
            let url = `/get_carreras`;
            axios.get(url).then(response => {
                this.carreras = response.data;
            }).catch(error => {
                    console.log(error.response)
            });
        },
        putTesista(){
            let url = `/tesista_put_cascade`;
            axios.put(url,
                {tesista:this.tesista.id,
                nombre:this.tesista.nombre,
                paterno:this.tesista.paterno,
                materno:this.tesista.materno,
                cuenta:this.tesista.cuenta,
                carrera:this.tesista.carrera,
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
        this.getTesita();
        this.getCarreras();
    }
}
</script>

