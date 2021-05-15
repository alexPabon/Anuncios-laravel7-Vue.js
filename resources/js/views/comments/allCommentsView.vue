<template>        
    <div id="coment" class="bg-indigo bg-gradient hg-10-container px-2 py-4">                    
        <h2 class="text-center bg-gradient p-3 badge-pill">Comentarios</h2>
        <div class="container pt-2">
            <p class="lead">
                ¿Te gusta el diseño y funcionamiento de nuestra web?<br><br>
                Escribe tu opinión sobre que te ha parecido la aplicación o una sugerencia en que se puede mejorar.
            </p>
        </div>
        <!-- Añadir nuevo comentario -->
        <form-component
            @new="addcommentary">            
        </form-component>         
        <div v-if="isAuthenticated">
            <!-- Paginacion  -->
            <div class="container">
                <nav aria-label="Page navigation">                    
                    <ul class="pagination mt-2">
                        <li class="page-item" v-if="!(currentPage<=1)" v-on:click="goPage(currentPage-1)">
                            <a class="page-link" href="#" aria-label="Previous"  v-on:click.prevent>
                                <span aria-hidden="true">&laquo;</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>

                        <page-component 
                            v-for="num in lastPage" 
                            :key="num"
                            :class="pageCurrentActive(num)"
                            :num="num"
                            @go="goPage">
                        </page-component>
                        
                        <li class="page-item" v-if="!(currentPage>=lastPage)" v-on:click="goPage(currentPage+1)">
                            <a class="page-link" href="#" aria-label="Next"  v-on:click.prevent>
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul>
                    <p class="p-0 m-0 lead font-weight-bold">Comentario: {{from}} de {{total}}</p>   
                </nav>                    
            </div> 
            <!-- Todos los comentarios -->
            <transition-group name="slide-fade">                   
                <commentary-component                
                    v-for="(commentary,index) in comments" 
                    :key="commentary.id"
                    :commentary="commentary"                                              
                    @delete="deletecommentary(index, ...arguments)">
                </commentary-component>                                            
            </transition-group> 
            <div align="center">{{msnErro}}</div>          
            <infinite-loading @infinite="infiniteHandler">                
                <div slot="no-more">-- No hay mas comentarios --</div>
                <div slot="spinner">Cargando...</div>
                <div slot="no-results">Sin resultados</div>
            </infinite-loading>            
        </div>
    </div>
        
    
</template>

<script>        
    export default {           
        data() {
            return {
                // array vacio de comentarios que se llenara con la respuesta get
                comments:[] ,
                commentsPage:[],
                verifyPage:false,
                page:1,                
                currentPage:1,                
                lastPage:1,
                from:'',
                total:'',
                msnErro:''
            }
        },        
        mounted() {

            console.log('Comments mounted');            
        },
        methods: {
            pageCurrentActive(page){
                return (this.currentPage==page)?['active']:'';
            },
            goPage(nPage){
                axios.get(`/commentary?page=${nPage}`)
                    .then((response)=>{
                        this.comments = response.data.data
                        this.page=nPage;
                        this.lastPage = response.data.last_page;
                        this.currentPage=response.data.current_page;                        
                        this.from= response.data.from;
                        this.total= response.data.total;
                        this.verifyPage=true;                        
                        
                    })                
            },
            infiniteHandler($state) { 
                
                // Metodo para hacer que la pagina se recargue sin elegir pagina
                let url = `/commentary?page=${this.page++}`;             
                
                if(this.verifyPage){
                    this.comments=[];
                    this.verifyPage=false;                    
                }

                axios.get(url)
                .then(response => {
                    let allcomments = response.data.data;                    

                    if(allcomments.length){
                        this.comments = this.comments.concat(allcomments)
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
                    
                    // console.log('respuesta del servidor /commentary');
                    // console.log(response.data);                    
                })
                .catch(err =>{
                        let msnErrores = err.response.data;
                        console.log('errores al cargar comentarios');                        
                        console.log(msnErrores);                         
                        this.msnErro='Error al cargar los comentarios';
                        this.msnErro+=err.response.data.message;                        

                        if(err.response.status==403)
                            location.replace('/home');
                    });                
            },                                
            addcommentary(commentary){
                /** Añadir elemento al final del array */
                // this.comments.push(commentary);

                /**Añadir elemento al principio del array, se puede añadir mas de 1 elemento. */
                this.comments.unshift(commentary);
                this.total++;
            },           
            deletecommentary(index,commentary){
                
                axios.delete(`/commentary/${commentary}`)
                    .then((response)=>{                    
                        this.comments.splice(index, 1);
                        this.total--;
                        console.log('DELETE Mycomments mounted.')
                    });
            }           
        }
    }
</script>

<style scoped>
    /** Las animaciones de entrada y salida pueden usar 
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