<template>
    <div class="px-3 pt-4 bg-index-Adverts hg-10-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"><h3>Listado de todos los anuncios publicados</h3></div>
                </div>
            </div>
        </div>
        <!-- Categories -->
        <div class="container py-3">
            <form action="" class="col-6 col-md-3 rounded py-1 px-2 bg_form">
                <label class="text-light text-bold lead" for="search">Buscar</label>
                <input
                    v-on:keyup="buscar"
                    v-model.trim="search"
                    autocomplete="off"
                    class="form-control" id="search" type="text">
            </form>
        </div>

       <!-- Paginacion -->
        <!-- <listpage-component
            :lastPage=lastPage
            :from=from
            :total=total
            :tablePos=nameTable
            :currentPage=currentPage
            @goToPage="goPage"
        ></listpage-component> -->

        <!-- nueva paginación -->
        <div v-if="paginationFlag">
            <builderlinks-component
            :objeto=builder_links
            :builderFlag=builderFlag
            :search="search"
            :from=from
            :tot=total
            :to=to
            @goToPage="goPage"></builderlinks-component>
        </div>
        <div v-if="!paginationFlag" class="container text-warning lead">
            <p>No hay resultados!</p>
        </div>
        <!-- fin paginacion -->
        <!-- boton nuevo anuncio -->
        <div v-if="isAuthenticated" class="text-right px-4 pos-relative">
            <router-link :to="{name:'add-advert'}" class="text-decoration-none text-light">
                <span class="btn btn-success text-bold lead pos-absolute pos_boton_add" data-toggle="tooltip" data-placement="left"  title="Añadir nuevo anuncio">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                      <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                      <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </span>
            </router-link>

        </div>
        <!-- Adverts -->
        <div class="container">
            <div class="d-flex">
                <transition-group class="d-flex flex-wrap justify-content-start align-items-stretch w-100" name='slide-fade'>
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
</template>

<script>
    export default {
        data(){
            return{
                adverts:[],

                // constructor de enlaces
                builder_links:{'lastPage':1,'currentPage':1,'path':'null'},
                builderFlag:true,
                paginationFlag:true,

                // Buscador
                search:'',

                responseSuccess:true,
                colors:true,
                page:'/advert?page=1',
                currentPage:1,
                lastPage:1,
                nameTable:'Anuncios',
                from:'',
                total:'',
                to:'',
                path:'elcaminio',
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
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            })
        },
        methods:{
            pageCurrentActive(page){
                return (this.currentPage==page)?['active']:'';
            },
            goPage(nPage){

                this.paginationFlag=true;

                if(nPage!='null'){
                    axios.get(nPage)
                        .then(response=>{
                            console.log('respuesta advert')
                            // console.log(response);
                            this.adverts = response.data.data
                            this.page = response.data.next_page_url;
                            this.lastPage = response.data.last_page;
                            this.currentPage = response.data.current_page;
                            this.from = response.data.from;
                            this.total = response.data.total;
                            this.to = response.data.to;

                            this.builder_links.lastPage=response.data.last_page;
                            this.builder_links.currentPage = response.data.current_page;
                            this.builder_links.path = response.data.path;
                            this.builderFlag = !this.builderFlag;

                            this.categories=[];
                            this.closeMenuCategories=!this.closeMenuCategories;
                            this.resetCategories=!this.resetCategories;

                            if(!response.data.data.length)
                                this.paginationFlag=false;

                            // console.log(response);
                        })
                }
            },
            infiniteHandler($state) {

                // Metodo para hacer que la pagina se recargue sin elegir pagina
                let url = this.page;

                axios.get(url)
                    .then(response => {
                        let allAdverts = response.data.data;

                        if(allAdverts.length){
                            this.adverts = this.adverts.concat(allAdverts)
                            $state.loaded()
                        }else{
                            $state.complete()
                        }

                        // Modifamos los valores con los de response.data
                        this.lastPage = response.data.last_page;
                        this.total= response.data.total;
                        this.page = response.data.next_page_url;
                        this.to = response.data.to;
                        if(response.data.current_page<=response.data.last_page){
                            this.from= response.data.from;
                            this.currentPage=response.data.current_page;
                        }

                        this.builder_links.lastPage=response.data.last_page;
                        this.builder_links.currentPage = response.data.current_page;
                        this.builder_links.path = response.data.path;
                        this.builderFlag = !this.builderFlag;

                        // console.log('respuesta del servidor /advert');
                        // console.log(response.data);

                        this.categories=[];
                        this.closeMenuCategories=!this.closeMenuCategories;
                        this.resetCategories=!this.resetCategories;
                    })
                    .catch(err =>{
                            $state.complete()
                            if(typeof(err.response) !=='undefined'){
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
                            }
                        });

            },
            buscar(){

                let url = '/advert?search='+this.search;
                this.goPage(url);

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

    .bg-index-Adverts{
        background: radial-gradient(#ffffff, #e1e0e0);
    }

    .bg_form{
        background: #071e5e;
        color: #02f102 !important;
    }
</style>
