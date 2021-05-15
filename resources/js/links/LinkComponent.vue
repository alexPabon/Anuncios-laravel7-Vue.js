<template>     
    <li v-on:click="onClickGoPage(url)" :class="[active? 'active':'']" class="page-item">
        <a class="page-link" style="box-shadow:none" href="" v-on:click.prevent v-html="label"></a>
    </li>
</template>

<script>
export default {
    props:['url','label','active'],
    data(){
        return{

        }
    },
    methods:{
        onClickGoPage(pageUrl){            
            this.$emit('go',pageUrl);             
        },
    }
}
</script>