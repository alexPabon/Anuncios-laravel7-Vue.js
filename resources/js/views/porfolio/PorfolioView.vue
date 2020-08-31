<template>
    <div class="bg-dark bg-gradient pb-4"> 
        <div
            @mouseover="seeAnimation=true"            
            :class="[seeAnimation?'hg-800':'hg-400']" 
            class="overflow-hidden rounded">
            <img class="col-12 m-0" src="/./storage/images/perfil/fotoPerfil.jpg" alt="">
        </div>
        <div class="container pt-5">            
            <h1 @mouseover="sortName" ref="nombre" class="bg-gradient-bottom px-2 rounded titulo_nombre">
                <transition-group name="flip-list" tag="span">
                    <span
                        v-for="(letra, index) in name"
                        :key="index+1"                        
                        class="d-inline-block">
                        {{letra}}
                    </span>                                
                </transition-group>  
                <transition-group name="flip-list" tag="span">
                    <span
                        v-for="(letra, index) in lastName"
                        :key="index+1"
                        class="d-inline-block">
                        {{letra}}
                    </span>                                
                </transition-group>         
            </h1>
            <P @mouseover="seeAnimation=false" class="text-justify bg-blue bg-gradient p-3 rounded">
                Desde principios de Enero de 2019 he comenzado con mis estudios de diseño y mantenimiento de páginas web. 
                Gracias a los conocimientos adquiridos en la CIM-UPC he podido comprender algunos aspectos importantes que
                debemos tener en cuenta en los  lenguajes de HTML, CSS, Javascript, pero para poder desarrollar una aplicación 
                dinámica y amigable también fue necesario aprender PHP, por tal motivo después de terminar mi curso de front-end, 
                he comenzado con Programación PHP y MySQL en CIFO-La Violeta, curso muy intensivo que me permitio avanzar 
                rápidamente en estos lenguajes de programación.<br><br>

                Al tener claro lo que es la programación orientada a objetos con PHP y comprendiendo el uso de 
                <b>Modelo Vista Controlador(MVC)</b> con controlador frontal, he decido aprender Laravel(framework PHP) que utiliza una 
                sintaxis expresiva y elegante, que permite crear aplicaciones de forma sencilla y rápida.<br><br>

                Para implementas en mis proyecots de Laravel, he seguido con mi aprendizaje de SASS (lenguaje de hoja de estilos), 
                framework Bootstrap, Vue.js (framework progresivo) para crear SPA y así poder dar una experiencia mas fluida a los 
                usuarios.
            </P>
            <div class="bg-blue bg-gradient rounded">
                <p class="bg-gradient-bottom p-2 m-0">
                    <b class="text-primary">Lenguajes: </b> POO MVC en PHP, Javascript, phyton, C++.
                </p>
                <p class="bg-gradient-bottom p-2 m-0">
                    <b class="text-primary">Lenguajes de etiquetas y estilos: </b> HTML5, CSS, SASS
                </p>
                <p class="p-2 m-0">
                    <b class="text-primary">Frameworks: </b> Larvel 5.7 - 7, Vue.js, Bootstrap 4
                </p>
                <p class="bg-gradient-bottom p-2 m-0">
                    <b class="text-primary">SGBD: </b> MySQL MariaDB, SQLite
                </p>
                <p class="p-2 m-0">
                    <b class="text-primary">Librerias Javascript: </b>jQuery, Leaflet, Axios
                </p>
                <p class="bg-gradient-bottom p-2 m-0">
                    <b class="text-primary">Plataformas de desarrollo: </b> GITHUB.
                </p>
                <p class="p-2 m-0">
                    <b class="text-primary">Herramientas: </b>MySQL workbench, HeidiSQL, Git, Node.js, Composer
                </p>
                <p class="bg-gradient-bottom p-2 m-0">
                    <b class="text-primary">Editores: </b> VS Code, Eclipse, Sublime
                </p>
                <p class="p-2 m-0">
                    <b class="text-primary">Sistemas Operativos: </b> Windows, linux, Ubuntu, Debian
                </p>
            </div>
        </div>
    </div>    
</template>

<script>
export default {    
    data(){
        return{
            name:'Alexander', 
            lastName:'Pabón',
            space:' ',
            show:false,
            
            seeAnimation:false,
        }
    },
    mounted(){        
        this.sortName();
    },
    methods:{        
        sortName(){
            this.name = _.shuffle(this.name);
            this.lastName = _.shuffle(this.lastName);
            
            setTimeout(()=>{ 
                this.name= 'Alexander'; 
                this.lastName = 'Pabón'
            }, 1500);
        }
    },   
}
</script>

<style scoped>
    .flip-list-move {
       transition: transform 1s;
    }

    .hg-400{
        animation-duration: 2s;
	    animation-name: returnHeight;
        max-height: 400px;
    }

    .hg-800{
        animation-duration: 2s;
	    animation-name: chanceHeight;

        max-height: 800px;	
    }
    
    .titulo_nombre{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        font-size: 2.8rem;
        text-align: center;
        color:#08c3fb;
        margin: 0;
    }

    @keyframes chanceHeight{
        from{max-height: 400px;}
        to{max-height: 800px;}
    }

    @keyframes returnHeight{
        from{max-height: 800px;}
        to{max-height: 400px;}
    }
   
</style>