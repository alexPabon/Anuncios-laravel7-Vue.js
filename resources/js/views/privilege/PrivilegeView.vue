<template>
    <div class="container pt-5">
        <errors-component
            v-if="errorFlag"
            :codig=errorCodig
            :mensaje=errorMsn
        ></errors-component>
        <div v-if="!errorFlag">
            <h4>privileges</h4>            
            <div class="py-2 col-12 col-md-6 col-lg-4">
                <form v-on:submit.prevent="newPrivilege()" action="">
                    <input v-model="label" type="number" class="form-control" placeholder="label" >
                    <input v-model="name" type="text" class="form-control" min="3" max="30" placeholder="Nuevo privilegio" >                    
                    <button type="submit" class="btn btn-primary">Crear privilegio</button>
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
                        <th scope="col">Label</th>
                        <th scope="col">Name</th>
                        <th scope="col">Updated at</th>
                        <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- tabla de privilegios -->
                        <privilegetable-component
                            v-for="(privilege,index) in privileges"
                            :key="index"
                            :privilege="privilege"
                            @update="updatePrivilege(index, ...arguments)"                            
                            @delete="deletePrivilege(index)">
                        </privilegetable-component>
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
            privileges:[],                        
            name:'',
            label:'',
            
            errorData:[],

            /**Error de permisos*/
            errorFlag:false,
            errorCodig:'',
            errorMsn:'',
        }
    },
    mounted(){
        axios.get('/privilege')
            .then(response=>{
                this.privileges= response.data;
                console.log(this.privileges);                
            })
            .catch(err=>{
                console.log('Error al cargar privilegios')
                console.log(err.response);                

                if(err.response.status==403 || err.response.status==401){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            })
    },
    methods:{
        newPrivilege(){

            this.errorPost='';
            this.errorData=[];
            
            const params={
                'name':this.name,
                'label':this.label,
            }

            axios.post('/privi', params)
                .then(response=>{
                    console.log('Se ha guardado la categoria')
                    this.privileges.unshift(response.data);
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
        updatePrivilege(index,privilege){
            // para insertar el nuevo valor en el array
            // Vue.set(this.array, index, newValue);            
            Vue.set(this.privileges, index, privilege);
        },
        deletePrivilege(index){
            this.privileges.splice(index,1)            
        }
    }
}
</script>