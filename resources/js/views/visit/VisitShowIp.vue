<template>
    <div class="pt-5 bg-purple hg-10-container bg-gradient">
        <errors-component
            v-if="errorFlag"
            :codig=errorCodig
            :mensaje=errorMsn
        ></errors-component>
        <div v-if="!errorFlag" class="container">
            <h1>Detalles {{visitorTitle}}</h1>
            <router-link :to="{name:gotBackToPage}" class="text-decoration-none">
                <button class="btn btn-primary my-2">Volver</button>
            </router-link>
            <!-- Detalles donde ha ingresado una determinada ip -->
            <div>
                <p>
                    <span class="text-info">IP:</span> {{infoIp.number_ip}}<br>
                    <span class="text-info">Pais:</span> {{infoIp.country}}<br>
                    <span class="text-info">Ciudad:</span> {{infoIp.city}}<br>
                    <span class="text-info">CP:</span> {{infoIp.zip}}<br>
                    <span class="text-info">Lat:</span> {{infoIp.latitude}}<br>
                    <span class="text-info">Lon:</span> {{infoIp.longitude}}
                </p>
            </div>
            <table class="table table-striped table-light">
                <thead class="bg-primary">
                    <tr>
                        <th><small>Nº</small></th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Direccion</th>
                        <th>Visitado</th>
                        <th scope="col"><small>Ultimo acceso</small></th>
                    </tr>
                </thead>
                <tbody>
                    <tr
                        v-for="(visitor, index) in visitorIps"
                        :key="index"
                        class="links_ip">
                            <td><small>{{index+1}}</small></td>
                            <td>{{(visitor.user != undefined)? visitor.user.name:'anonimo'}}</td>
                            <td>{{visitor.address}}</td>
                            <td>{{visitor.quantity}}</td>
                            <td><small>{{visitor.updated_at}}</small></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props:['ip','authenticated'],
    data(){
        return{
            visitorIps:[],
            visitorTitle:'',
            infoIp:'',
            gotBackToPage:'all-visitors',

            /**Error de permisos*/
            errorFlag:false,
            errorCodig:'',
            errorMsn:'',
        }
    },
    mounted(){

        if(this.authenticated==1)
            this.visitorAuth();
        else
            this.visitorNoAuth();
    },
    methods:{
        visitorAuth(){

            /** ver detalles de una determinada Ip en la tabla
             * de visitante autenticado
             */
            console.log('autenticado');

            axios.get(`/visitauth/${this.ip}`)
            .then(response=>{
                console.log('Carga detalles ip')

                this.visitorTitle = 'Visitante autenticado'
                this.visitorIps= response.data.seen;
                this.infoIp = response.data;
                this.gotBackToPage = 'all-visitors-auth';

                console.log(this.visitorIps);
            })
            .catch(err=>{
                console.log('Error al cargar ip')

                if(err.response.status==403 || err.response.status==401){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            })

        },
        visitorNoAuth(){

            /** ver detalles de una determinada Ip en la tabla
             * de visitante NO autenticado
             */
            console.log('NO autenticado');
            axios.get(`/visit/${this.ip}`)
            .then(response=>{
                console.log('Carga detalles ip')
                console.log(response.data);
                this.visitorTitle = 'Visitante No autenticado'
                this.visitorIps= response.data.seen;
                this.infoIp = response.data;
            })
            .catch(err=>{
                console.log('Error al cargar ip')
                console.log(err.response);

                if(err.response.status==403 || err.response.status==401){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            })
        }
    }
}
</script>

<style scoped>
    .links_ip:hover{
        background: rgb(19, 29, 56);
        color: aliceblue;
    }
</style>
