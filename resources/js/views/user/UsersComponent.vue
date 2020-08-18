<template>
    <div class="pt-4">
        <!-- comprobar si esta autenticado -->
        <authenticated-component></authenticated-component>
        <div v-if="isAuthenticated">       
            <errors-component
                v-if="viewError"
                :codig=responseErrorCodig
                :mensaje=responseErrorMsn
            ></errors-component>          
            <div v-if="responseSuccess">
                <h3 class="text-center">Listado de todos los Usuarios registrados</h3>
                <!-- Paginacion -->
                <listpage-component
                    :lastPage=lastPage
                    :from=from
                    :total=total
                    :tablePos=nameTable
                    :currentPage=currentPage
                    @goToPage="goPage"
                ></listpage-component>
                <!-- Usuarios -->
                <div class="container">
                    <transition-group name='slide-fade'>               
                        <user-component
                            v-for="(usuario, index) in users"
                            :key="usuario.id"
                            :usuario="usuario"                        
                            @delete="deleteUser(index, ...arguments)"
                            @cancelUpdate="cancelUpdateUser(index, ...arguments)">
                        ></user-component>
                    </transition-group>
                    <infinite-loading @infinite="infiniteHandler">                
                        <div slot="no-more">-- No hay mas comentarios --</div>
                        <div slot="spinner">Cargando...</div>
                        <div slot="no-results">Sin resultados</div>
                    </infinite-loading>            
                </div>      
            </div>        
        </div>        
    </div>
</template>

<script>
    export default {
        data(){
            return {
                users:[],
                verifyPage:false,
                responseSuccess:true,
                page:1,
                currentPage:1,
                lastPage:1,
                nameTable:'Usuarios',
                from:'',
                total:'',
                msnError:'',
                responseErrorMsn:'',
                responseErrorCodig:'',
                viewError:false,                 
            }
        },
        mounted() {            
            console.log('Component users mounted.');
        },
        methods:{                      
            pageCurrentActive(page){
                return (this.currentPage==page)?['active']:'';
            },
            goPage(nPage){
                axios.get(`/user?page=${nPage}`)
                    .then(response=>{
                        this.users = response.data.data
                        this.page = nPage;
                        this.lastPage = response.data.last_page;
                        this.currentPage = response.data.current_page;
                        this.from = response.data.from;
                        this.total = response.data.total;
                        this.verifyPage = true;
                    })
            },
            infiniteHandler($state) { 
                
                // Metodo para hacer que la pagina se recargue sin elegir pagina
                let url = `/user?page=${this.page++}`;             
                
                if(this.verifyPage){
                    this.users=[];
                    this.verifyPage=false;                    
                }

                axios.get(url)
                .then(response => {
                    let allUsers = response.data.data;                    

                    if(allUsers.length){
                        this.users = this.users.concat(allUsers)
                        $state.loaded()
                    }else{
                        $state.complete()
                        console.log('estado completo');
                    }                   
                    
                    // Modifamos los valores con los de response.data
                    this.lastPage = response.data.last_page;                    
                    this.total= response.data.total;                    
                    if(response.data.current_page<=response.data.last_page){
                        this.from= response.data.from;
                        this.currentPage=response.data.current_page;
                    }                                                                   
                    
                    console.log('respuesta del servidor /user');
                    console.log(response.data);                    
                })
                .catch(err =>{
                        let msnErrores = err.response.data;
                        console.log('errores al cargar usuarios');                        
                        console.log(msnErrores);                         
                        this.msnErro='Error al cargar los usuarios';
                        this.msnErro+=err.response.data.message;
                        this.responseErrorMsn=err.response.data.message;
                        this.responseErrorCodig=err.response.status; 
                        this.viewError=true; 
                        this.responseSuccess=false;                     

                        // if(err.response.status==403)
                        //     location.replace('/home');

                        // if(err.response.status==429)
                        //     location.replace('/home');
                    });                
            },                       
            cancelUpdateUser(index,usuario){                
                // para insertar el nuevo valor en el array
                // Vue.set(this.array, index, newValue);
                Vue.set(this.users, index, usuario);                  
            },
            deleteUser(index,usuario){
                axios.delete(`/user/${usuario}`)
                    .then(response=>{
                        this.users.splice(index,1);
                        this.total--;
                        console.log('DELETED user from list');
                        console.log(response);
                    });
            },            
        },
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