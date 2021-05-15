<template>
    <div class="p-1 pt-5 pb-4 m-0 bg-gradient bg-show hg-10-container">
        <div class="container">
            <!-- Componenete de errores -->
            <errors-component
                v-if="viewError"
                :codig=responseErrorCodig
                :mensaje=responseErrorMsn
            ></errors-component>
            <!-- componente con detalles del Anuncio -->
            <div v-if="!viewError">
                <div v-if="!updateAdvert&&!deleteAdvert">
                    <advertshow-component
                        :advert="advert">                
                    </advertshow-component>
                    <!-- Botones de edicion y eliminado -->
                    <div  v-if="(isAdmin || user.id==advert.user_id)&&advertFlag" class="panel-footer p-2 text-center text-md-left">                                            
                        <div class="badge badge-pill badge-light d-flex col-12 col-md-5 col-lg-3 p-0 pos-relative">                            
                            <span 
                                v-if="!deleteAdvert" 
                                v-on:click="onClickEdit"
                                class="badge badge-pill badge-light m-0 pill_edit">Editar</span>           
                            <span 
                                v-if="!deleteAdvert" 
                                v-on:click="deleteAdvert=!deleteAdvert"
                                class="badge badge-pill badge-light m-0 pill_delete">Eliminar</span>                        
                        </div>                                                
                    </div>
                </div>                                        
            
                <!-- Formulario para actualizar anuncio  -->
                <div v-if="updateAdvert">
                    <advertformupdate-component
                        :advert="advert"
                        :active="activeCategories">
                    </advertformupdate-component>                    
                </div>

                <!-- Advertencia de elimado de advert y botones -->
                <div v-if="deleteAdvert">
                    <userconfirmdelete-component                        
                        :name=advert.product>
                    </userconfirmdelete-component>
                    <p
                        v-if="successFlag"
                        class="alert alert-success">{{msnSuccess}}</p>
                    <div v-if="!successFlag">
                        <button
                            v-if="deleteAdvert" 
                            v-on:click="onClickDelete()"
                            class="col-12 col-md-4 col-lg-3 btn btn-danger m-1">Eliminar anuncio</button>
                        <button 
                            v-if="deleteAdvert" 
                            v-on:click="deleteAdvert=!deleteAdvert"
                            class="col-12 col-md-4 col-lg-3 btn btn-secondary m-1">Cancelar</button>
                    </div>                    
                </div>               
            </div>                                  
        </div>
    </div>    
</template>
<script>
export default { 
    props:[],
    data(){
        return{
            /**Errores de respuesta */
            responseErrorMsn:'',
            responseErrorCodig:'',
            /**show adver */
            id: this.$route.params.id,
            advert:[],            
            viewError:false,
            advertFlag:false,
            /**update advert */ 
            updateAdvert:false,
            activeCategories:false,
            /**delete advert */                                   
            deleteAdvert:false,
            successFlag:false,
            msnSuccess:'',
        }
    },
    mounted(){
        /**Solicitar detalles del anuncio axios.get() */
        axios.get(`/advert/${this.id}`)
            .then(response=>{
                console.log('obteniendo advert')
                // console.log(response.data)
                this.viewError=false;
                this.advert=response.data;
                this.advertFlag=true;
            })
            .catch(err=>{
                console.log('hay errores')
                // console.log(err);
                console.log(err.response.status)

                if(err.response.status===404){
                    this.responseErrorMsn='No found';
                    this.responseErrorCodig= err.response.status;
                    this.viewError=true;
                }
            });
    },
    methods:{
        onClickEdit(){

            this.updateAdvert=true;         

            /**También está el método de instancia vm.$nextTick(), el cual es especialmente útil dentro de
             *  los componentes, porque no necesita Vue global y el contexto this del callback será 
             *  automáticamente ligado a la instancia Vue actual: */
            this.$nextTick(function () {
                this.activeCategories=true;
            })
                       
        },        
        onClickDelete(){
            /**Eliminar anuncio */
            axios.delete(`/advert/${this.advert.id}`)
                .then(response=>{
                    console.log('Delete Advert')
                    this.successFlag=true;
                    this.msnSuccess = response.data.success;
                    setTimeout(function(){ location.replace('/alladverts') }, 2000); 

                })
                .catch(err=>{
                console.log('hay errores')
                // console.log(err);                

                if(err.response.status===403){                    
                    this.responseErrorMsn=err.response.data.message;
                    this.responseErrorCodig= err.response.status;
                    this.viewError=true;
                }
            });
        },       
    }
}
</script>

<style scoped>
    .bg-show{
        background-color: #01d0ff;
    }
    .pill_edit{
        font-size: 1rem;
        cursor: pointer;
        width: 50%;
    }
    .pill_delete{
        font-size: 1rem;
        cursor: pointer;
        width: 50%;
    }

    .pill_edit:hover{
        background-color: #3566af;
        color: white;
        width: 80%;
    }
    
    .pill_delete:hover{
        background-color: #b70404;
        color:white;
        width: 80%;
    }
</style>