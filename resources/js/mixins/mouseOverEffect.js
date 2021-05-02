const { isNull } = require("lodash");


module.exports = {
    
    methods:{
        startDrawing(canvas4){
            const myImageColor = new Image();
            //  myImageColor.src = "./images/soloPerfil.png";
            
            myImageColor.src = 'data:image/png;base64,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';
            
                        
            const ctx = canvas4.getContext('2d');
            let iconContainer = document.getElementById('icon_container').getBoundingClientRect();
            canvas4.width = iconContainer.width;
            canvas4.height = iconContainer.height;            
            
            let particleArray = [];
            
            const mouse = {
                x: null,
                y: null,
                radius: 90
            }
            
            window.addEventListener('mousemove', function(event){
                let pos = canvas4.getBoundingClientRect();
                mouse.x = event.x + canvas4.clientLeft/2 - pos.left;
                mouse.y = event.y + canvas4.clientTop/2 - pos.top;		
                // console.log(mouse.x, mouse.y, mouse.radius);
                            
            });		
            
            window.addEventListener('load', function(){	
                ctx.drawImage(myImageColor, 0, 0, myImageColor.width, myImageColor.height);                 
                drawImage();
                
            });
            
            // ==================== FUNCTIONS =====================================
            // ********************************************************************
            
            function drawImage(){
                let imageWidth = myImageColor.width;
                let imageHeight = myImageColor.height;
                const data = ctx.getImageData(0, 0, imageWidth, imageHeight);
                ctx.clearRect(0, 0, canvas4.width, canvas4.height);
            
                class Particle{
                    constructor(x, y, color, size){				
                        this.x = x ;
                        this.y = y ;
                        this.color = color;
                        this.size =  ((canvas4.width/data.width) + (canvas4.height/data.height))/2;
                        this.baseX = this.x;
                        this.baseY = this.y;
                        this.density = (Math.random() * 150) + 5;
                        
                    }
            
                    draw(){				
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.size, 0, Math.PI*2);
                        ctx.closePath();
                        ctx.fill();			
                    }
            
                    update(){
                        
                        ctx.fillStyle = this.color;
            
                        // collision detection
                        let dx = mouse.x - this.x;
                        let dy = mouse.y - this.y;
                        let distance = Math.sqrt(dx * dx + dy * dy);
                        let forceDirectionX = dx / distance;
                        let forceDirectionY = dy / distance;
            
                        // max distance, past that the force will be 0
                        let maxDistance = mouse.radius;
                        let force = (maxDistance - distance) / maxDistance;
            
                        if(force < 0) force = 0;
            
                        let directionX = forceDirectionX * force * this.density * .7;
                        let directionY = forceDirectionY * force * this.density * .7;
            
                        if(distance < (mouse.radius + this.size)){
                            this.x -= directionX/2;
                            this.y -= directionY;
                        }
                        else{
                            if(this.x !== this.baseX){
                                let dx = this.x - this.baseX;
                                this.x -= dx/15;
                            }
                            if(this.y !== this.baseY){
                                let dy = this.y - this.baseY;
                                this.y -= dy/15;
                            }
                        }
            
                        this.draw(); 
                    }
                }
                
                function init(){
                    
                    let addX = canvas4.width/data.width;
                    let addY = canvas4.height/data.height;
                    particleArray = [];                  
                    
                    for(let y = 0, y2 = data.height; y < y2; y++){
                        for(let x = 0, x2 = data.width; x < x2; x++){
                            if(data.data[(y * 4 * data.width) + (x * 4) + 3] > 128){
                                let positionX = x;
                                let positionY = y;
                                let color = 'rgb(' + data.data[(y * 4 * data.width) + (x * 4)] + ',' +
                                                        data.data[(y * 4 * data.width) + (x * 4) + 1] + ',' +
                                                        data.data[(y * 4 * data.width) + (x * 4) + 2] + ')';
                                particleArray.push(new Particle(positionX * addX, positionY * addY, color));
                            }
                        }
                    }
                    
                }
                
                function animate(){
                
                    requestAnimationFrame(animate);
                    ctx.fillStyle = 'rgba(0, 0, 0, .05)';
                    ctx.clearRect(0, 0, canvas4.width, canvas4.height);
                
                    for(let i=0; i<particleArray.length; i++){			
                        particleArray[i].update();
                    }		
                }
            
                init();
                animate();
            
                window.addEventListener('resize', function(){
                    canvas4.width = innerWidth;
                    canvas4.height = iconContainer.height;
                    init();                    
                });
            }            
        },
    },    
};

