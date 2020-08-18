<template>
    <div class="px-3 pt-4 bg-blue bg-gradient hg-10-container">
        <!-- comprobar si esta autenticado -->
        <authenticated-component></authenticated-component>
        <div v-if="advertsFlag">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-center text-dark bg-light-violet"><h3>Mis anuncios publicados</h3></div>
                    </div>
                </div>
            </div>        
            <!-- Categories -->
            <div class="d-flex">
                <div class="container text-info p-0">
                    <p class="lead m-0">Buscar por categorias</p>
                    <selectCategories-component
                        :closeMenu="closeMenuCategories"
                        :restart="resetCategories"
                        :cat="categories">
                    </selectCategories-component>
                    <p class="py-2 px-3 col-9 col-md-7 col-lg-4">
                        <span v-on:click="buscar" class="btn btn-light">Buscar</span>
                    </p>                
                </div>
            </div>
            <!-- Paginacion -->       
            <listpage-component
                :lastPage=lastPage
                :from=from
                :total=total
                :tablePos=nameTable
                :currentPage=currentPage
                @goToPage="goPage"
            ></listpage-component>
            <!-- boton nuevo anuncio -->
            <div class="text-right px-4 pos-relative">
                <router-link :to="{name:'add-advert'}" class="text-decoration-none text-light">
                    <span class="btn btn-success text-bold lead pos-absolute pos_boton_add" title="Añadir nuevo anuncio">+</span>
                </router-link>
            </div>
        
            <!-- Adverts -->
            <div>
                <div class="d-flex">
                    <transition-group class="d-flex flex-wrap justify-content-around align-items-stretch w-100" name='slide-fade'>               
                        <advertslist-component
                            v-for="(advert) in adverts"
                            :key="advert.id"                            
                            :advert="advert">
                        </advertslist-component>
                    </transition-group>
                </div>
                <infinite-loading @infinite="infiniteHandler">                
                    <div slot="no-more">-- No hay mas Anuncios --</div>
                    <div slot="spinner">Cargando...</div>
                    <div slot="no-results">Sin resultados</div>
                </infinite-loading>            
            </div>
        </div>
        <div v-if="!advertsFlag" class="text-center pt-5">
            <p>Aun no tienes anuncios publicados</p>
            <router-link :to="{name:'add-advert'}" class="text-decoration-none text-light">
                  <button class=" lead bg-transparent bg-gradient-bottom text-primary font-bold uppercase tracking-wide px-5 py-2 mt-3 border-2 border-grey-light hover:border-primary rounded-lg">
                    Crea tu primer anuncio
                </button>
            </router-link>            
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                adverts:[],
                advertsFlag:true,
                verifyPage:false,
                responseSuccess:true,
                colors:true,
                page:1,
                currentPage:1,
                lastPage:1,
                nameTable:'Anuncios',
                from:'',
                total:'',
                msnError:'',
                responseErrorMsn:'',
                responseErrorCodig:'',
                viewError:false,

                closeMenuCategories:false,
                resetCategories:false,
                categories:[],
            }
        },
        mounted() {
            console.log('Component index adverts mounted.')
        },
        methods:{                      
            pageCurrentActive(page){
                return (this.currentPage==page)?['active']:'';
            },
            goPage(nPage){
                axios.get(`/myindex?page=${nPage}`)
                    .then(response=>{
                        console.log('respusta advert')
                        console.log(response);
                        this.adverts = response.data.data
                        this.page = nPage;
                        this.lastPage = response.data.last_page;
                        this.currentPage = response.data.current_page;
                        this.from = response.data.from;
                        this.total = response.data.total;
                        this.verifyPage = true;

                        this.categories=[];
                        this.closeMenuCategories=!this.closeMenuCategories;
                        this.resetCategories=!this.resetCategories;

                        // console.log(response);
                    })
            },
            infiniteHandler($state) { 
                
                // Metodo para hacer que la pagina se recargue sin elegir pagina
                let url = `/myindex?page=${this.page++}`;             
                
                if(this.verifyPage){
                    this.adverts=[];
                    this.verifyPage=false;                    
                }

                axios.get(url)
                .then(response => {
                    let allAdverts = response.data.data;                    

                    if(allAdverts.length){
                        this.adverts = this.adverts.concat(allAdverts)
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
                    
                    console.log('respuesta del servidor /advert');
                    // console.log(response.data);
                    
                    this.categories=[];
                    this.closeMenuCategories=!this.closeMenuCategories;
                    this.resetCategories=!this.resetCategories;

                    if(this.adverts=='')
                        this.advertsFlag=false;
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
            buscar(){

                this.closeMenuCategories=!this.closeMenuCategories;
                console.log(this.categories);
                let filteredCategory=[]
                let filterId=[];
                this.adverts.forEach(advert => {
                    advert.categories.forEach(category => {
                        this.categories.forEach(catSearch => {
                            if(category.id==catSearch){
                                if(filterId.indexOf(advert.id)===-1){
                                    filterId.push(advert.id);
                                    filteredCategory.push(advert);       
                                }                         
                            }
                        });
                    });
                });
                    console.log(filterId);
                this.adverts= filteredCategory;
            }
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