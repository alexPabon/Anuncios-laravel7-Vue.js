<template>
    <div class="p-1 col-6 col-md-4 col-lg-3">
        <div class="back-color bg-gradient my-1 p-0 border h-100 rounded overflow-hidden">
            <router-link :to="{path:`/showadvert/${advert.id}`}" class="text-decoration-none text-light">
                <!-- Imagen -->
                <div class="overflow-hidden btn p-0 m-0" style="max-height:200px">
                    <figure v-if="viewImage">
                        <img class="col-12 m-0 p-0 text-light" :src="configAddress(address)" alt="Imagen">
                    </figure>
                    <figure v-if="!viewImage">
                        <img class="col-12 m-0 p-0" :src="addressDefaulth" alt="Imagen">
                    </figure>
                </div>                
                <!-- Datos del anuncio -->
                <div class="px-2 d-flex justify-content-between">
                    <span class="text-left">{{advert.city}}</span>
                    <span class="text-right">{{advert.updated_at}}</span>
                </div>            
                <p class="p-0 px-1 m-0 lead">
                    <b class="text-info">Producto:</b> {{advert.product}}<br>                    
                </p>                
                <p class="p-0 px-2 my-1 text-right"><small class="text-warning">{{advert.price}}€</small></p>
            </router-link>                                
            <p class="p-0 m-0 px-2">
                <span class="text-info">Categorias:</span>
                <small
                    v-for="category in advert.categories"
                    :key="category.id"
                    class="text-capitalize">
                        {{category.name}}, 
                </small>
            </p>
            <!-- Descriccion del producto colapsado -->
            <div>
                <div 
                    v-if="!leer"
                    v-on:click="leer=!leer" 
                    class="bg-gradient" 
                    style="position:fixed;z-index:900; width:100vw; height:100vh;top:0;left:0">
                </div>

                <div :class="[leer?'':'pos-absolute back-color bg-gradient rounded-bottom']">
                    <div
                        :class="[leer?'overflow-hidden mx-hg-100':'col-12']" 
                        class="d-block p-2">
                        <small class="text-info">Descripcion:</small>
                        <small class="d-block p-2">
                            {{advert.description}}
                        </small>
                    </div>
                    <!-- Boton para mostra mas texto -->
                    <p class="text-right pl-1">
                        <span 
                            v-on:click="leer=!leer" 
                            class="bg-light text-dark rounded border px-2 cursor-pointer">
                                {{leer?'Leer mas':'Cerrar'}}
                        </span>
                    </p>                    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['advert'],
    data(){
        return{
            show:false,
            viewImage:false,
            leer:true,
            address:'',
            addressDefaulth:'storage/images/tablon/no-image.png'
        }
    },
    mounted(){
        if(this.advert.image!==null){
            this.viewImage=true;
            this.address= this.advert.image.address;
        }
    },
    methods:{
        backgrouds(){            
            this.viewColor=true;           
        }
    },   
}
</script>

<style scoped>
    .back-color{
        background-color: #05c4fd;
    }
    .back-color:hover{
        background: #062a48;
    }
    .cursor-pointer{
        cursor: pointer;
    }
</style>