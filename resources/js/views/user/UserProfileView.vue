<template>
    <div>
        <!-- Si hay errores al cargar -->
        <errors-component
            v-if="viewError"
            :codig=responseErrorCodig
            :mensaje=responseErrorMsn
        ></errors-component>
        <!-- Datos del usuario -->
        <div v-if="isAuthenticated" class="bg-gradient-bottom hg-10-container bg-info pt-4">
            <h1 class="text-center py-2">Perfil de Usuario</h1>         
            <transition-group name='slide-fade'>
                <!-- Componente de usuario -->
                <user-component
                    v-for="(usuario, index) in myProfile"
                    :key="usuario.id"
                    :usuario="usuario"                        
                    @delete="deleteUser(index, ...arguments)"
                    @cancelUpdate="cancelUpdateUser(index, ...arguments)">
                ></user-component>
            </transition-group>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            myProfile:[],
            responseErrorCodig:'',
            responseErrorMsn:'',
            viewError:false,
        }
    },
    mounted(){
        /**
         * Metodo para hacer que la pagina se recargue con los datos del usuario
         */
        let url = `/user/${this.user.id}`;                    

        /**Peticion GET */
        axios.get(url)
            .then(response => {                                                          
                this.myProfile = [response.data]; 
                viewError:false;             
            })
            .catch(err =>{
                    let msnErrores = err.response.data;
                    console.log('errores al cargar usuarios');                        
                    console.log(msnErrores); 
                    this.responseErrorMsn=err.response.data.message;
                    this.responseErrorCodig=err.response.status;
                    this.viewError=true;                        
            });  
    },
    methods:{        
        cancelUpdateUser(index,usuario){             
            /**
             * para insertar el nuevo valor en el array
             * Vue.set(this.array, index, newValue);
             */            
            Vue.set(this.myProfile, index, usuario);                  
        },
        deleteUser(index,usuario){
            /**Eliminar usuario */
            axios.delete(`/user/${usuario}`)
                .then(response=>{
                    console.log('DELETED user profile');
                    location.replace('/');
                });
        }, 
    }
}
</script>

<style scoped>
    /** 
    * Las animaciones de entrada y salida pueden usar 
    * funciones de espera y duración diferentes.
    */
    
    .slide-fade-enter-active {
    transition: all .5s ease;
    }
    .slide-fade-leave-active {
    transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
    }
</style>