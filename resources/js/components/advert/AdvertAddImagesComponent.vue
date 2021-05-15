<template>
     <div class="form-group border rounded p-2 m-0">
        <div>
            <label class="btn btn-success m-0 my-1" for="file">Elegir Imagenes</label>                            
            <input
                v-on:change="handleFileUpload"                              
                style="display:none"  type="file" id="file" ref="file" multiple>
            <span
                v-if="imgFlag"
                class="px-2 text-info">
                    Total: {{imagesMini.length}} {{(imagesMini.length>1)?'imagenes':'imagen'}}
            </span>
        </div>
        <div v-if="imgFlag">
            <div class="d-flex flex-wrap align-items-center">                            
                <figure
                    v-for="imag in imagen"
                    :key="imag"
                    class="d-block col-4 col-md-3 pt-2">
                    <img :src="imag" class=" card-img rounded" alt="imagen">
                </figure>                                           
            </div>
            <div class="w-100">
                <span
                    v-on:click="cancelImages"
                    class="btn btn-secondary my-2">
                        Quitar imagenes
                </span>
            </div> 
        </div>
    </div> 
</template>

<script>
export default {
    props:['deleteImages'],
    data(){
        return{
            imgFlag:false,
            imagesMini:[],            
        }
    },
    mounted(){
        
    },
    methods:{
        handleFileUpload(e){
            
            let files = e.target.files;
            
            this.$emit('removeImages');
            this.$emit('addImages',files);             
            
            this.imgFlag=false;           
            this.viewImage(files);

        },
        viewImage(files){            
            this.imagesMini=[];

            for (let i = 0; i < files.length; i++) {
                let reader = new FileReader();

                reader.onload = (e) =>{
                    this.imagesMini.push(e.target.result);                    
                }

                reader.readAsDataURL(files[i]);                   
            } 
            
            this.imgFlag=true;
        },
        cancelImages(){
            document.getElementById('file').value = '';
            this.$emit('removeImages');
            this.imagesMini=[];
            this.imgFlag=false;           
        } 
    },
    computed:{
        imagen(){            
            return this.imagesMini;
        },
    },
    watch:{
        deleteImages:function(){
            this.cancelImages();            
            
            // console.log('llamando del padre')
            // console.log(this.deleteImages);
        }
    }
}
</script>