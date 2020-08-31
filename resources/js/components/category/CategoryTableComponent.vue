<template>
    <tr>
        <th scope="row">{{category.id}}</th>                        
        <td>
            <span v-text="category.name"></span>
            <div v-if="edit">
                <input v-model.trim="category.name" type="text" class="form-control">
                <span @click="updateCategory" class="btn btn-success">Guardar</span>
                <!-- Errores al actualizar -->
                <p
                    v-for="(errors, index) in errorUpdate"
                    :key="index"
                    class="text-danger">
                        <small v-for="(error, index) in errors"
                        :key="index">-{{error}}</small>
                </p>
            </div>                        
        </td>                        
        <td>{{category.updated_at}}</td>
        <td v-if="isAdmin" class="text-info">
            <span @click="edit=!edit" class="links">Edit</span>  &nbsp;    
            <span v-if="!del" @click="del=!del" class="link">Delete</span>
            <div v-if="del">
                <span @click="deleteCategory" class="btn btn-danger">Destroy</span>
                <span @click="del=!del" class="btn btn-secondary">Cancel</span>
            </div>                            
        </td>
    </tr>                       
</template>

<script>
export default {
    props:['category'],
    data(){
        return{
            edit:false,
            del:false,

            errorUpdate:[],            
        }
    },
    methods:{
        updateCategory(){
            this.edit=false;
            this.errorUpdate=[];            

            axios.put(`/category/${this.category.id}`, this.category)
                .then(response=>{
                    console.log('Actualizado correcto')
                    // console.log(response);
                    this.$emit('update',response.data)
                })
                .catch(err=>{
                    console.log('Hay errores al actualizar') 
                    // console.log(err.response);

                    this.edit=true;
                    this.errorUpdate= err.response.data.errors;
                })
        },
        deleteCategory(){
            this.del=false;
            
            axios.delete(`/category/${this.category.id}`)
                .then(response=>{
                    console.log('eliminado correcto')
                    this.$emit('delete');                    
                })
                .catch(err=>{
                    console.log('hay error al eliminiar categoria')
                    console.log(err.response);
                })
        }
    }
}
</script>