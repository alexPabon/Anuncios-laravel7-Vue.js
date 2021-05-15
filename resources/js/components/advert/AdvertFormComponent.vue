<template>
    <div class="bg-light text-dark">
        <div class="form-group d-flex flex-wrap align-items-center p-1 border rounded">
            <div class="form-group col-12 col-md-6">
                <label class="text-primary" for="product">Producto</label>
                <input
                    v-model.trim="newProduct.product"
                    v-on:blur="validateInput({'product':newProduct.product})" 
                    :class="[productFlag?'is-invalid':'']"                   
                    id="producto"                               
                    type="text" 
                    min="4"
                    class="form-control" required>
                <small 
                    v-for="error in allErrors.product" :key="error"
                    class="text-danger">
                        - {{error}}
                </small>
            </div>
            <div class="form-group col-6 col-md-3">
                <label class="text-primary" for="ciudad">Ciudad</label>
                <input
                    v-model.trim="newProduct.city"
                    v-on:blur="validateInput({'city':newProduct.city})"
                    :class="[cityFlag?'is-invalid':'']"                      
                    id="ciuadad"
                    min="4"
                    type="text" class="form-control" required>
                <small 
                    v-for="error in allErrors.city" :key="error"
                    class="text-danger">
                        - {{error}}
                </small>
            </div>
            <div class="form-group col-6 col-md-3">
                <label class="text-primary" for="cantidad">Cantidad</label>
                <input
                    v-model.trim="newProduct.quantity"
                    v-on:blur="validateInput({'quantity':newProduct.quantity})"
                    :class="[quantityFlag?'is-invalid':'']"  
                    id="cantidad"
                    max="99"
                    type="number" class="form-control" required>
                <small 
                    v-for="error in allErrors.quantity" :key="error"
                    class="text-danger">
                        - {{error}}
                </small>
            </div>
            <div class="form-group col-4 col-md-3">
                <label class="text-primary" for="precio">Precio</label>
                <input
                    v-model.trim="newProduct.price"
                    v-on:blur="validateInput({'price':newProduct.price})"
                    :class="[priceFlag?'is-invalid':'']"  
                    id="precio"
                    max="99999"
                    type="number"
                    step="0.01"                                 
                    class="form-control" required>
                <small 
                    v-for="error in allErrors.price" :key="error"
                    class="text-danger">
                        - {{error}}
                </small>
            </div>
        </div>
        <div class="form-group p-1">
            <label class="text-primary" for="descripcion">Descripción</label>
            <textarea
                v-model.trim="newProduct.description" 
                v-on:blur="validateInput({'description':newProduct.description})"
                :class="[descriptionFlag?'is-invalid':'']"  
                class="w-100 rounded px-2 pt-1" id="descripcion"  rows="10" required></textarea>                                                       
            <small 
                v-for="error in allErrors.description" :key="error"
                class="text-danger">
                    - {{error}}
            </small>
        </div>
    </div>
</template>

<script>
export default {
    props:['newProduct','errors','viewErrors'],
    data(){
        return{
            allErrors:[],            
            productFlag:false,
            cityFlag:false,
            quantityFlag:false,
            priceFlag:false,
            descriptionFlag:false,            
        }
    },    
    mounted(){
        
    },
    methods:{
        validateInput(inValue){            
            
            if(inValue.product){
                let newValue = inValue.product.replace(/[&\/\\#,+$~%.'":*?<>{}]/g, '');
                this.newProduct.product=newValue.trim();
                this.productFlag=false;
                this.allErrors.product=[];

                if(newValue.trim().length<4){
                    this.productFlag=true;
                    this.allErrors.product=['Minimo 4 caracteres'];
                }
            }

            if(inValue.city){
                let newValue = inValue.city.replace(/[&\/\\#,+$~%.'":*?<>{}]/g, '');
                this.newProduct.city=newValue.trim();
                this.cityFlag=false;
                this.allErrors.city=[];

                if(newValue.trim().length<4){
                    this.cityFlag=true;
                    this.allErrors.city=['Minimo 4 caracteres'];
                }
            }
            
            if(inValue.quantity){                
                let newValue = inValue.quantity.replace(/[&\/\\#+$~%'":*?<>{}a-z A-Z]/g, '');
                this.newProduct.quantity=newValue.trim();
                this.quantityFlag=false;
                this.allErrors.quantity=[];

                if(newValue>999){
                    this.quantityFlag=true;
                    this.allErrors.quantity=['La cantidad debe ser inferior a 1000'];
                }
            }

            if(inValue.price){                
                let newValue = inValue.price.replace(/[&\/\\#+$~%'":*?<>{}a-z A-Z]/g, '');
                this.newProduct.price=newValue.trim();
                this.priceFlag=false;
                this.allErrors.price=[];

                if(newValue>9999999){
                    this.priceFlag=true;
                    this.allErrors.price=['El precio debe ser inferior a 10´000.000'];
                }
            }

            if(inValue.description){
                let newValue = inValue.description.replace(/[&\/\\#+$~%<>{}]/g, '');
                this.newProduct.description=newValue.trim();
                this.descriptionFlag=false;
                this.allErrors.description=[];

                if(newValue.trim().length<10){
                    this.descriptionFlag=true;
                    this.allErrors.description=['Minimo 10 caracteres'];
                }
            }

            if(this.productFlag||this.cityFlag||this.quantityFlag||this.priceFlag||this.descriptionFlag)
                this.$emit('save',false);
            else
                this.$emit('save',true);
        }
    },
    watch:{
        viewErrors:function(){
            this.allErrors=this.errors;
        }
    },    
}
</script>