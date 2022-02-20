<template>
    <div class="pt-5 pb-3">
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

            <!-- lista autenticados -->
            <h1  class="text-capitalize text-center my-2">visitante autenticado</h1>

            <div>
                <visitlist-component
                    :visitors="visitors"
                    :auth="visitorAuthFlag">
                </visitlist-component>
            </div>
            <!-- nueva paginación -->
            <div v-if="paginationFlag">
                <builderlinks-component
                    :objeto=builder_links
                    :builderFlag=builderFlag
                    :search="search"
                    :from=from
                    :tot=total
                    :to=to
                    @goToPage="goPage"></builderlinks-component>
            </div>
            <div v-if="!paginationFlag" class="container text-warning lead">
                <p>No hay resultados!</p>
            </div>
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
            visitorAuthFlag:1,

            /** Actualizar lista */
            msnSuccess:'',
            msnError:'',

            /**Error de permisos*/
            errorFlag:false,
            errorCodig:'',
            errorMsn:'',

            // constructor de enlaces
            builder_links:{'lastPage':1,'currentPage':1,'path':'null'},
            builderFlag:true,
            paginationFlag:true,

            // Buscador
            search:'',

            responseSuccess:true,
            colors:true,
            page:'/allvisit?page=1',
            currentPage:1,
            lastPage:1,
            nameTable:'Anuncios',
            from:'',
            total:'',
            to:'',
            path:'elcaminio',

        }
    },
    mounted(){
        axios.get('/visit-auth')
            .then(response=>{
                console.log('carga correcta de visitantes');
                console.log(response);
                this.visitors = response.data.data;

                this.pagination(response.data);
            })
            .catch(err=>{
                console.log('Error al cargar visitantes Inicial')
                console.log(err);

                this.msnError= 'Se produjo un error al actulizar las listas';

                if(err.response.status==403 || err.response.status==401){
                    this.errorFlag=true,
                    this.errorCodig= err.response.status;
                    this.errorMsn= err.response.data.message;
                }
            });

    },
    methods:{
        updateList(){

            /** actualiza la informacion de los datos ip guardados */
            this.msnSuccess='';
            this.msnError='';

            axios.get('/visit')
            .then(response=>{
                console.log('carga correcta de visitantes')
                console.log(response);
                this.msnSuccess = response.data.update;

                // setTimeout(function(){ location.reload() }, 2000);
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
        pagination(data){

            this.page = data.next_page_url;
            this.lastPage = data.last_page;
            this.currentPage = data.current_page;
            this.from = data.from;
            this.total = data.total;
            this.to = data.to;

            this.builder_links.lastPage=data.last_page;
            this.builder_links.currentPage = data.current_page;
            this.builder_links.path = data.path;
            this.builderFlag = !this.builderFlag;
        },
        goPage(nPage){
            axios.get(`/visit-auth?page=${nPage}`)
                .then(response=>{
                    console.log('respusta advert')
                    console.log(response);
                    this.visitors = response.data.data;

                    this.pagination(response.data);

                    console.log(response);
                })
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
