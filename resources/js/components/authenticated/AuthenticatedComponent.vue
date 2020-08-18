<template>
    <div>
        <div v-if="!isAuthenticated" :load="[redirectPage()]"></div>
    </div>
</template>

<script>
export default {
    methods:{
        redirectPage(){
            location.replace('/login');
        },
    }
}
</script>