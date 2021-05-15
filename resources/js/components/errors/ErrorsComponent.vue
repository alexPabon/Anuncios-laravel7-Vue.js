<template>
    <div class="pt-5">
        <div class="text-left p-3 rounded col-12 col-md-6 col-lg-4 mx-auto">
            <div class="font-weight-bold" style="font-size: 15vh;">{{codig}}</div>
            <div class="pt-1 bg-danger rounded col-2"></div>
            <div class="lead">{{mensaje}}</div>
            <a href="/">
                <button class=" lead bg-transparent text-primary font-bold uppercase tracking-wide px-5 py-2 mt-3 border-2 border-grey-light hover:border-primary rounded-lg">
                    Go Home
                </button>
            </a> 				
        </div>
    </div>
</template>

<script>
export default {
    props:['codig','mensaje'],
    data(){
        return{
            // codig:'403',
            // mensaje:'No autorizado'
        }
    }
}
</script>