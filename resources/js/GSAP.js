/**
 * Vamos a crear una animacion en los links de paginas relacionadas en el FOOTER de la pagina.
 * 
 * To simply fire off animations and let them run, there's no need to use variables. Tween play 
 * immediately by default (though you can set a delay or paused value) and when they finish, they 
 * automatically dispose of themselves. Call gsap.from() as much as you want without worrying 
 * about cleanup.
 * 
 * //now we can control it!
 * tl.pause();
 * tl.seek(2);
 * tl.progress(0.5);
 * tl.play();
 */

let flagScroll = true;

const  tl = gsap.from('.more_links', {    
    duration: .3,                
    x: -500, //'random(-500,500)',    
    scale: 0,
    stagger: 0.7,
    ease: 'linear', 
    immediateRender: true, 
    overwrite:true,  
}); 

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

        tl.seek(0);
        flagScroll = false;         
    }    
    
    if((endScroll-this.pageYOffset)>450 && !flagScroll || this.pageYOffset==0){
        flagScroll=true;        
    }
});