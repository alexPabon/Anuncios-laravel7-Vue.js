<template>
    <div class="pt-5">
        <errors-component
            v-if="errorFlag"
            :codig=errorCodig
            :mensaje=errorMsn
        ></errors-component>
        <div v-if="!errorFlag" class="container">
            <!-- Actulizar listas -->
            <div>
                <button 
                    @click="updateList"
                    class="btn btn-primary col-12 col-md-4 col-gl-2">Actualizar Lista</button>
                <small class="alert-success rounded">{{msnSuccess}}</small>
                <small class="alert-danger rounded">{{msnError}}</small>
            </div>  

            <!-- lista no autenticados -->
            <h1>todas las visitas</h1>
            <h5>visitante No autenticado</h5>
            <visitlist-component
            :visitors="visitors"
            :auth="visitorNoAuthoFlag">
            </visitlist-component>

            <!-- lista autenticado -->
            <h5>visitante autenticado</h5>
            <visitlist-component
            :visitors="visitorsAuth"
            :auth="visitorAuthFlag">
            </visitlist-component>
        </div>                
    </div>
    
</template>

<script>
export default {
    data(){
        return{

            /** visitantes */
            visitors:[],
            visitorsAuth:[],
            visitorAuthFlag:'',
            visitorNoAuthoFlag:'',

            /** Actualizar lista */
            msnSuccess:'',
            msnError:'',

            /**Error de permisos*/
            errorFlag:false,
            errorCodig:'',
            errorMsn:'',
        }
    },
    mounted(){
        axios.get('/allvisit')
            .then(response=>{
                console.log('carga correcta de visitantes')                
                this.visitors= response.data.noAuth;
                this.visitorNoAuthoFlag=0;

                this.visitorsAuth= response.data.auth;
                this.visitorAuthFlag= 1;
            })
            .catch(err=>{
                console.log('Error al cargar visitantes Inicial')
                console.log(err.response);                

                this.msnError= 'Se produjo un error al actulizar las listas';

                if(err.response.status==403 || err.response.status==401){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            })
    },
    methods:{
        updateList(){

            /** actualiza la informacion de los datos ip guardados */
            this.msnSuccess='';
            this.msnError='';

            axios.get('/visit')
            .then(response=>{
                console.log('carga correcta de visitantes')                
                this.msnSuccess = response.data.update;

                setTimeout(function(){ location.reload() }, 2000); 
            })
            .catch(err=>{
                console.log('Error al cargar visitantes')
                console.log(err.response);                

                if(err.response.status==403 || err.response.status==401){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            })
        }
    }
}
</script>