(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["all-visitors"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/visit/VisitView.vue?vue&type=script&lang=js&":
/*!*********************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/visit/VisitView.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var jspdf__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! jspdf */ "./node_modules/jspdf/dist/jspdf.es.min.js");
/* harmony import */ var jspdf_autotable__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! jspdf-autotable */ "./node_modules/jspdf-autotable/dist/jspdf.plugin.autotable.js");
/* harmony import */ var jspdf_autotable__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(jspdf_autotable__WEBPACK_IMPORTED_MODULE_1__);
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
// import html2canvas from 'html2canvas';


/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      /** visitantes */
      visitors: [],
      visitorsAuth: [],
      visitorAuthFlag: '',
      visitorNoAuthoFlag: '',

      /** Actualizar lista */
      msnSuccess: '',
      msnError: '',

      /**Error de permisos*/
      errorFlag: false,
      errorCodig: '',
      errorMsn: ''
    };
  },
  mounted: function mounted() {
    var _this = this;

    axios.get('/allvisit').then(function (response) {
      console.log('carga correcta de visitantes');
      _this.visitors = _this.sortJSON(response.data.noAuth, 'country', 'asc');
      _this.visitorNoAuthoFlag = 0;
      _this.visitorsAuth = _this.sortJSON(response.data.auth, 'country', 'asc');
      _this.visitorAuthFlag = 1;
    })["catch"](function (err) {
      console.log('Error al cargar visitantes Inicial');
      console.log(err.response);
      _this.msnError = 'Se produjo un error al actulizar las listas';

      if (err.response.status == 403 || err.response.status == 401) {
        _this.errorFlag = true, _this.errorCodig = err.response.status;
        _this.errorMsn = err.response.data.message;
      }
    });
  },
  methods: {
    updateList: function updateList() {
      var _this2 = this;

      /** actualiza la informacion de los datos ip guardados */
      this.msnSuccess = '';
      this.msnError = '';
      axios.get('/visit').then(function (response) {
        console.log('carga correcta de visitantes');
        _this2.msnSuccess = response.data.update;
        setTimeout(function () {
          location.reload();
        }, 2000);
      })["catch"](function (err) {
        console.log('Error al cargar visitantes');
        console.log(err.response);

        if (err.response.status == 403 || err.response.status == 401) {
          _this2.errorFlag = true, _this2.errorCodig = err.response.status;
          _this2.errorMsn = err.response.data.message;
        }
      });
    },
    sortJSON: function sortJSON(data, key, orden) {
      // Ordena objeto JSON
      return data.sort(function (a, b) {
        var x = a[key],
            y = b[key];

        if (orden === 'asc') {
          return x < y ? -1 : x > y ? 1 : 0;
        }

        if (orden === 'desc') {
          return x > y ? -1 : x < y ? 1 : 0;
        }
      });
    },
    downPDF: function downPDF() {
      var ipNoAuth = [];
      var imagenp = './storage/images/tablon/no-image.png';
      var doc = new jspdf__WEBPACK_IMPORTED_MODULE_0__["default"]();
      var elementHandler = {
        '#ignorePDF': function ignorePDF(element, renderer) {
          return true;
        }
      };
      doc.autoTable({
        html: '#noAuthTable'
      });
      this.visitors.forEach(function (visit, index) {
        ipNoAuth.push([visit.country, visit.city, visit.cant]);
      });
      doc.autoTable({
        head: [['Pais', 'Cudad', 'Cant visitas']],
        body: ipNoAuth
      });
      doc.save('table.pdf');
    }
  },
  externals: {
    // only define the dependencies you are NOT using as externals!
    canvg: "canvg",
    html2canvas: "html2canvas",
    dompurify: "dompurify",
    autoTable: "autoTable"
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/visit/VisitView.vue?vue&type=template&id=74699bfd&":
/*!*************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/visit/VisitView.vue?vue&type=template&id=74699bfd& ***!
  \*************************************************************************************************************************************************************************************************************/
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
  return _c(
    "div",
    { staticClass: "pt-5" },
    [
      _vm.errorFlag
        ? _c("errors-component", {
            attrs: { codig: _vm.errorCodig, mensaje: _vm.errorMsn }
          })
        : _vm._e(),
      _vm._v(" "),
      !_vm.errorFlag
        ? _c(
            "div",
            { staticClass: "container" },
            [
              _c("div", [
                _c(
                  "button",
                  {
                    staticClass: "btn bg-dark-red col-12 col-md-4 col-gl-2",
                    on: { click: _vm.downPDF }
                  },
                  [_vm._v("\n                Descargar pdf\n            ")]
                ),
                _vm._v(" "),
                _c(
                  "button",
                  {
                    staticClass: "btn btn-primary col-12 col-md-4 col-gl-2",
                    on: { click: _vm.updateList }
                  },
                  [_vm._v("\n                Actualizar Lista\n            ")]
                ),
                _vm._v(" "),
                _c("small", { staticClass: "alert-success rounded" }, [
                  _vm._v(_vm._s(_vm.msnSuccess))
                ]),
                _vm._v(" "),
                _c("small", { staticClass: "alert-danger rounded" }, [
                  _vm._v(_vm._s(_vm.msnError))
                ])
              ]),
              _vm._v(" "),
              _c("h1", { staticClass: "text-capitalize text-center" }, [
                _vm._v("todas las visitas")
              ]),
              _vm._v(" "),
              _c("h5", [_vm._v("visitante No autenticado")]),
              _vm._v(" "),
              _c(
                "div",
                [
                  _c("visitlist-component", {
                    attrs: {
                      visitors: _vm.visitors,
                      auth: _vm.visitorNoAuthoFlag
                    }
                  })
                ],
                1
              ),
              _vm._v(" "),
              _c("h5", [_vm._v("visitante autenticado")]),
              _vm._v(" "),
              _c("visitlist-component", {
                attrs: { visitors: _vm.visitorsAuth, auth: _vm.visitorAuthFlag }
              })
            ],
            1
          )
        : _vm._e()
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/visit/VisitView.vue":
/*!************************************************!*\
  !*** ./resources/js/views/visit/VisitView.vue ***!
  \************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _VisitView_vue_vue_type_template_id_74699bfd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./VisitView.vue?vue&type=template&id=74699bfd& */ "./resources/js/views/visit/VisitView.vue?vue&type=template&id=74699bfd&");
/* harmony import */ var _VisitView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./VisitView.vue?vue&type=script&lang=js& */ "./resources/js/views/visit/VisitView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _VisitView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _VisitView_vue_vue_type_template_id_74699bfd___WEBPACK_IMPORTED_MODULE_0__["render"],
  _VisitView_vue_vue_type_template_id_74699bfd___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/visit/VisitView.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/visit/VisitView.vue?vue&type=script&lang=js&":
/*!*************************************************************************!*\
  !*** ./resources/js/views/visit/VisitView.vue?vue&type=script&lang=js& ***!
  \*************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_VisitView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./VisitView.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/visit/VisitView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_VisitView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/visit/VisitView.vue?vue&type=template&id=74699bfd&":
/*!*******************************************************************************!*\
  !*** ./resources/js/views/visit/VisitView.vue?vue&type=template&id=74699bfd& ***!
  \*******************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VisitView_vue_vue_type_template_id_74699bfd___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./VisitView.vue?vue&type=template&id=74699bfd& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/visit/VisitView.vue?vue&type=template&id=74699bfd&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VisitView_vue_vue_type_template_id_74699bfd___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_VisitView_vue_vue_type_template_id_74699bfd___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);