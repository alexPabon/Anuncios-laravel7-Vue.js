<template>
    <div class="py-3">
        <div>
            <p class="text-justify d-flex flex-wrap justify-content-between">
                <span class="d-block"><b class="text-info">Ciudad: </b>{{advert.city}}</span>
                <span class="d-block"><b class="text-info">Actualizado: </b>{{advert.updated_at}}</span>
            </p>
            <h4><span class="text-info">Producto: </span> {{advert.product}}</h4>
            <p class="lead"><span class="text-info">Precio:</span> <span class="text-warning">{{advert.price}}€</span></p>
            <p><span class="text-info">En stock: </span>{{advert.quantity}}</p>
            <div
                @click="viewImage=!viewImage"
                :class="[viewImage?'pos-inferior':'']">
            </div>

            <div
                v-if="advert.images!=''"
                :class="[viewImage?'pos-superior bg-light':'col-12 col-md-10 m-auto hg_25_cont_image',moreImg?'hg-90-width':'']">
                <!-- slider Images -->
                <div
                    @scroll="handleScroll"
                    ref="slider" class="slider rounded">
                    <div class="container-btn-ampliar">
                        <span
                            v-if="btnMoreImg"
                            v-on:click="moreImg=!moreImg"
                            id="btn-height"
                            class="container-btn-ampliar__content">
                            <svg v-if="!moreImg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-expand" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8zM7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10z"/>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-collapse" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 0 1h-13A.5.5 0 0 1 1 8zm7-8a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 4.293V.5A.5.5 0 0 1 8 0zm-.5 11.707-1.146 1.147a.5.5 0 0 1-.708-.708l2-2a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 11.707V15.5a.5.5 0 0 1-1 0v-3.793z"/>
                            </svg>
                        </span>
                        <span v-on:click="viewImage=!viewImage;btnMoreImg=!btnMoreImg" class="container-btn-ampliar__content">
                            <svg v-if="!viewImage"  xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-arrows-fullscreen" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M5.828 10.172a.5.5 0 0 0-.707 0l-4.096 4.096V11.5a.5.5 0 0 0-1 0v3.975a.5.5 0 0 0 .5.5H4.5a.5.5 0 0 0 0-1H1.732l4.096-4.096a.5.5 0 0 0 0-.707zm4.344 0a.5.5 0 0 1 .707 0l4.096 4.096V11.5a.5.5 0 1 1 1 0v3.975a.5.5 0 0 1-.5.5H11.5a.5.5 0 0 1 0-1h2.768l-4.096-4.096a.5.5 0 0 1 0-.707zm0-4.344a.5.5 0 0 0 .707 0l4.096-4.096V4.5a.5.5 0 1 0 1 0V.525a.5.5 0 0 0-.5-.5H11.5a.5.5 0 0 0 0 1h2.768l-4.096 4.096a.5.5 0 0 0 0 .707zm-4.344 0a.5.5 0 0 1-.707 0L1.025 1.732V4.5a.5.5 0 0 1-1 0V.525a.5.5 0 0 1 .5-.5H4.5a.5.5 0 0 1 0 1H1.732l4.096 4.096a.5.5 0 0 1 0 .707z"/>
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-angle-contract" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M.172 15.828a.5.5 0 0 0 .707 0l4.096-4.096V14.5a.5.5 0 1 0 1 0v-3.975a.5.5 0 0 0-.5-.5H1.5a.5.5 0 0 0 0 1h2.768L.172 15.121a.5.5 0 0 0 0 .707zM15.828.172a.5.5 0 0 0-.707 0l-4.096 4.096V1.5a.5.5 0 1 0-1 0v3.975a.5.5 0 0 0 .5.5H14.5a.5.5 0 0 0 0-1h-2.768L15.828.879a.5.5 0 0 0 0-.707z"/>
                            </svg>
                        </span>
                    </div>
                    <!-- <img
                        v-for="(image, index) in advert.images"
                        :key="index"
                        :src="configAddress(image.address)"
                        alt="imagen"
                        class="slider__content">                     -->
                    <div
                        v-for="(image, index) in advert.images"
                        :key="index"
                        :style="`background-image:url(${configAddress(image.address)})`"
                        class="slider__content">
                    </div>
                    <!-- Botones de desplazamiento -->
                    <div class="slider__controls">
                        <span
                            v-if="(this.posImage!=0)"
                            @click="moveSlider(posImage-1)"
                            id="reg" class="laterales">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                                  <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                                </svg>
                        </span>
                        <a
                            v-for="n in advert.images.length"
                            :key="n"
                            @click.prevent="moveSlider(n-1)"
                            :class="[(posImage==n-1)?'active':'']"
                            href=""
                            class="slider__controls__links">
                                {{n}}
                        </a>
                        <span
                            v-if="(this.posImage!=this.advert.images.length-1)"
                            @click="moveSlider(posImage+1)"
                            id="avan" class="laterales">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                </svg>
                        </span>
                    </div>
                </div>
            </div>
            <img
                v-if="advert.images==''"
                width="150px" src="/storage/images/tablon/no-image.png" class="rounded" alt="No hay imagen">
            <div class="bg-gradient-bottom p-2 mt-2 rounded">
                <h5 class="text-info">Contacto:</h5>
                <p>
                    Nombre: {{advert.user.name}}<br>
                    Telefono: {{advert.user.phone}}
                </p>
            </div>
            <div class="bg-gradient-bottom p-2 mt-1 rounded">
                <span class="text-info">Descricción:</span>
                <p v-html="textDescription"></p>
                <span class="text-warning">{{advert.price}}€</span>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props:['advert'],
    data() {
        return{
            show:true,
            viewImage:false,
            moreImg:false,
            btnMoreImg:true,
            slider:null,
            height:null,
            width:null,
            posImage:0,
            textDescription:'',
        }
    },
    mounted(){
        // this.textDescription = this.advert.description;
    },
    methods: {
        moveSlider(pos){
            this.slider = this.$refs.slider;
            this.height = this.slider.offsetHeight;
            this.width = this.slider.offsetWidth;

            this.slider.scrollTo({
                // top: this.height*pos,
                left: this.width*pos,
                behavior: 'smooth'
            });
        },
        handleScroll:function(){
            let pos_X = this.$refs.slider.scrollLeft;
            this.width = this.$refs.slider.offsetWidth;
            this.posImage= Math.round(pos_X/this.width);
        },
        changePositionImg(pos){
            if(pos>=0 && pos<this.advert.images.length)
                this.moveSlider(pos);
        },

    },
    watch:{
        advert:function(){

            this.textDescription= this.advert.description.replace(/(\r\n|\n\r|\r|\n)/g, "<br>");

        },
    }

}
</script>

