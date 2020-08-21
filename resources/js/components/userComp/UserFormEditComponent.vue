<template>
    <div>
       <form>
            <!-- Datos -->
            <div class="form-row">
                <div class="col-12 col-md-6">
                    <label :for="['name'+usuario.id]">Nombre</label>
                    <input 
                        v-model="usuario.name" 
                        :id="['name'+usuario.id]"                        
                        type="text" min="4" max="254" class="form-control" name="name" required>
                </div>
                <div class="col-12 col-md-6">
                    <label :for="['phone'+usuario.id]">Telefono</label>
                    <input 
                        v-model="usuario.phone"
                        v-on:blur="verifyAllInputs({'phone':usuario.phone})"
                        v-on:focus="tel=false"
                        :class="[tel?'is-invalid':'']"
                        :id="['phone'+usuario.id]"                        
                        type="text" class="form-control" name="phone">
                    <small v-if="tel" class="text-danger small-mini">{{errorTel}}</small>
                </div>                
            </div>
            <!-- email -->
            <div class="form-row mt-1">
                <div v-if="emailDisable" class="col-12 col-md-8">                                         
                    <label :for="['email'+usuario.id]">Email</label>
                    <input
                        v-model="usuario.email"
                        v-on:blur="verifyAllInputs({'email':usuario.email})"
                        v-on:focus="focusEmail"
                        :class="[emailFlag?'is-invalid':'',matchEmail?'is-valid disabled':'']"
                        :id="['email'+usuario.id]"
                        type="email" class="form-control" name="email" required>
                    <small v-if="emailFlag" class="text-danger small-mini">{{errorEmail}}</small>
                    <input 
                        v-model="verifyEmail"
                        v-on:focus="editEmail=true"
                        v-on:blur="verifyAllInputs({'verifyEmail':verifyEmail})"
                        :class="[emailFlag?'is-invalid':'',matchEmail?'is-valid':'']"
                        type="text"
                        class="form-control"
                        placeholder="Confirmar email">                  
                </div>                                
                <div v-else class="col-12 col-md-8">                                         
                    <label>Email</label>
                    <p class="form-control bg-light-grey p-2 m-0 overflow-hidden">{{usuario.email}}</p>
                </div>
                <div class="col-12 col-md-4 align-self-end">
                    <input 
                        v-on:click="emailDisable=!emailDisable; editEmail=true; verifyAllInputs({'check':true})" 
                        :id="['edit'+usuario.id]"
                        type="checkbox">
                    <label class="form-check-label" :for="['edit'+usuario.id]">
                        <small>Cambiar email</small>
                    </label>
                </div>
            </div>
            <!-- Privilegio -->
            <div class="form-group mt-2">
                <div class="form-row col-12 col-md-6 align-self-center">
                    <span>Privilegio:</span>                                        
                    <select 
                        v-if="privilegeDisable"
                        v-model="usuario.privilege_id" 
                        :id="['privi'+usuario.id]"
                        name="privilege_id">                        
                        <option
                            v-for="privilege in privileges"
                            :key="privilege.id" 
                            :value="privilege.id"
                            class="text-capitalize">
                                {{privilege.name}}
                        </option>
                    </select>                    
                    <small v-else class="align-self-center px-2">{{usuario.privilege.name}}</small>                    
                </div>
                <div v-if="isAdmin" class="col-12 col-md-4 align-self-end">
                    <input 
                        v-on:click="privilegeDisable=!privilegeDisable"
                        :id="['editPriv'+usuario.id]" 
                        type="checkbox">
                    <label class="form-check-label" :for="['editPriv'+usuario.id]">
                        <small>Cambiar privilegio</small>
                    </label>
                    <p>id: {{usuario.id}}</p> 
                </div>                                              
            </div>            
        </form>
    </div>
</template>

<script>
export default {
    props:['usuario'],    
    data(){
       
        return{
            emailDisable:false,
            privilegeDisable:false,
            verifyEmail:'',
            editEmail:false,
            matchEmail:false,
            errorEmail:'',
            emailFlag:false,
            tel:false,
            errorTel:'',
            
            /**privileges */
            privileges:[],
        }
    },
    mounted(){
        axios.get('/privilege')
            .then(response=>{
                this.privileges= response.data;
                // console.log(this.privileges);                
            })
    },
    methods:{
        verifyAllInputs(verifyInput){            
            
            /**
             * Expresiones regulares para verificar el telefono indicativo España,
             * verificar el email
             * verificar que coicida el email
             */
            // Telefono
            if(!/^(\+34|0034|34)?(6|7|8|9)*([0-9][ -]*){8}$/.test(verifyInput.phone)&&verifyInput.phone){
                this.errorTel='Numero de España ej: +34934082739 o 634082739';
                this.tel=true;                 
                this.$emit('save',false);              
            }
            
            // Que sea un email
            if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/.test(verifyInput.email)&&verifyInput.email){
                this.errorEmail='El email es incorrecto';
                this.emailFlag=true;                 
                this.$emit('save',false);
            }

            // Que coincidan los dos campos de email
            if(this.editEmail&&verifyInput.verifyEmail){
                if(verifyInput.verifyEmail==this.usuario.email && this.usuario.email!=''){
                    this.matchEmail=true;
                    this.editEmail=false;                    
                    this.emailFlag=false;
                }
                else{
                    this.errorEmail='No coiciden el email';
                    this.emailFlag=true; 
                    this.matchEmail=false;                              
                    this.$emit('save',false);
                }
            }
            
            // desactiva guardar
            if(verifyInput.check || this.editEmail)
                this.$emit('save',false);
            
            // si todo esta correcto
            if(!this.tel && !this.emailFlag && !this.editEmail)
                this.$emit('save',true);      

        },
        focusEmail(){
            this.emailFlag=false;
            this.matchEmail=false;
            this.editEmail=true;
            this.verifyEmail='';
        }
    }

}
</script>