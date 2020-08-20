<template>
    <div class="mx-auto container mt-2">              
        <div class="row justify-content-center text-dark">
            <div class="mx-auto col-md-8">
                <div class="card lead">
                    <div class="panel-heading border" v-if="user.id==commentary.user_id">
                        <span class="pl-3 pr-1 m-0 bg-dark text-light d-inline-block col-12 text-center font-weight-bold">Mi comentario</span>                        
                    </div>
                    <div v-else>
                        <span class="pl-3 pr-1 m-0 bg-light-blue d-inline-block">Comentario escrito por:</span>
                        <strong class="p-0 m-0 text-primary text-capitalize">
                            {{commentary.contact.name}}   &nbsp;                             
                        </strong>                                                    
                    </div>

                    <div class="panel-heading border">
                        <p v-if="isAdmin" class="p-0 m-0">
                            <span class="bg-light-blue m-0 px-2">email: </span>{{commentary.contact.email}} &nbsp; 
                            <span class="bg-light-blue m-0 px-2">id: </span>{{commentary.user_id}}
                        </p>
                        <span class="pl-3 pr-1 m-0 bg-light-blue d-inline-block">Publicado:</span>
                        <strong class="p-0 px-1 m-0">{{commentary.created_at}}</strong>
                    </div>                  

                    <div class="panel-body bg-pink bg-light border p-3" v-if="editMode">                        
                        <textarea
                            v-model="commentary.description"
                            class="form-control" id="commentary" rows="4">
                        </textarea>
                        <div class="pt-3 text-danger" v-if="mostrarErrors">                    
                            <small class="p-0 m-0">-{{msn}}</small>                    
                            <div v-for="value in errores" :key="value">
                                <small class="p-0 m-0 d-block" v-for="err in value" :key="err">- {{err}} </small>
                            </div>
                        </div>
                    </div>
                    <div v-else>                        
                        <p class="text-justify px-2 lead">
                            {{commentary.description}}
                        </p>                                              
                    </div>
                    <div class="panel-footer p-2 text-center text-md-left" v-if="user.id==commentary.user_id || isAdmin">                        
                        <div v-if="editMode">
                            <button
                                v-on:click="onClickUpdate"
                                class="col-11 col-md-5 col-lg-3 btn-gradient bg-success btn btn-success m-1" >
                                    Guardar cambios
                            </button>
                            <button
                                v-on:click="onClickCancel"
                                class="col-11 col-md-5 col-lg-3 btn-gradient bg-secondary btn btn-secondary m-1" >
                                    Cancelar
                            </button>
                        </div>
                        <div v-else>    
                            <button class="col-11 col-md-5 col-lg-3 btn-gradient bg-primary btn btn-primary m-1" v-on:click="onClickEdit">Editar</button>                        
                            <button class="col-11 col-md-5 col-lg-3 btn-gradient bg-danger btn btn-danger m-1" v-on:click="onClickDelete()">Eliminar</button>
                        </div>                                                
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
    export default {
        props:['commentary'],
        data(){
            return {                
                editMode:false,
                errores:'',
                msn:'',
                mostrarErrors:false,                                
            };
        },
        mounted() {
            console.log('commentary mounted.')            
        },
        methods:{
            onClickDelete(){
                this.$emit('delete',this.commentary.id);                
            },
            onClickEdit(){
                this.mostrarErrors =false;
                this.editMode = true;
            },
            onClickUpdate(){                 
               
                this.editMode = false; 
                
                axios.put('/commentary/'+this.commentary.id,this.commentary)
                    .then((response)=>{                                        
                        this.commentary.description = response.data.description;                                                                                   
                        console.log('update Mycommentary mounted.')                        
                    })
                    .catch(err =>{
                        let msnErrores = err.response.data;
                        console.log(msnErrores);
                        this.errores = msnErrores.errors;
                        this.msn = msnErrores.message;
                        
                        this.mostrarErrors =true;
                        this.editMode=true;
                    });
            },
            onClickCancel(){
                this.commentary.description ='';
                this.editMode = false;

                axios.get('/commentary/'+this.commentary.id)
                    .then((response)=>{                                        
                        this.commentary.description = response.data.description;                                                                                   
                        console.log('update Mycommentary mounted.')
                        console.log(response.data);
                    })
                    .catch(err =>{
                        let msnErrores = err.response.data;
                        console.log(msnErrores);
                        this.errores = msnErrores.errors;
                        this.msn = msnErrores.message;
                        
                        this.mostrarErrors =true;
                        this.editMode=true;
                    });                
            },
        }
    }
</script>