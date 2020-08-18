<template>
    <div class="container">
        <nav aria-label="...">                    
            <ul class="pagination flex-wrap mt-2">
                <li class="page-item" v-if="!(currentPage<=1)" v-on:click="goTo(currentPage-1)">
                    <a class="page-link" href="#" aria-label="Previous"  v-on:click.prevent>
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>

                <page-component 
                    v-for="num in lastPage" 
                    :key="num"
                    :class="pageCurrentActive(num)"
                    :num="num"
                    @go="goTo">
                </page-component>
                
                <li class="page-item" v-if="!(currentPage>=lastPage)" v-on:click="goTo(currentPage+1)">
                    <a class="page-link" href="#" aria-label="Next"  v-on:click.prevent>
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
            <p class="p-0 m-0 lead font-weight-bold text-primary">{{tablePos}}: {{from}} de {{total}}</p>   
        </nav>                    
    </div>
</template>

<script>
export default {
    props:['lastPage','from','total','currentPage','tablePos'],
    data(){
        return{
            // table:'Usuarios',
            // lastPage:5,
            // from:1,
            // total:15,
            // currentPage:2
        }
    },
    methods:{
        pageCurrentActive(page){
            return (this.currentPage==page)?['active']:'';
        },
        goTo(pag){
            this.$emit('goToPage',pag);
        }
    }
}
</script>