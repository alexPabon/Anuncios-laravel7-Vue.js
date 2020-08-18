<template>
    <div class="hg-10-container bg-gradient bg-blue">
        <!-- comprobar si esta autenticado -->
        <authenticated-component></authenticated-component>
        <div v-if="isAuthenticated && !isEmailVerified" :load="[redirectPageHome()]"></div>
        <div
            v-if="isAuthenticated && isEmailVerified" 
            class="container pt-4">
            <h1 class="text-center">Formulario para añadir anuncio</h1>
            <div>
                <form id="formAdvert" class="border rounded" action="" v-on:submit.prevent="newAdvert" enctype="multipart/form-data">
                    <!-- PRODUCT: formulario para introducir datos -->
                    <advertform-component
                        :errors="msnErrors"
                        :viewErrors="viewErrors"
                        :newProduct="newProduct"
                        @save="hideSaveButton">
                    </advertform-component>
                    <!-- CATEGORIES: Componente para seleccionar las categorias -->
                    <div class="form-group py-1">
                        <selectCategories-component
                            :closeMenu="closeMenuCategories"
                            :restart="resetCategories"
                            :cat="newProduct.categories"
                            @verifyCategories="verifyCategories">
                        </selectCategories-component> 
                        <small 
                            v-for="error in msnErrors.categories" :key="error"
                            class="text-danger">
                                - {{error}}
                        </small>                                                      
                    </div>
                    <!-- IMAGES: Componente para seleccionar las imagenes -->
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
                        <p v-if="waitingFlag" class="px-3">Guardando <span class="waiting">...</span></p>
                        <transition name="bounce">
                            <button 
                                v-if="show" 
                                v-on:click="closeMenuCategories=!closeMenuCategories"  
                                type="submint" 
                                class="col-11 col-md-5 col-lg-3 btn-gradient bg-primary btn btn-primary m-1">
                                    Publicar anuncio
                            </button>                                        
                        </transition>
                        <transition name="bounce">
                            <span
                                v-if="!waitingFlag"
                                v-on:click="show=true; validateInputs=false; deleteInputs()"                                
                                class="col-11 col-md-5 col-lg-3 btn-gradient bg-secondary btn btn-secondary m-1">
                                    Borrar datos
                            </span> 
                        </transition>               
                    </div>                                        
                </form>                                  
            </div>             
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{            
            show:true,
            validateInputs:false,
            imgFlag:false,                        
            deleteImages:false,
            viewErrors:false,
            closeMenuCategories:false,
            resetCategories:false,
            msSuccessFlag:false,
            msErrorFlag:false,
            waitingFlag:false,
            errorImage:[],
            selected:[],            
            imagesMini:[],            
            msnErrors:[],
            valueSelect:'',
            valor:'',
            msSuccess:'',
            msError:'',
            newProduct:{
                city:'',
                product:'',
                description:'',
                quantity:'',
                price:'',                
                images:[],
                categories:[1]
            },            
        }
    },    
    mounted(){
       
    },
    methods:{
        redirectPageHome(){
            location.replace('/home');
        },              
        newAdvert(){

            this.waitingFlag=true;
            
            /** Borrar errores */
            this.msnErrors=[];
            this.viewErrors=!this.viewErrors;
            this.msSuccessFlag=false;
            this.msErrorFlag=false;
            this.show=false;
            
            /**Añadir datos a formData para enviarlos */
            let formData = new FormData();
            formData.append('city', this.newProduct.city);
            formData.append('product', this.newProduct.product);
            formData.append('description', this.newProduct.description);
            formData.append('quantity', this.newProduct.quantity);
            formData.append('price', this.newProduct.price);            
            
            this.newProduct.images.forEach(element => {
                formData.append('images[]',element);              
            }); 

            this.newProduct.categories.forEach(element => {
                formData.append('categories[]',element);              
            }); 
                       

            /**Peticion POST con axios */ 
            axios.post('/advert',formData)
                .then((response)=>{                                                                                                                                              
                    console.log('store product.') 
                    // console.log(response.data);
                    
                    this.waitingFlag=false;
                    this.show=true;
                    this.msSuccess= response.data.success;
                    this.msSuccessFlag=true;
                    console.log(response.data.error);
                    this.deleteInputs();
                })
                .catch(err =>{
                    
                    this.msError = err.response.data.message?'Algunos datos proporcionados no son válidos.':'';  
                    this.msErrorFlag=true;
                    this.show=true;
                    this.waitingFlag=false;                     

                    console.log('hay errores al guardar');                    

                    if(err.response.status==422){
                        this.msnErrors= err.response.data.errors;
                        this.viewErrors=!this.viewErrors;                        
                        // console.log(this.msnErrors);
                        
                        /**Bucle para mostrar los errores de newProduct.images[] */
                        var objErrors = err.response.data.errors;
                            
                        for (const prop in objErrors) {
                            // console.log(`objErrors.${prop} = ${objErrors[prop]}`);
                                                        
                            if(prop.substring(0,6)=='images')
                                this.errorImage.push(`${objErrors[prop]}`)                                                            
                        }                      
                    }

                    if(err.response.status==413)
                        this.msError='La petición del navegador es demasiado grande y por ese motivo el servidor no la procesa.'
                }); 
        },
        verifyCategories(){           

            if(this.newProduct.categories.length<1)
                this.show=false;        
            else
                this.show=true;
        },
        removeImages(){            
            this.newProduct.images=[];                       
        },        
        addImages(files){
            
            this.errorImage=[];

            for (let i = 0; i < files.length; i++) {                
                
                this.newProduct.images.push(files[i]);                
                
                if(!(/\.(jpg|jpeg|png|webp)$/i).test(files[i].name)){
                    this.deleteImages=!this.deleteImages;
                    this.errorImage=['Debe ser imagen tipo:jpg, jpeg, png, webp'];
                    break;
                }
            } 
        },
        deleteInputs(){
            /** Borrar errores */
            this.msnErrors=[];
            this.viewErrors=!this.viewErrors;

            /**Borra los datos del furmulario */
            this.newProduct.city='';
            this.newProduct.product='';
            this.newProduct.description='';
            this.newProduct.quantity='';
            this.newProduct.price='';            
            this.newProduct.categories=[1];

            /**reinciar categorias */
            this.resetCategories=!this.resetCategories;

            /**quitar imagenes */
            this.deleteImages=!this.deleteImages
            this.errorImage=[];
        },
        hideSaveButton(flag){
            this.show=flag;
            this.validateInputs=!flag;
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