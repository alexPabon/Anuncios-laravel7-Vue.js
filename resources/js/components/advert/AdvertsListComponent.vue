<template>
    <div class="p-1 col-6 col-md-4 col-lg-3 shadow-sm">
        <div class="back-color bg-gradient my-1 p-0 h-100 rounded overflow-hidden">
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
                <div class="px-2 d-flex flex-wrap justify-content-between">
                    <small class="text-left">{{advert.city}}</small>
                    <small class="text-right">{{advert.updated_at}}</small>
                </div>
                <p class="p-0 m-0 px-2 lead"><small class="text-warning">{{advert.price}}€</small></p>
                <p class="p-0 m-0 px-2">
                    <b class="text-info">Producto:</b> {{advert.product}}
                </p>
                <p class="p-0 m-0 px-2">
                    <span class="text-info">Categorias:</span>
                    <small
                        v-for="category in advert.categories"
                        :key="category.id"
                        class="text-capitalize">
                        {{category.name}},
                    </small>
                </p>
            </router-link>
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
