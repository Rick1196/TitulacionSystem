<template>
    <div class="container">
        <h1 class="text-center">
            <p>{{tipo}}</p>
        </h1>
        <div class="jumbotron">
            <h3>
            <p class="text-justified">
                Quien suscribe, {{' '+alumno.nombre.toUpperCase() + ' ' + alumno.paterno.toUpperCase() + ' ' + alumno.materno.toUpperCase()+' '}}, con número de cuenta: {{alumno.cuenta}} , pasante de: 
                {{alumno.descripcion.toUpperCase()}}
            </p>
            </h3>
            <h3>
                Mediante el presente, somete a su consideración el tema:
            </h3>
            <div class="form-group">
                <input type="text"  class="form-control"  :value="value" @input="$emit('input', $event.target.value)" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Tema">
                <small id="passwordHelpBlock" class="form-text text-muted " v-if="errores">
                    <div class="font-weight-bold text-uppercase"  style="color:red">
                        {{errores[0]}}
                    </div>
                </small>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['usr', 'tipo', 'value'],
    data(){
        return{
            alumno:{},
            tema:'',
            errores:[],
        }
    },
    methods:{
        getInfo(){
            let url = `/student_info/${this.usr}`;
            axios.get(url).then(response => {
            this.alumno = response.data[0];
            this.$root.$emit('alumno',this.alumno.id);
            }).catch(error => {
                console.log(error.response);
            });
        },
    },
    mounted(){
        this.getInfo();
        this.$root.$on('error',(error) => {
            this.errores = error;
        });
    }
}
</script>

