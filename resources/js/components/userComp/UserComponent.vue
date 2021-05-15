<template>
    <div>        
        <div class="mx-auto container mt-2">              
            <div class="row justify-content-center text-dark">
                <div class="mx-auto col-md-8">
                    <div class="card lead">
                        <!-- Confirmar borrado -->
                        <userconfirmdelete-component
                        v-if="deleteUs"
                        :name=usuario.name
                        ></userconfirmdelete-component>                        
                        <div class="panel-body bg-pink bg-light border p-3" v-if="editMode"> 
                            <!-- Formulario para editar perfil -->
                            <userformedit-component
                                :usuario=usuario
                                @save="updateUser"
                            ></userformedit-component>
                            <div class="pt-3 text-danger" v-if="mostrarErrors">                    
                                <small class="p-0 m-0">-{{msn}}</small>                    
                                <div 
                                    v-for="value in errores" 
                                    :key="value">
                                        <small 
                                            class="p-0 m-0 d-block" 
                                            v-for="err in value" 
                                            :key="err">
                                                - {{err}}
                                        </small>
                                </div>
                            </div>
                        </div>
                        <!-- Detalles del usuario -->
                        <div class="panel-body border p-2" v-if="!editMode&&!deleteUs">                            
                            <p>
                                <b>Nombre:</b> {{usuario.name}} <br>
                                <b>Telefono:</b> {{usuario.phone}} <br>
                                <b>Email:</b> <b class="text-info">{{usuario.email}}</b><br>
                                <b>Email verificado:</b> {{(usuario.email_verified_at!=null)?'Si':'No'}}<br>
                                <b>Privilegio:</b> {{usuario.privilege.name}} <br>
                                <b>Actualizado:</b> {{usuario.updated_at}}                                
                            </p>
                            <p v-if="isAdmin">id: {{usuario.id}}</p>                             
                        </div>
                        <div class="panel-footer p-2 text-center text-md-left" v-if="isAdmin || user.id==usuario.id ">                        
                            <div v-if="editMode">
                                <button
                                    v-if="saveChange"
                                    v-on:click="onClickUpdate"
                                    class="col-11 col-md-5 col-lg-3 btn-gradient bg-success btn btn-success m-1" >Guardar cambios</button>
                                <button class="col-11 col-md-5 col-lg-3 btn-gradient bg-secondary btn btn-secondary m-1" v-on:click="onClickCancel">Cancelar</button>
                            </div>
                            <div v-else>    
                                <button class="col-11 col-md-5 col-lg-3 btn-gradient bg-primary btn btn-primary m-1" v-if="!deleteUs" v-on:click="onClickEdit">Editar</button>           
                                <button class="col-11 col-md-4 col-lg-3 btn-gradient bg-danger btn btn-danger m-1" v-if="!deleteUs" v-on:click="deleteUs=!deleteUs">Eliminar</button>

                                <button class="col-11 col-md-4 col-lg-3 btn btn-danger m-1" v-if="deleteUs" v-on:click="onClickDelete()">Eliminar Cuenta</button>
                                <button class="col-11 col-md-4 col-lg-3 btn btn-secondary m-1" v-if="deleteUs" v-on:click="deleteUs=!deleteUs">Cancelar</button>
                            </div>                                                
                        </div>
                    </div>
                </div>
            </div>        
        </div>        
    </div>
</template>

<script>
export default {
    props:['usuario'],
    data(){        
        return {
            editMode:false,
            errores:'',
            msn:'',
            viewErrors:false,
            deleteUs:false,
            mostrarErrors:false,
            saveChange:true,           
        };
    },
     mounted() {
        console.log('Component USER mounted.')        
    },
    methods:{
       onClickDelete(){
            this.$emit('delete',this.usuario.id);                
        },
        onClickEdit(){
            this.mostrarErrors =false;
            this.editMode = true;
        },
        onClickUpdate(){                 
            
            this.editMode = false; 
            
            axios.put('/user/'+this.usuario.id,this.usuario)
                .then((response)=>{                                                                                                                                              
                    console.log('update user mounted.')                     
                })
                .catch(err =>{
                    let msnErrores = err.response.data;                    
                    this.errores = msnErrores.errors;
                    this.msn = msnErrores.message;
                    console.log('Errores');
                    console.log(err.response.data);
                    this.mostrarErrors =true;
                    this.editMode=true;
                });
        },
        onClickCancel(){            
            this.editMode = false;
            this.saveChange=true;            
            
            axios.get('/user/'+this.usuario.id)
                .then((response)=>{ 
                    let newValue = response.data
                    this.$emit('cancelUpdate',newValue);  
                                        
                })
                .catch(err =>{
                    let msnErrores = err.response.data;                    
                    this.errores = msnErrores.errors;
                    this.msn = msnErrores.message;
                    
                    this.mostrarErrors =true;
                    this.editMode=true;
                });
            
        },
        updateUser(flag){
            this.saveChange=flag;
        }

    }
    
}
</script>

<style scoped>

</style>