<template>
    <li @click="selectValue" :class="[show?'btn-info mt-1':'']" class="list-group lead px-2 py-1">
        <a class="d-flex justify-content-between align-items-center">            
            <span>{{name}}</span>
            <span v-if="show" class="badge badge-primary badge-pill">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
                </svg>
            </span>
        </a>
    </li>    
    
</template>

<script>
export default {
    props:['name','value','categories'],
    data(){
        return{
            show:false
        }
    },
    mounted(){
        this.categories.forEach(element => {
            if(element==this.value)
                this.show=true
        });        
    },
    methods:{
        selectValue(){
            if(this.show){                 
                this.show=false;

                for (var i = this.categories.length; i--;) {
                    if (this.categories[i] === this.value)
                        this.categories.splice(i, 1);
                }
                
                this.$emit('updateValue');           
                
            }else{                
                this.categories.push(this.value);
                this.show=true;
                this.$emit('updateValue');
            }
            
        }
    }
}
</script>