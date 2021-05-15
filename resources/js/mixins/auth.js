const { isNull } = require("lodash");

let user = document.head.querySelector('meta[name="user"]');
let usuario='';
let privilege='';

module.exports = {
    methods:{
        
    },
    computed: {
        user(){

            if(user.content)
                usuario= JSON.parse(user.content);
                
            return usuario;
        },
        isAuthenticated(){
            return !! user.content;
        },
        isAdmin(){
            
            if(user.content)
                privilege = usuario.privilege.name;
            
            return  privilege == 'administrador';            
        },
        isEmailVerified(){
            if(user.content)
                emailVerifiedAt = usuario.email_verified_at;
            
            return  !! emailVerifiedAt;
            
        }        
    }
};