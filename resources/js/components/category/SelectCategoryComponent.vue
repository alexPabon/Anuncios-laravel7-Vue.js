<template>
    <div>
        <div class="col-9 col-md-7 col-lg-4">
            <p  class="p-0 m-0">Elige la categoría:</p>        
            <div
                v-on:click="show=!show;onClickCategories()"
                :class="[btnFlag?'btn-primary':'btn-danger']"
                class="rounded btn d-flex justify-content-around align-items-center p-0 m-0 text-capitalize d-block">
                    <span class="col-10 pl-1 py-1 d-inline-block">
                            <b class="text-dark">Categorías:</b> {{textCategory}}                            
                    </span>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path d="M11.646 15.146L5.854 9.354a.5.5 0 01.353-.854h11.586a.5.5 0 01.353.854l-5.793 5.792a.5.5 0 01-.707 0z"></path>
                        </svg>
                    </span>  
            </div>
            <ul 
                v-if="show"
                class="border list-unstyled p-1 hg-3-select bg-light text-dark text-capitalize">
                    <option-component
                        v-for="category in categories" :key="category.id"
                        :value="category.id"
                        :name="category.name"
                        :categories="selectedCategory"
                        @updateValue="optionsVal">
                    </option-component>
            </ul>
            <small class="text-danger">{{categoriesNotSelected}}</small>
        </div>
    </div>
</template>

<script>
export default {
    props:['cat','closeMenu','restart'],
    data(){
        return{
            show:false,
            btnFlag:true,
            categories:[],
            selectedCategory:this.cat,
            defaultValueCategory:'',
            textCategory:'',
            categoriesNotSelected:'',
            flag:true,            
        }
    },
    mounted(){        
        axios.get('/category')
            .then(respone=>{                
                this.categories=respone.data                
                this.optionsVal();                
            })
            .catch(err=>{
                console.log('Se produjo un error al cargar las categorias')
            });
    },
    methods:{
        optionsVal(){
            let cont=0;
            this.textCategory='';

            this.selectedCategory.forEach(element => {
                this.categories.forEach(option => {
                    if(element==option.id){
                        let coma = cont?', ':'';
                        this.textCategory+= coma + option.name;
                        cont=1;
                    }
                });
            });
        },
        onClickCategories(){            
            
            if(this.textCategory==''){
                this.btnFlag=false;
                this.categoriesNotSelected='-- Debe seleccionar al menos una categoria';
            }
            else{
                this.btnFlag=true;
                this.categoriesNotSelected='';
            }
                
            this.$emit('verifyCategories');
        }       
    },
    watch:{
        closeMenu:function(){
            this.show=false;
        },
        restart:function(){            
            this.selectedCategory=this.cat;           
            this.selectedCategory.push(this.defaultValueCategory);
            this.optionsVal();            
        },
        cat:function(){
            this.optionsVal();
        }
    }
}
</script>


