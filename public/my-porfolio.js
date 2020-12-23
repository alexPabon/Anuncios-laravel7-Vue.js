(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["my-porfolio"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/porfolio/PorfolioView.vue?vue&type=script&lang=js&":
/*!***************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/porfolio/PorfolioView.vue?vue&type=script&lang=js& ***!
  \***************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      name: 'Alexander',
      lastName: 'Pabón',
      space: ' ',
      show: false,
      seeAnimation: false
    };
  },
  mounted: function mounted() {
    this.sortName();
  },
  methods: {
    sortName: function sortName() {
      var _this = this;

      this.name = _.shuffle(this.name);
      this.lastName = _.shuffle(this.lastName);
      setTimeout(function () {
        _this.name = 'Alexander';
        _this.lastName = 'Pabón';
      }, 1500);
    }
  }
});

/***/ }),

/***/ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css&":
/*!**********************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css& ***!
  \**********************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

exports = module.exports = __webpack_require__(/*! ../../../../node_modules/css-loader/lib/css-base.js */ "./node_modules/css-loader/lib/css-base.js")(false);
// imports


// module
exports.push([module.i, "\n.flip-list-move[data-v-052da836] {\n       transition: transform 1s;\n}\n.hg-400[data-v-052da836]{\n        -webkit-animation-duration: 2s;\n                animation-duration: 2s;\n\t    -webkit-animation-name: returnHeight-data-v-052da836;\n\t            animation-name: returnHeight-data-v-052da836;\n        max-height: 400px;\n}\n.hg-800[data-v-052da836]{\n        -webkit-animation-duration: 2s;\n                animation-duration: 2s;\n\t    -webkit-animation-name: chanceHeight-data-v-052da836;\n\t            animation-name: chanceHeight-data-v-052da836;\n\n        max-height: 800px;\n}\n.titulo_nombre[data-v-052da836]{\n        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;\n        font-size: 2.8rem;\n        text-align: center;\n        color:#08c3fb;\n        margin: 0;\n}\n@-webkit-keyframes chanceHeight-data-v-052da836{\nfrom{max-height: 400px;}\nto{max-height: 800px;}\n}\n@keyframes chanceHeight-data-v-052da836{\nfrom{max-height: 400px;}\nto{max-height: 800px;}\n}\n@-webkit-keyframes returnHeight-data-v-052da836{\nfrom{max-height: 800px;}\nto{max-height: 400px;}\n}\n@keyframes returnHeight-data-v-052da836{\nfrom{max-height: 800px;}\nto{max-height: 400px;}\n}\n   \n", ""]);

// exports


/***/ }),

/***/ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css&":
/*!**************************************************************************************************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/style-loader!./node_modules/css-loader??ref--6-1!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src??ref--6-2!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css& ***!
  \**************************************************************************************************************************************************************************************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {


var content = __webpack_require__(/*! !../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css& */ "./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css&");

if(typeof content === 'string') content = [[module.i, content, '']];

var transform;
var insertInto;



var options = {"hmr":true}

options.transform = transform
options.insertInto = undefined;

var update = __webpack_require__(/*! ../../../../node_modules/style-loader/lib/addStyles.js */ "./node_modules/style-loader/lib/addStyles.js")(content, options);

if(content.locals) module.exports = content.locals;