<style scoped>
    .hg-50-width{
        height: 50vw;
    }

    .hg_25_cont_image{
        width: 50vw;
        height: 25vw;
    }

    .hg-90-width{
        height: 40vw;
        width: 30vw;
    }
    .slider{
        position: relative;
        height: 100%;
        width: 100%;
        overflow:scroll;
        overflow-y: hidden;
        background: aliceblue;
        scroll-snap-type: x mandatory;
        white-space: nowrap;
    }

    .slider__controls{
        position: sticky;
        left: 0;
        bottom: 0;
        height: 3rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slider__content{
        height: 100%;
        width: 100%;
        background-position: center;
        background-size: cover;
        scroll-snap-align: center;

        display:inline-block;
    }

    .slider__controls__links{
        width: 1rem;
        height: 1rem;
        background-color: rgba(215, 239, 250, 0.52);
        color: black;
        border-radius: 50%;
        font-size: .4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: bold;
        margin: 0 2px;
    }

    .active{
        width: 1.3rem;
        height: 1.3rem;
        background-color: rgb(2, 63, 143);
        color: aliceblue;
        font-size: .5rem;
    }

    .pos-inferior{
        position: fixed;
        z-index: 10000;
        background: #01182f;
        left: 0;
        top: 0;
        width: 100vw;
        height: 100vh;
    }

    .pos-superior{
        position: fixed;
        z-index: 10100;
        left: 5vw;
        top:10px;
        width: 90vw;
        height: 80vh;
        border-radius: 10px;
    }


    /**
    *========================================================
    * Personalizando la barra de scroll
    * with
    *=========================================================
     */
    ::-webkit-scrollbar {
        width: 5px;
        height: 1px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px lightgrey;
    border-radius: 10px;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
    background: #037bff;
    border-radius: 20px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
    background: #6ebdc5;
    }

    /* ============================================================== */

    /**
    * Botones para desplazar las imagenes
    */
    .laterales
    {
        width: 20px;
        height: 20px;
        background-color: rgba(0,0,0,.38);
        color: white;
        margin: 0;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2vw;
        cursor: pointer;
        padding: 0;
        border-radius: 50%;
    }

    .laterales:hover{
        background-color: #01236e;
    }

    #avan
    {
        right: 0;
        z-index: 100000;
    }

    #regr
    {
        left: 0;
        z-index: 100000;
    }

    /* ======================================================== */

    .container-btn-ampliar{
        position: sticky;
        display: grid;
        left: 0;
        justify-content: flex-end;
        height: 0rem;
        align-items: end;
    }
    .container-btn-ampliar__content{
        display: flex;
        font-size: 10px;
        font-weight: bold;
        color: rgb(56, 54, 54);
        background: rgb(255, 255, 255);
        cursor: pointer;
        margin: .1rem;
        padding: 0;
        justify-content: center;
    }

    @media (max-width: 600px) {
        .hg-50-width {
            height: 50vw;
        }
        .hg_25_cont_image{
            width: 70vw;
            height: 35vw;
        }
        #btn-height{
            display: none;
        }
    }
</style>
