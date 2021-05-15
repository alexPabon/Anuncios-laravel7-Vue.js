<template>
    <div>
        <errors-component            
            :codig=responseErrorCodig
            :mensaje=responseErrorMsn
        ></errors-component>        
    </div>
</template>

<script>
export default {
    data(){
        return{
            responseErrorMsn:'No Found',
            responseErrorCodig:404,
        }        
    },    
}
</script>