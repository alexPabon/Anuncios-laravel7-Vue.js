<template>
    <div>
        <!-- Componenete de errores -->
        <errors-component
            v-if="!seeForm"
            :codig=responseErrorCodig
            :mensaje=responseErrorMsn
        ></errors-component>

        <div v-if="seeForm">        
            <h3 class="text-center pt-2">Actualizando Anuncio</h3>
            <form id="formAdvert" class="border rounded" action="" v-on:submit.prevent="updateAdvert" enctype="multipart/form-data">
                <!-- PRODUCT: formulario para actualizar datos -->
                <advertform-component
                    :errors="msnErrors"
                    :viewErrors="viewErrors"
                    :newProduct="advert"
                    @save="hideSaveButton">
                </advertform-component>
                <!-- CATEGORIES: Componente para seleccionar las categorias -->
                <div class="form-group py-1">
                    <selectCategories-component
                        :closeMenu="closeMenuCategories"
                        :restart="resetCategories"
                        :cat="categories"
                        @verifyCategories="verifyCategories">
                    </selectCategories-component> 
                    <small 
                        v-for="error in msnErrors.categories" :key="error"
                        class="text-danger">
                            - {{error}}
                    </small>                                                      
                </div>
                <!-- Images mini guardadas -->            
                <div v-if="imagesMini" class="border p-2">
                    <p class="text-warning">Las imagenes que se eliminen, no se podrán recuperar</p>
                    <div class="d-flex flex-wrap align-items-center">
                        <advertimageslist-component
                            v-for="image in advert.images"
                            :key="image.id"
                            :image="image">
                        </advertimageslist-component>
                    </div>                
                </div>            
                <!-- IMAGES: Componente para añadir mas imagenes -->
                <adveraddimage-component
                    :deleteImages="deleteImages"
                    @removeImages="removeImages"
                    @addImages="addImages">
                </adveraddimage-component>                    
                <small 
                    v-for="error in errorImage" :key="error"
                    class="text-danger d-block">
                        - {{error}}
                </small>
                <!-- Respuestas de peticiones -->
                <div>
                    <p v-if="msSuccessFlag" class="alert alert-success m-0">{{msSuccess}}</p>
                    <p v-if="msErrorFlag" class="alert alert-danger m-0">{{msError}}</p>
                </div>                   
                <!-- Botoes submit y cancel -->
                <div class="py-3 bg-gradient-bottom">
                    <small v-if="validateInputs" class="text-danger d-block px-2">Faltan campos por rellenar correctamente</small>
                    <p v-if="waitingFlag" class="px-3">Actualizando <span class="waiting">...</span></p>
                    <transition name="bounce">
                        <button 
                            v-if="show" 
                            v-on:click="closeMenuCategories=!closeMenuCategories"  
                            type="submint" 
                            class="col-11 col-md-5 col-lg-3 btn-gradient bg-primary btn btn-primary m-1">
                                Actualizar anuncio
                        </button>                                        
                    </transition>
                    <transition name="bounce">
                        <span
                            v-if="!waitingFlag"
                            v-on:click="cancelUpdate"                        
                            class="col-11 col-md-5 col-lg-3 btn-gradient bg-secondary btn btn-secondary m-1">
                                Cancelar
                        </span> 
                    </transition>               
                </div>                                                   
            </form>                                  
        </div>
    </div>
</template>

