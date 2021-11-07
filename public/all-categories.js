(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["all-categories"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/categories/CategoriesView.vue?vue&type=script&lang=js&":
/*!*******************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/categories/CategoriesView.vue?vue&type=script&lang=js& ***!
  \*******************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      categories: [],
      name: '',
      errorData: [],

      /**Error de permisos*/
      errorFlag: false,
      errorCodig: '',
      errorMsn: ''
    };
  },
  mounted: function mounted() {
    var _this = this;

    axios.get('/category').then(function (response) {
      _this.categories = response.data;
      console.log(_this.categories);
    })["catch"](function (err) {
      console.log('Error al cargar categorias');
      console.log(err.response);

      if (err.response.status == 403 || err.response.status == 401) {
        _this.errorFlag = true, _this.errorCodig = err.response.status;
        _this.errorMsn = err.response.data.message;
      }
    });
  },
  methods: {
    newCategory: function newCategory() {
      var _this2 = this;

      this.errorPost = '';
      this.errorData = [];
      var params = {
        'name': this.name
      };
      axios.post('/category', params).then(function (response) {
        console.log('Se ha guardado la categoria');

        _this2.categories.unshift(response.data);

        _this2.name = '';
        _this2.errorPost = '';
      })["catch"](function (err) {
        console.log('hay errores al guardar la categoria');
        console.log(err.response);
        if (err.response.status == 422) _this2.errorData = err.response.data.errors;
      });
    },
    updateCategory: function updateCategory(index, category) {
      // para insertar el nuevo valor en el array
      // Vue.set(this.array, index, newValue);
      Vue.set(this.categories, index, category);
    },
    deleteCategory: function deleteCategory(index) {
      this.categories.splice(index, 1);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/categories/CategoriesView.vue?vue&type=template&id=64519965&":
/*!***********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/categories/CategoriesView.vue?vue&type=template&id=64519965& ***!
  \***********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function () {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    { staticClass: "container pt-5" },
    [
      _vm.errorFlag
        ? _c("errors-component", {
            attrs: { codig: _vm.errorCodig, mensaje: _vm.errorMsn },
          })
        : _vm._e(),
      _vm._v(" "),
      !_vm.errorFlag
        ? _c("div", [
            _c("h4", [_vm._v("Categories")]),
            _vm._v(" "),
            _vm.isAdmin
              ? _c("div", { staticClass: "py-2 col-12 col-md-6 col-lg-4" }, [
                  _c(
                    "form",
                    {
                      attrs: { action: "" },
                      on: {
                        submit: function ($event) {
                          $event.preventDefault()
                          return _vm.newCategory()
                        },
                      },
                    },
                    [
                      _c("input", {
                        directives: [
                          {
                            name: "model",
                            rawName: "v-model",
                            value: _vm.name,
                            expression: "name",
                          },
                        ],
                        staticClass: "form-control",
                        attrs: {
                          type: "text",
                          min: "3",
                          max: "30",
                          placeholder: "Nueva categoria",
                          required: "",
                        },
                        domProps: { value: _vm.name },
                        on: {
                          input: function ($event) {
                            if ($event.target.composing) {
                              return
                            }
                            _vm.name = $event.target.value
                          },
                        },
                      }),
                      _vm._v(" "),
                      _c(
                        "button",
                        {
                          staticClass: "btn btn-primary",
                          attrs: { type: "submit" },
                        },
                        [_vm._v("Crear cátegoria")]
                      ),
                      _vm._v(" "),
                      _c(
                        "div",
                        _vm._l(_vm.errorData, function (errors, index) {
                          return _c(
                            "p",
                            { key: index, staticClass: "text-danger" },
                            _vm._l(errors, function (error, index) {
                              return _c("span", { key: index }, [
                                _vm._v(_vm._s(error)),
                              ])
                            }),
                            0
                          )
                        }),
                        0
                      ),
                    ]
                  ),
                ])
              : _vm._e(),
            _vm._v(" "),
            _c("div", [
              _c("table", { staticClass: "table table-striped table-light" }, [
                _c("thead", { staticClass: "bg-primary" }, [
                  _c("tr", [
                    _c("th", { attrs: { scope: "col" } }, [_vm._v("Id")]),
                    _vm._v(" "),
                    _c("th", { attrs: { scope: "col" } }, [_vm._v("Name")]),
                    _vm._v(" "),
                    _c("th", { attrs: { scope: "col" } }, [
                      _vm._v("Updated at"),
                    ]),
                    _vm._v(" "),
                    _vm.isAdmin
                      ? _c("th", { attrs: { scope: "col" } }, [
                          _vm._v("Options"),
                        ])
                      : _vm._e(),
                  ]),
                ]),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.categories, function (category, index) {
                    return _c("categorytable-component", {
                      key: index,
                      attrs: { category: category },
                      on: {
                        update: function ($event) {
                          var i = arguments.length,
                            argsArray = Array(i)
                          while (i--) argsArray[i] = arguments[i]
                          return _vm.updateCategory.apply(
                            void 0,
                            [index].concat(argsArray)
                          )
                        },
                        delete: function ($event) {
                          return _vm.deleteCategory(index)
                        },
                      },
                    })
                  }),
                  1
                ),
              ]),
            ]),
          ])
        : _vm._e(),
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/categories/CategoriesView.vue":
/*!**********************************************************!*\
  !*** ./resources/js/views/categories/CategoriesView.vue ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CategoriesView_vue_vue_type_template_id_64519965___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CategoriesView.vue?vue&type=template&id=64519965& */ "./resources/js/views/categories/CategoriesView.vue?vue&type=template&id=64519965&");
/* harmony import */ var _CategoriesView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CategoriesView.vue?vue&type=script&lang=js& */ "./resources/js/views/categories/CategoriesView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CategoriesView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CategoriesView_vue_vue_type_template_id_64519965___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CategoriesView_vue_vue_type_template_id_64519965___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/categories/CategoriesView.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/categories/CategoriesView.vue?vue&type=script&lang=js&":
/*!***********************************************************************************!*\
  !*** ./resources/js/views/categories/CategoriesView.vue?vue&type=script&lang=js& ***!
  \***********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoriesView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoriesView.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/categories/CategoriesView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoriesView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/categories/CategoriesView.vue?vue&type=template&id=64519965&":
/*!*****************************************************************************************!*\
  !*** ./resources/js/views/categories/CategoriesView.vue?vue&type=template&id=64519965& ***!
  \*****************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoriesView_vue_vue_type_template_id_64519965___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./CategoriesView.vue?vue&type=template&id=64519965& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/categories/CategoriesView.vue?vue&type=template&id=64519965&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoriesView_vue_vue_type_template_id_64519965___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoriesView_vue_vue_type_template_id_64519965___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);