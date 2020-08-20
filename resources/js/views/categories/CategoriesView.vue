<template>
    <div class="container pt-5">
        <errors-component
            v-if="errorFlag"
            :codig=errorCodig
            :mensaje=errorMsn
        ></errors-component>
        <div v-if="!errorFlag">
            <h4>Categories</h4>            
            <div class="py-2 col-12 col-md-6 col-lg-4">
                <form v-on:submit.prevent="newCategory()" action="">
                    <input v-model="name" type="text" class="form-control" placeholder="Nueva categoria">                    
                    <button type="submit" class="btn btn-primary">Crear cátegoria</button>
                    <div>
                        <!-- Errores nueva categoria -->
                        <p
                            v-for="(errors,index) in errorData"
                            :key="index"
                            class="text-danger">
                            <span
                                v-for="(error, index) in errors"
                                :key="index">{{error}}</span>
                        </p>
                    </div>
                </form>
            </div>
            <div>
                <table class="table table-striped table-light">
                    <thead class="bg-primary">
                        <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- tabla de categorias -->
                        <categorytable-component
                            v-for="(category,index) in categories"
                            :key="index"
                            :category="category"
                            @update="updateCategory(index, ...arguments)"                            
                            @delete="deleteCategory(index)">
                        </categorytable-component>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    data(){
        return{
            categories:[],                        
            name:'',
            
            errorData:[],

            /**Error de permisos*/
            errorFlag:false,
            errorCodig:'',
            errorMsn:'',
        }
    },
    mounted(){
        axios.get('/category')
            .then(response=>{
                this.categories= response.data;
                console.log(this.categories);                
            })
            .catch(err=>{
                console.log('Error al cargar categorias')
                console.log(err.response);                

                if(err.response.status==403){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            })
    },
    methods:{
        newCategory(){

            this.errorPost='';
            this.errorData=[];
            
            const params={
                'name':this.name,
            }

            axios.post('/category', params)
                .then(response=>{
                    console.log('Se ha guardado la categoria')
                    this.categories.unshift(response.data);
                    this.name='';
                    this.errorPost='';
                })
                .catch(err=>{
                    console.log('hay errores al guardar la categoria')
                    console.log(err.response);                   

                    if(err.response.status==422)                        
                        this.errorData = err.response.data.errors;
                                 
                })
        },
        updateCategory(index,category){
            // para insertar el nuevo valor en el array
            // Vue.set(this.array, index, newValue);
            Vue.set(this.categories, index, category);
        },
        deleteCategory(index){
            this.categories.splice(index,1)            
        }
    }
}
</script>