<script>
export default {
    props:['advert','active'],
    data(){
        return{
            /**ver formulario */
            seeForm:true,
            /**Datos */
            viewErrors:false,
            msnErrors:[],
            city:'california',
            /**categorias */
            closeMenuCategories:false,
            resetCategories:false,
            categories:[],
            /**Imagenes mini */
            imagesMini:true,
            /**Imagenes */
            images:[],
            errorImage:[],
            deleteImages:false,
            /**respuestas de las peticiones */
            msSuccessFlag:false,
            msErrorFlag:false,
            msSuccess:'',
            msError:'',
            /**componente de errores */
            responseErrorCodig:'',
            responseErrorMsn:'',
            /**botones submit cancel */
            show:true,
            validateInputs:false,
            waitingFlag:false,
        }
    },
    mounted(){
        
    },
    methods:{
        updateAdvert(){
            this.waitingFlag=true;
            this.imagesMini=false
            
            /** Borrar errores */
            this.msnErrors=[];
            this.viewErrors=!this.viewErrors;
            this.msSuccessFlag=false;
            this.msErrorFlag=false;
            this.show=false;
            
            /**Añadir datos a formUpdate para enviarlos
             * @update agregamos '_method','PUT'
             * con este metodo podemos actualizar el anuncio
             */            
            let formData = new FormData();
            formData.append('_method','PUT');
            formData.append('city', this.advert.city);
            formData.append('product', this.advert.product);
            formData.append('description', this.advert.description);
            formData.append('quantity', this.advert.quantity);
            formData.append('price', this.advert.price);            
            
            this.images.forEach(element => {
                formData.append('images[]',element);              
            }); 

            this.categories.forEach(element => {
                formData.append('categories[]',element);              
            }); 
                 
            /** se hace la peticion post porque put no admite formData */
            axios.post(`/advert/${this.advert.id}`,formData)
                .then(response=>{
                    this.waitingFlag=false;
                    this.show=true;
                    this.msSuccess= response.data.success;
                    this.msSuccessFlag=true;
                    console.log(response.data.error);

                    setTimeout(function(){ location.reload(); }, 1500); 
                })
                .catch(err=>{
                    this.msError = err.response.data.message?'Algunos datos proporcionados no son válidos.':'';  
                    this.msErrorFlag=true;
                    this.show=true;
                    this.waitingFlag=false;                     

                    console.log('hay errores al guardar');                    

                    if(err.response.status==422){
                        this.msnErrors= err.response.data.errors;
                        this.viewErrors=!this.viewErrors;                        
                        // console.log(this.msnErrors);
                        
                        /**Bucle para mostrar los errores de images[] */
                        var objErrors = err.response.data.errors;
                            
                        for (const prop in objErrors) {
                            // console.log(`objErrors.${prop} = ${objErrors[prop]}`);
                                                        
                            if(prop.substring(0,6)=='images')
                                this.errorImage.push(`${objErrors[prop]}`)                                                            
                        }                      
                    }

                    if(err.response.status==413)
                        this.msError='La petición del navegador es demasiado grande y por ese motivo el servidor no la procesa.';

                    if(err.response.status===403){                    
                        this.responseErrorMsn=err.response.data.message;
                        this.responseErrorCodig= err.response.status;
                        this.seeForm=false;
                    }
                })
        },
        cancelUpdate(){            
            location.reload();
        },
        addImages(files){
            
            this.errorImage=[];

            for (let i = 0; i < files.length; i++) {                
                
                this.images.push(files[i]);                
                
                if(!(/\.(jpg|jpeg|png|webp)$/i).test(files[i].name)){
                    this.deleteImages=!this.deleteImages;
                    this.errorImage=['Debe ser imagen tipo:jpg, jpeg, png, webp'];
                    break;
                }
            }

            if(files.length>10){
                this.show=false
                this.errorImage=['Maximo 10 imagenes'];
            }
            else{
                this.show=true            
            }
        },
        removeImages(){            
            this.images=[];                       
        },
        hideSaveButton(flag){
            this.show=flag;
            this.validateInputs=!flag;
        },
        verifyCategories(){           

            if(this.categories.length<1)
                this.show=false;        
            else
                this.show=true;
        },
       
    },
    watch:{
        advert:function(){            

            this.advert.categories.forEach(element => {
               this.categories.push(element.id);
            });                        
        },
        active:function(){
            this.advert.categories.forEach(element => {
               this.categories.push(element.id);
            });            
        }
    }
    
}
</script>

<style scoped>
    .bounce-enter-active {
        animation: bounce-in .5s;
    }
    .bounce-leave-active {
        animation: bounce-in .5s reverse;
    }
    @keyframes bounce-in {
        0% {
            transform: scale(0);
        }
        50% {
            transform: scale(1.5);
        }
        100% {
            transform: scale(1);
        }
    }
</style>