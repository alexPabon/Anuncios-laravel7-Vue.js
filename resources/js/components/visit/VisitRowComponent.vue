<template>
    <tr
        @click="seeMap"
        class="links_visit">
        <td>{{num}}</td>
        <td>
                <span @click="seeDatails">
                    <router-link :to="{path:`/showip/${visitor.number_ip}/${auth}`}" class="num_ip" title="Ver detalles">
                        {{visitor.number_ip}}
                    </router-link>
                </span>
        </td>
        <td>{{visitor.country}}</td>
        <td>{{visitor.city}}</td>
        <td>{{visitor.quantity}}</td>
        <td><small>{{visitor.updated_at}}</small></td>
    </tr>
</template>

<script>
export default {
    props:['visitor','num','auth'],
    data(){
        return{

        }
    },
    methods:{
        seeDatails(){
            let coordenadas = 'lat: '+this.visitor.latitude+'\n'+'lon: '+this.visitor.longitude;
            alert(coordenadas);
        },
        seeMap(){

        }
    }
}
</script>

<style scoped>

    .links_visit:hover{
        background: rgb(7, 15, 36);
        color: aliceblue;
    }

    .num_ip:hover{
        color: aliceblue;
    }
</style>