if(false) {}

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/porfolio/PorfolioView.vue?vue&type=template&id=052da836&scoped=true&":
/*!*******************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/porfolio/PorfolioView.vue?vue&type=template&id=052da836&scoped=true& ***!
  \*******************************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", { staticClass: "bg-dark bg-gradient pb-4" }, [
    _c(
      "div",
      {
        staticClass: "overflow-hidden rounded",
        class: [_vm.seeAnimation ? "hg-800" : "hg-400"],
        on: {
          mouseover: function($event) {
            _vm.seeAnimation = true
          }
        }
      },
      [
        _c("img", {
          staticClass: "col-12 m-0",
          attrs: { src: "/./storage/images/perfil/fotoPerfil.jpg", alt: "" }
        })
      ]
    ),
    _vm._v(" "),
    _c(
      "div",
      { staticClass: "container pt-5" },
      [
        _c(
          "h1",
          {
            ref: "nombre",
            staticClass: "bg-gradient-bottom px-2 rounded titulo_nombre",
            on: { mouseover: _vm.sortName }
          },
          [
            _c(
              "transition-group",
              { attrs: { name: "flip-list", tag: "span" } },
              _vm._l(_vm.name, function(letra, index) {
                return _c(
                  "span",
                  { key: index + 1, staticClass: "d-inline-block" },
                  [
                    _vm._v(
                      "\n                    " +
                        _vm._s(letra) +
                        "\n                "
                    )
                  ]
                )
              }),
              0
            ),
            _vm._v(" "),
            _c(
              "transition-group",
              { attrs: { name: "flip-list", tag: "span" } },
              _vm._l(_vm.lastName, function(letra, index) {
                return _c(
                  "span",
                  { key: index + 1, staticClass: "d-inline-block" },
                  [
                    _vm._v(
                      "\n                    " +
                        _vm._s(letra) +
                        "\n                "
                    )
                  ]
                )
              }),
              0
            )
          ],
          1
        ),
        _vm._v(" "),
        _c(
          "P",
          {
            staticClass: "text-justify bg-blue bg-gradient p-3 rounded",
            on: {
              mouseover: function($event) {
                _vm.seeAnimation = false
              }
            }
          },
          [
            _vm._v(
              "\n            Desde principios de Enero de 2019 he comenzado con mis estudios de diseño y mantenimiento de páginas web. \n            Gracias a los conocimientos adquiridos en la CIM-UPC he podido comprender algunos aspectos importantes que\n            debemos tener en cuenta en los  lenguajes de HTML, CSS, Javascript, pero para poder desarrollar una aplicación \n            dinámica y amigable también fue necesario aprender PHP, por tal motivo después de terminar mi curso de front-end, \n            he comenzado con Programación PHP y MySQL en CIFO-La Violeta, curso muy intensivo que me permitio avanzar \n            rápidamente en estos lenguajes de programación."
            ),
            _c("br"),
            _c("br"),
            _vm._v(
              "\n\n            Al tener claro lo que es la programación orientada a objetos con PHP y comprendiendo el uso de \n            "
            ),
            _c("b", [_vm._v("Modelo Vista Controlador(MVC)")]),
            _vm._v(
              " con controlador frontal, he decido aprender Laravel(framework PHP) que utiliza una \n            sintaxis expresiva y elegante, que permite crear aplicaciones de forma sencilla y rápida."
            ),
            _c("br"),
            _c("br"),
            _vm._v(
              "\n\n            Para implementas en mis proyecots de Laravel, he seguido con mi aprendizaje de SASS (lenguaje de hoja de estilos), \n            framework Bootstrap, Vue.js (framework progresivo) para crear SPA y así poder dar una experiencia mas fluida a los \n            usuarios.\n        "
            )
          ]
        ),
        _vm._v(" "),
        _vm._m(0)
      ],
      1
    )
  ])
}
var staticRenderFns = [
  function() {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("div", { staticClass: "bg-blue bg-gradient rounded" }, [
      _c("p", { staticClass: "bg-gradient-bottom p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [_vm._v("Lenguajes: ")]),
        _vm._v(" POO MVC en PHP, Javascript, phyton, C++.\n            ")
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "bg-gradient-bottom p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [
          _vm._v("Lenguajes de etiquetas y estilos: ")
        ]),
        _vm._v(" HTML5, CSS, SASS\n            ")
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [_vm._v("Frameworks: ")]),
        _vm._v(" Larvel 5.7 - 7, Vue.js, Bootstrap 4\n            ")
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "bg-gradient-bottom p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [_vm._v("SGBD: ")]),
        _vm._v(" MySQL MariaDB, SQLite\n            ")
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [
          _vm._v("Librerias Javascript: ")
        ]),
        _vm._v("jQuery, Leaflet, Axios\n            ")
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "bg-gradient-bottom p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [
          _vm._v("Plataformas de desarrollo: ")
        ]),
        _vm._v(" GITHUB.\n            ")
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [_vm._v("Herramientas: ")]),
        _vm._v(
          "MySQL workbench, HeidiSQL, Git, Node.js, Composer\n            "
        )
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "bg-gradient-bottom p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [_vm._v("Editores: ")]),
        _vm._v(" VS Code, Eclipse, Sublime\n            ")
      ]),
      _vm._v(" "),
      _c("p", { staticClass: "p-2 m-0" }, [
        _c("b", { staticClass: "text-primary" }, [
          _vm._v("Sistemas Operativos: ")
        ]),
        _vm._v(
          " Windows, linux, Ubuntu, Debian(GPIO con Python en Raspberry Pi)\n            "
        )
      ])
    ])
  }
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/porfolio/PorfolioView.vue":
/*!******************************************************!*\
  !*** ./resources/js/views/porfolio/PorfolioView.vue ***!
  \******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PorfolioView_vue_vue_type_template_id_052da836_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PorfolioView.vue?vue&type=template&id=052da836&scoped=true& */ "./resources/js/views/porfolio/PorfolioView.vue?vue&type=template&id=052da836&scoped=true&");
