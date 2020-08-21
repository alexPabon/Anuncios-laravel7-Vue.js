<template>
    <tr>
        <th scope="row">{{privilege.id}}</th>
        <td>
            <span v-text="privilege.label"></span>
            <div v-if="edit">
                <input v-model.trim="privilege.label" type="number" class="form-control">                
                <!-- Errores al actualizar -->
                <p class="text-danger">
                    <small 
                        v-for="(error, index) in errorUpdate.label"
                        :key="index">-{{error}}
                    </small>
                </p>
            </div>                        
        </td>                       
        <td>
            <span v-text="privilege.name"></span>
            <div v-if="edit">
                <input v-model.trim="privilege.name" type="text" class="form-control">
                <span @click="updatePrivilege" class="btn btn-success">Guardar</span>
                <!-- Errores al actualizar -->
                <p class="text-danger">
                    <small 
                        v-for="(error, index) in errorUpdate.name"
                        :key="index">-{{error}}
                    </small>
                </p>
            </div>                        
        </td>                        
        <td>{{privilege.updated_at}}</td>
        <td class="text-info">
            <span @click="edit=!edit" class="links">Edit</span>  &nbsp;    
            <span v-if="!del" @click="del=!del" class="link">Delete</span>
            <div v-if="del">
                <span @click="deletePrivilege" class="btn btn-danger">Destroy</span>
                <span @click="del=!del" class="btn btn-secondary">Cancel</span>
            </div>                            
        </td>
    </tr>                       
</template>

<script>
export default {
    props:['privilege'],
    data(){
        return{
            edit:false,
            del:false,

            errorUpdate:[],            
        }
    },
    methods:{
        updatePrivilege(){
            this.edit=false;
            this.errorUpdate=[];            

            axios.put(`/privilege/${this.privilege.id}`, this.privilege)
                .then(response=>{
                    console.log('Actualizado correcto')
                    console.log(response);
                    this.$emit('update',response.data)
                })
                .catch(err=>{
                    console.log('Hay errores al actualizar') 
                    console.log(err.response);

                    this.edit=true;
                    if(err.response.status==422)
                        this.errorUpdate= err.response.data.errors;
                })
        },
        deletePrivilege(){
            this.del=false;
            
            axios.delete(`/privilege/${this.privilege.id}`)
                .then(response=>{
                    console.log('eliminado correcto')
                    this.$emit('delete');                    
                })
                .catch(err=>{
                    console.log('hay error al eliminiar privilegio')
                    console.log(err.response);
                })
        }
    }
}
</script>