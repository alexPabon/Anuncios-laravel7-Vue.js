<template>            
    <transition
        v-on:before-enter="beforeEnter"
        v-on:enter="enter"
        v-on:leave="leave"
        v-bind:css="false"
    >
        <div v-if="show" class="d-block col-4 col-md-3 pt-2 text-right pos-relative">                           
            <figure>
                <img :src="configAddress(image.address)" class=" card-img rounded" alt="imagen">
                <span @click="show = !show; deleteImage(image.id)" class="boton-borrar" title="Eliminar Imagen"></span>
            </figure>             
        </div>                                           
    </transition>       
</template>

<script>
export default {
    props:['image'],
    data(){
        return{            
            show:true,
        }
    },
    methods:{
        deleteImage(id){
            
            axios.delete(`/image/${id}`)
                .then(response=>{
                    console.log('Imagen Eliminada');
                    
                })
                .catch(err=>{
                    console.log('Se produjo un error al eliminar la imagen');
                    
                })
        },
        beforeEnter: function (el) {
            el.style.opacity = 0
        },
        enter: function (el, done) {
            Velocity(el, { opacity: 1, fontSize: '1.4em' }, { duration: 200 })
            Velocity(el, { fontSize: '1em' }, { complete: done })
        },
        leave: function (el, done) {
            Velocity(el, { translateX: '15px', rotateZ: '50deg' }, { duration: 600 })
            Velocity(el, { rotateZ: '40deg' }, { loop: 2 })
            Velocity(el, {
                rotateZ: '45deg',
                translateY: '30px',
                translateX: '30px',
                opacity: 0
            }, { complete: done, })
        }
    }
}
</script>

<style scoped>
    .boton-borrar{
        position:absolute;
        right: 16px;
        bottom: 16px;
        cursor: pointer;
        width: 20px;
        height: 23px;
        border-radius: 2px;
        outline: none;
        background-image: url("/storage/images/btn-eliminar.png");
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
    }
</style>
