const { isNull } = require("lodash");

module.exports = {
    methods:{
        configAddress(inAddress){
            let firstLetters = inAddress.substr(0,4);
            
            if(firstLetters=='http')
                return inAddress
            else
                return `/storage${inAddress}`;
            
        },
    },
    computed: {
        
    }
};