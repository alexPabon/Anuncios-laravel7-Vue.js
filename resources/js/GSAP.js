/**
 * Vamos a crear una animacion en los links de paginas relacionadas en el FOOTER de la pagina.
 */

let flagScroll = true;

window.addEventListener('scroll',function(e){

    let myBody = document.getElementsByTagName('body')[0];     

    /**
     * Para calcular cual es el punto final del scroll, debemos encontrar el tamaño
     * a la etiqueta "Body" y restarle el tamaño de la ventana "window". El resultado 
     * será el punto final del scroll.
     */
    let endScroll = myBody.offsetHeight - this.innerHeight;    

    if((endScroll-this.pageYOffset)<330 && flagScroll){

        this.scroll({
            top: endScroll,
            left: 0,
            behavior: 'smooth'
        });
        
        flagScroll = false;                
        animationLinks();        
    }

    if((endScroll-this.pageYOffset)>450 && !flagScroll || this.pageYOffset==0){
        flagScroll=true;        
    }
});

   
function animationLinks(){
    let tl = gsap.from('.more_links', {    
        duration: .3,                
        x: -500, //'random(-500,500)',    
        scale: 0,
        stagger: 0.7,
        ease: 'linear',    
    });            
};