<template>
    <div class="container" v-if="isAuthenticated">        
        <div class="card text-dark p-3">                      
            <form action="" v-on:submit.prevent="newCommentary()">
                <div class="form-group">
                    <label for="commentary font-italic">Escribe tu comentario:</label>                    
                    <textarea
                        v-model="description"
                        class="form-control" id="commentary" rows="4">
                    </textarea>
                </div>
                <transition name="bounce">
                <button 
                    v-if="show" 
                    v-on:click="show=!show"  
                    type="submint" 
                    class="col-12 col-md-5 col-lg-3 btn-gradient bg-primary btn btn-primary my-1">Publicar Comentario</button>                
                </transition>
                <div class="pt-3 text-danger" v-if="mostrarErrors">                    
                    <small class="p-0 px-2 m-0 bg-warning rounded">{{msn}}</small>                    
                    <div v-for="(value,index) in errores" :key="index">
                        <small class="p-0 pl-3 m-0 d-block" v-for="err in value" :key="err">- {{err}} </small>
                    </div>
                </div>                
            </form>            
        </div>        
    </div>
    <div v-else class="text-center p-0 py-2">
        <a class="text-center bg-gradient py-2 px-3 bg-danger badge-pill" href="/login">Inicia sesion para ver este contenido</a>
    </div>
    
</template>

<script>
    export default {
        data(){
            return {
                description:'',
                errores:'',
                msn:'',
                show:true,
                mostrarErrors:false
            }
        },
        mounted() {
            console.log('form mounted.')
        },
        methods:{
            newCommentary(){

                // const params ={
                //     description: this.description
                // }               
                
                const newCommentary = new FormData();
                newCommentary.append('description',this.description);

                this.mostrarErrors =false;
                
                axios.post('/commentary', newCommentary)
                    .then((response)=>{
                        console.log('response')
                        const commentary = response.data;
                        this.$emit('new',commentary);
                        this.description='';
                        this.show=true;
                    })
                    .catch(err =>{
                        let msnErrores = err.response.data;
                        console.log(msnErrores);                        
                        this.errores = msnErrores.errors;
                        this.msn = msnErrores.message;

                        this.mostrarErrors =true;
                        this.show=true;
                         
                    });

                // let commentary = {
                //     id:2,
                //     description: this.description,
                //     create_at:'10/02/2020'
                // };
                                
                
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