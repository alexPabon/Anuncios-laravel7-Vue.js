<template>
    <div class="container">
        <nav aria-label="...">
            <ul class="pagination flex-wrap mt-2">
                <link-component
                v-for="(link, index) in all_links"
                :key="index"
                :url="link.url"
                :label="link.label"
                :active="link.active"
                @go="goTo">
                </link-component>
            </ul>
            <p class="p-0 m-0 font-weight-bold text-primary">Desde {{from}} Hasta {{to}}  de {{tot}} </p>
        </nav>
    </div>
</template>

<script>
export default {
    props:['objeto','builderFlag','to','from','tot','search'],
    data(){
        return{
            lastPage: this.objeto.lastPage,
            currentPage: this.objeto.currentPage,
            path: this.objeto.path,
            url:'',
            links:'',
        }
    },
    mounted(){

    },
    methods:{
        goTo(pag){
            this.$emit('goToPage',pag);
        },
        builderLinks(){
            let currentPage = this.currentPage;
            let total = this.total();
            let previous = this.previous_page();
            let next = this.next_page();

            let links = [previous];
            let label = 1;

            for (var i=1; i <=total ; i++) {

                if(i==3 && currentPage-5>=3 && this.lastPage>13){
                    links.push(this.make('null','...',false));
                    label = (currentPage+5>=this.lastPage)?this.lastPage-10:currentPage-4;
                }
                else if(i==11 && currentPage+6<this.lastPage){
                    links.push(this.make('null','...',false));
                    label = this.lastPage-2;
                }
                else{
                    links.push(this.make(this.url+label,label,(currentPage==label)));
                }

                label++;
            }

            links.push(next);

            return links
        },

        /**
        * crear un objeto
        */
        make(url,label,active){
            let obj = {};

            obj.url = url;
            obj.label = label;
            obj.active = active;

            return obj;
        },

        next_page(){
            let next = (this.currentPage+1<=this.lastPage)?
                        this.make(this.url+(this.currentPage+1),'Next &raquo;',false) :
                        this.make('null','Next &raquo;',false);

            return next;
        },

        previous_page(){
            let previous = !(this.currentPage-1<1)?
                            this.make(this.url+(this.currentPage-1),'&laquo; Previous',false) :
                            this.make('null','&laquo; Previous',false);

            return previous;
        },

        total(){
            return (this.lastPage>13)? 13 : this.lastPage;
        },
    },
    computed:{
        all_links(){
            return this.links;
        },
    },
    watch:{
        builderFlag:function(){
            this.lastPage= this.objeto.lastPage,
            this.currentPage= this.objeto.currentPage,
            this.path= this.objeto.path
            this.url = this.path+'?search='+this.search+'&page=',
            this.links = this.builderLinks();
        }
    }
}
</script>
