(window.webpackJsonp=window.webpackJsonp||[]).push([[1],{301:function(e,t,r){"use strict";r.r(t);var a={data:function(){return{categories:[],name:"",errorData:[],errorFlag:!1,errorCodig:"",errorMsn:""}},mounted:function(){var e=this;axios.get("/category").then((function(t){e.categories=t.data,console.log(e.categories)})).catch((function(t){console.log("Error al cargar categorias"),console.log(t.response),403!=t.response.status&&401!=t.response.status||(e.errorFlag=!0,e.errorCodig=t.response.status,e.errorMsn=t.response.data.message)}))},methods:{newCategory:function(){var e=this;this.errorPost="",this.errorData=[];var t={name:this.name};axios.post("/category",t).then((function(t){console.log("Se ha guardado la categoria"),e.categories.unshift(t.data),e.name="",e.errorPost=""})).catch((function(t){console.log("hay errores al guardar la categoria"),console.log(t.response),422==t.response.status&&(e.errorData=t.response.data.errors)}))},updateCategory:function(e,t){Vue.set(this.categories,e,t)},deleteCategory:function(e){this.categories.splice(e,1)}}},o=r(0),s=Object(o.a)(a,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"container pt-5"},[e.errorFlag?r("errors-component",{attrs:{codig:e.errorCodig,mensaje:e.errorMsn}}):e._e(),e._v(" "),e.errorFlag?e._e():r("div",[r("h4",[e._v("Categories")]),e._v(" "),e.isAdmin?r("div",{staticClass:"py-2 col-12 col-md-6 col-lg-4"},[r("form",{attrs:{action:""},on:{submit:function(t){return t.preventDefault(),e.newCategory()}}},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.name,expression:"name"}],staticClass:"form-control",attrs:{type:"text",min:"3",max:"30",placeholder:"Nueva categoria",required:""},domProps:{value:e.name},on:{input:function(t){t.target.composing||(e.name=t.target.value)}}}),e._v(" "),r("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[e._v("Crear cátegoria")]),e._v(" "),r("div",e._l(e.errorData,(function(t,a){return r("p",{key:a,staticClass:"text-danger"},e._l(t,(function(t,a){return r("span",{key:a},[e._v(e._s(t))])})),0)})),0)])]):e._e(),e._v(" "),r("div",[r("table",{staticClass:"table table-striped table-light"},[r("thead",{staticClass:"bg-primary"},[r("tr",[r("th",{attrs:{scope:"col"}},[e._v("Id")]),e._v(" "),r("th",{attrs:{scope:"col"}},[e._v("Name")]),e._v(" "),r("th",{attrs:{scope:"col"}},[e._v("Updated at")]),e._v(" "),e.isAdmin?r("th",{attrs:{scope:"col"}},[e._v("Options")]):e._e()])]),e._v(" "),r("tbody",e._l(e.categories,(function(t,a){return r("categorytable-component",{key:a,attrs:{category:t},on:{update:function(t){for(var r=arguments.length,o=Array(r);r--;)o[r]=arguments[r];return e.updateCategory.apply(void 0,[a].concat(o))},delete:function(t){return e.deleteCategory(a)}}})})),1)])])])],1)}),[],!1,null,null,null);t.default=s.exports}}]);