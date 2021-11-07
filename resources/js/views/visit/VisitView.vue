<template>
    <div class="pt-5">
        <errors-component
            v-if="errorFlag"
            :codig=errorCodig
            :mensaje=errorMsn
        ></errors-component>
        <div v-if="!errorFlag" class="container">
            <!-- Actulizar listas -->
            <div>
                <button
                    @click="downPDF"
                    class="btn bg-dark-red col-12 col-md-4 col-gl-2">
                    Descargar pdf
                </button>
                <button
                    @click="updateList"
                    class="btn btn-primary col-12 col-md-4 col-gl-2">
                    Actualizar Lista
                </button>
                <small class="alert-success rounded">{{msnSuccess}}</small>
                <small class="alert-danger rounded">{{msnError}}</small>
            </div>

            <!-- lista no autenticados -->
            <h1  class="text-capitalize text-center">todas las visitas</h1>
            <h5>visitante No autenticado</h5>
            <div>
                <visitlist-component
                    :visitors="visitors"
                    :auth="visitorNoAuthoFlag">
                </visitlist-component>
            </div>


            <!-- lista autenticado -->
            <h5>visitante autenticado</h5>
            <visitlist-component
            :visitors="visitorsAuth"
            :auth="visitorAuthFlag">
            </visitlist-component>
        </div>
    </div>

</template>

<script>
// import html2canvas from 'html2canvas';
import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable'



export default {
    data(){
        return{

            /** visitantes */
            visitors:[],
            visitorsAuth:[],
            visitorAuthFlag:'',
            visitorNoAuthoFlag:'',

            /** Actualizar lista */
            msnSuccess:'',
            msnError:'',

            /**Error de permisos*/
            errorFlag:false,
            errorCodig:'',
            errorMsn:'',
        }
    },
    mounted(){
        axios.get('/allvisit')
            .then(response=>{
                console.log('carga correcta de visitantes');
                this.visitors = this.sortJSON(response.data.noAuth, 'country', 'asc');
                this.visitorNoAuthoFlag=0;

                this.visitorsAuth= this.sortJSON(response.data.auth,'country','asc');
                this.visitorAuthFlag= 1;
            })
            .catch(err=>{
                console.log('Error al cargar visitantes Inicial')
                console.log(err.response);

                this.msnError= 'Se produjo un error al actulizar las listas';

                if(err.response.status==403 || err.response.status==401){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            })
    },
    methods:{
        updateList(){

            /** actualiza la informacion de los datos ip guardados */
            this.msnSuccess='';
            this.msnError='';

            axios.get('/visit')
            .then(response=>{
                console.log('carga correcta de visitantes')
                this.msnSuccess = response.data.update;

                setTimeout(function(){ location.reload() }, 2000);
            })
            .catch(err=>{
                console.log('Error al cargar visitantes')
                console.log(err.response);

                if(err.response.status==403 || err.response.status==401){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            })
        },
        sortJSON(data, key, orden) {
            // Ordena objeto JSON
            return data.sort(function (a, b) {
                var x = a[key],
                y = b[key];

                if (orden === 'asc') {
                    return ((x < y) ? -1 : ((x > y) ? 1 : 0));
                }

                if (orden === 'desc') {
                    return ((x > y) ? -1 : ((x < y) ? 1 : 0));
                }
            });
        },
        downPDF(){

            let ipNoAuth = [];
            let imagenp = './storage/images/tablon/no-image.png';
            var doc = new jsPDF();
            var elementHandler = {
                '#ignorePDF': function (element, renderer) {
                    return true;
                }
            };

            doc.autoTable({ html: '#noAuthTable' })

            this.visitors.forEach(function(visit, index){
                ipNoAuth.push([visit.country,visit.city,visit.cant]);
            });


            doc.autoTable({
                head: [['Pais', 'Cudad', 'Cant visitas']],
                body: ipNoAuth,
            })

            doc.save('table.pdf');

        },
    },
    externals: {
        // only define the dependencies you are NOT using as externals!
        canvg: "canvg",
        html2canvas: "html2canvas",
        dompurify: "dompurify",
        autoTable: "autoTable"
    }
}
</script>
