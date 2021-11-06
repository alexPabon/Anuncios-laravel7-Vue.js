<template>
    <div id="home_container">
        <div
            :class="[categoryFlag?'':'hide_element']"
            id="phaterCanv4">
            <canvas id="canvas4" ref="canvas4"></canvas>
        </div>
        <div
            :class="[categoryFlag?'':'fondo_img']"
            id="icon_container"
            class="hg-10-container">

            <div
                @click="categoryFlag=true;"
                class="pt-5 bg_blue_header">
                <h1 class="text-center h3">Vende todo lo que quieras</h1>
            </div>
            <div v-if="!isAuthenticated" class="container">
                <p class="lead px-2 m-0">
                    Para poder publicar tus anuncios, es necesario estar registrado.<br>
                    Lo puedes hacer desde <a href="/register">Registrar</a>
                </p>
            </div>
            <h3 v-if="categoryFlag" class="m-0 pt-3 pb-2 text-secondary text-center">Algunas categorías</h3>

            <!-- Iconos de categorias -->
            <div
                v-if="categoryFlag"
                class="pt-4 px-1 px-md-3 d-flex justify-content-center px-lg-4">
                <div class="d-flex flex-wrap justify-content-center align-items-center">
                    <div
                        v-for="(category, index) in allCategories"
                        :key="index"
                        @click="searchByCategory(category.id,index)"
                        class="col-3 col-md-3 p-0 bg-light height_content m-1 rounded link_categories">
                            <div class="w-100 h-100 d-flex flex-wrap justify-content-center align-items-end">
                                <div
                                    :class="category.imageCssName"
                                    class="w-100 h-50 bg_images_categories"></div>
                                <p class="p-1">{{category.name}}</p>
                            </div>
                    </div>
                    <router-link
                        :to="{name:'all-adverts'}"
                        class="col-3 col-md-3 p-0 all_categories bg-light height_content m-1 rounded text-decoration-none link_categories">

                        <div class="w-100 h-100 d-flex flex-wrap justify-content-center align-items-end">
                            <div class="w-100 h-50 d-flex flex-wrap justify-content-center align-items-center">
                                <span class="circle"></span>
                                <span class="circle"></span>
                                <span class="circle"></span>
                            </div>
                            <p class="p-1 text-dark">Todas las categorias</p>
                        </div>
                    </router-link>
                </div>
            </div>

            <!-- Busqueda segun categoria -->
            <div
                v-if="!categoryFlag"
                class="hg-10-container container pb-2">
                <div class="px-1">
                    <h4 class="text-capitalize"><span class="text-primary lead">Categoria buscada: </span>{{category}}</h4>
                    <p><span class="text-primary lead">Total: </span>{{total}}</p>
                </div>
                <transition-group class="d-flex flex-wrap justify-content-start align-items-stretch w-100" name='slide-fade'>
                    <advertslist-component
                        v-for="(advert) in adverts"
                        :key="advert.id"
                        :advert="advert">
                    </advertslist-component>
                </transition-group>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            categoryFlag:true,
            adverts:[],
            category:'',
            total:0,
            allCategories:[
                    {
                        name:'Juegos',
                        imageCssName:'juegos',
                        id:5
                    },
                    {
                        name:'Bebe',
                        imageCssName:'bebe',
                        id:7
                    },
                    {
                        name:'Deportes',
                        imageCssName:'deportes',
                        id:8
                    },
                    {
                        name:'Moda y complementos',
                        imageCssName:'moda',
                        id:9
                    },
                    {
                        name:'Mascotas',
                        imageCssName:'mascota',
                        id:10
                    },
                    {
                        name:'Motor',
                        imageCssName:'motor',
                        id:11
                    },
                ],
            myCanvas:'',

        }
    },
    mounted(){
        let tween = gsap.from('.link_categories', {
                duration: .3,
                y: -200, //'random(-500,500)',
                scale: 0,
                stagger: 0.2,
                ease: 'elastic',
                delay:.2
            });

        let canvas = this.$refs.canvas4;
        this.startDrawing(canvas);
    },
    methods:{
        searchByCategory(id,index){
            this.categoryFlag=false;
            this.category = this.allCategories[index].name;
            axios.get(`/advertcategory/${id}`)
                .then(response=>{
                    this.adverts=response.data.adverts;
                    this.total= response.data.total;
                    console.log('filtrando por categorias')
                    console.log(response.data)
                })
                .catch(err=>{
                    console.log('se produjo un error al solicitar por categorias')
                })
        },

    },
    beforeMount(){

    },
}
</script>

<style scoped>

    #phaterCanv4, #icon_container{
        position: relative;
    }

    .hide_element{
        display: none;
    }

    #canvas4{
        background-color: rgb(255, 255, 255);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        box-shadow: inset -1px 0px 4px 1px #62d2fc;
    }


    /**
    * Las animaciones de entrada y salida pueden usar
    * funciones de espera y duración diferentes.
    */

    .slide-fade-enter-active {
    transition: all .1s ease;
    }
    .slide-fade-leave-active {
    transition: all .3s cubic-bezier(1.0, 0.5, 0.8, 1.0);
    }
    .slide-fade-enter, .slide-fade-leave-to
    /* .slide-fade-leave-active below version 2.1.8 */ {
    transform: translateX(10px);
    opacity: 0;
    }

    .height_content{
        min-width: 60px;
        height: 10rem;
        cursor: pointer;
    }

    .bg-white{
        background-color: white;
    }

    .text_size{
        font-size: 1.3rem;
    }

    .bg_blue_header{
        background: deepskyblue;
    }

    .bg_images_categories{
        background-position: center;
        background-size: contain;
        background-repeat: no-repeat;
    }

    .juegos{background-image: url('/storage/images/categories/juegos.png');}
    .bebe{background-image: url('/storage/images/categories/bebe.png');}
    .deportes{background-image: url('/storage/images/categories/deportes.png');}
    .moda{background-image: url('/storage/images/categories/moda.png');}
    .motor{background-image: url('/storage/images/categories/motor3.png');}
    .mascota{background-image: url('/storage/images/categories/mascota.png');}

    .fondo_img{
        background-image: url('/storage/images/imgfondo/fondo1.jpg');
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .circle{
        width: .8rem;
        height: .8rem;
        margin: 0 .2rem;
        border-radius: 50%;
        background: black;
    }

    .all_categories{
        background: #e2eff7;
    }

    .height_content:hover{
        background: radial-gradient(#bac4c5, transparent);
    }
</style>