/* harmony import */ var _PorfolioView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PorfolioView.vue?vue&type=script&lang=js& */ "./resources/js/views/porfolio/PorfolioView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _PorfolioView_vue_vue_type_style_index_0_id_052da836_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css& */ "./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");






/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_3__["default"])(
  _PorfolioView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PorfolioView_vue_vue_type_template_id_052da836_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PorfolioView_vue_vue_type_template_id_052da836_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  "052da836",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/porfolio/PorfolioView.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/porfolio/PorfolioView.vue?vue&type=script&lang=js&":
/*!*******************************************************************************!*\
  !*** ./resources/js/views/porfolio/PorfolioView.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./PorfolioView.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/porfolio/PorfolioView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css&":
/*!***************************************************************************************************************!*\
  !*** ./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css& ***!
  \***************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_style_index_0_id_052da836_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/style-loader!../../../../node_modules/css-loader??ref--6-1!../../../../node_modules/vue-loader/lib/loaders/stylePostLoader.js!../../../../node_modules/postcss-loader/src??ref--6-2!../../../../node_modules/vue-loader/lib??vue-loader-options!./PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css& */ "./node_modules/style-loader/index.js!./node_modules/css-loader/index.js?!./node_modules/vue-loader/lib/loaders/stylePostLoader.js!./node_modules/postcss-loader/src/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/porfolio/PorfolioView.vue?vue&type=style&index=0&id=052da836&scoped=true&lang=css&");
/* harmony import */ var _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_style_index_0_id_052da836_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_style_index_0_id_052da836_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__);
/* harmony reexport (unknown) */ for(var __WEBPACK_IMPORT_KEY__ in _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_style_index_0_id_052da836_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__) if(__WEBPACK_IMPORT_KEY__ !== 'default') (function(key) { __webpack_require__.d(__webpack_exports__, key, function() { return _node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_style_index_0_id_052da836_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0__[key]; }) }(__WEBPACK_IMPORT_KEY__));
 /* harmony default export */ __webpack_exports__["default"] = (_node_modules_style_loader_index_js_node_modules_css_loader_index_js_ref_6_1_node_modules_vue_loader_lib_loaders_stylePostLoader_js_node_modules_postcss_loader_src_index_js_ref_6_2_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_style_index_0_id_052da836_scoped_true_lang_css___WEBPACK_IMPORTED_MODULE_0___default.a); 

/***/ }),

/***/ "./resources/js/views/porfolio/PorfolioView.vue?vue&type=template&id=052da836&scoped=true&":
/*!*************************************************************************************************!*\
  !*** ./resources/js/views/porfolio/PorfolioView.vue?vue&type=template&id=052da836&scoped=true& ***!
  \*************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_template_id_052da836_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./PorfolioView.vue?vue&type=template&id=052da836&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/porfolio/PorfolioView.vue?vue&type=template&id=052da836&scoped=true&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_template_id_052da836_scoped_true___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PorfolioView_vue_vue_type_template_id_052da836_scoped_true___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);