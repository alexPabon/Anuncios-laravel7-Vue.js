<template>
    <div class="pt-2">        
        <div>            
            <div>
                <table class="table table-striped table-light">
                    <thead class="bg-primary">                        
                        <tr>
                            <th scope="col">Nº</th>
                            <th scope="col">numero ip</th>
                            <th scope="col">Pais</th>
                            <th scope="col">ciudad</th>
                            <th scope="col">Visitas</th>
                            <th scope="col"><small>Ultimo acceso</small></th>
                        </tr>
                    </thead>
                    <tbody>
                        <visitrow-component
                        v-for="(visitor, index) in visitors"
                        :key="index"
                        :num="index+1"
                        :visitor="visitor"
                        :auth="auth">
                        </visitrow-component>
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</template>

<script>
export default {
    props:['visitors','auth'],
    data(){
        return{
            
        }
    },
    mounted(){

    }
}
</script>