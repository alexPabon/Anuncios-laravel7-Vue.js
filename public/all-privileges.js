(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["all-privileges"],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/privilege/PrivilegeView.vue?vue&type=script&lang=js&":
/*!*****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/privilege/PrivilegeView.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************************************************************************************************************/
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
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      privileges: [],
      name: '',
      label: '',
      errorData: [],

      /**Error de permisos*/
      errorFlag: false,
      errorCodig: '',
      errorMsn: ''
    };
  },
  mounted: function mounted() {
    var _this = this;

    axios.get('/privilege').then(function (response) {
      _this.privileges = response.data;
      console.log(_this.privileges);
    })["catch"](function (err) {
      console.log('Error al cargar privilegios');
      console.log(err.response);

      if (err.response.status == 403 || err.response.status == 401) {
        _this.errorFlag = true, _this.errorCodig = err.response.status;
        _this.errorMsn = err.response.data.message;
      }
    });
  },
  methods: {
    newPrivilege: function newPrivilege() {
      var _this2 = this;

      this.errorPost = '';
      this.errorData = [];
      var params = {
        'name': this.name,
        'label': this.label
      };
      axios.post('/privi', params).then(function (response) {
        console.log('Se ha guardado la categoria');

        _this2.privileges.unshift(response.data);

        _this2.name = '';
        _this2.errorPost = '';
      })["catch"](function (err) {
        console.log('hay errores al guardar la categoria');
        console.log(err.response);
        if (err.response.status == 422) _this2.errorData = err.response.data.errors;
      });
    },
    updatePrivilege: function updatePrivilege(index, privilege) {
      // para insertar el nuevo valor en el array
      // Vue.set(this.array, index, newValue);            
      Vue.set(this.privileges, index, privilege);
    },
    deletePrivilege: function deletePrivilege(index) {
      this.privileges.splice(index, 1);
    }
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/privilege/PrivilegeView.vue?vue&type=template&id=fc7ab76e&":
/*!*********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/views/privilege/PrivilegeView.vue?vue&type=template&id=fc7ab76e& ***!
  \*********************************************************************************************************************************************************************************************************************/
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
            _c("h4", [_vm._v("privileges")]),
            _vm._v(" "),
            _c("div", { staticClass: "py-2 col-12 col-md-6 col-lg-4" }, [
              _c(
                "form",
                {
                  attrs: { action: "" },
                  on: {
                    submit: function ($event) {
                      $event.preventDefault()
                      return _vm.newPrivilege()
                    },
                  },
                },
                [
                  _c("input", {
                    directives: [
                      {
                        name: "model",
                        rawName: "v-model",
                        value: _vm.label,
                        expression: "label",
                      },
                    ],
                    staticClass: "form-control",
                    attrs: { type: "number", placeholder: "label" },
                    domProps: { value: _vm.label },
                    on: {
                      input: function ($event) {
                        if ($event.target.composing) {
                          return
                        }
                        _vm.label = $event.target.value
                      },
                    },
                  }),
                  _vm._v(" "),
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
                      placeholder: "Nuevo privilegio",
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
                    [_vm._v("Crear privilegio")]
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
            ]),
            _vm._v(" "),
            _c("div", [
              _c("table", { staticClass: "table table-striped table-light" }, [
                _vm._m(0),
                _vm._v(" "),
                _c(
                  "tbody",
                  _vm._l(_vm.privileges, function (privilege, index) {
                    return _c("privilegetable-component", {
                      key: index,
                      attrs: { privilege: privilege },
                      on: {
                        update: function ($event) {
                          var i = arguments.length,
                            argsArray = Array(i)
                          while (i--) argsArray[i] = arguments[i]
                          return _vm.updatePrivilege.apply(
                            void 0,
                            [index].concat(argsArray)
                          )
                        },
                        delete: function ($event) {
                          return _vm.deletePrivilege(index)
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
var staticRenderFns = [
  function () {
    var _vm = this
    var _h = _vm.$createElement
    var _c = _vm._self._c || _h
    return _c("thead", { staticClass: "bg-primary" }, [
      _c("tr", [
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Id")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Label")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Name")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Updated at")]),
        _vm._v(" "),
        _c("th", { attrs: { scope: "col" } }, [_vm._v("Options")]),
      ]),
    ])
  },
]
render._withStripped = true



/***/ }),

/***/ "./resources/js/views/privilege/PrivilegeView.vue":
/*!********************************************************!*\
  !*** ./resources/js/views/privilege/PrivilegeView.vue ***!
  \********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _PrivilegeView_vue_vue_type_template_id_fc7ab76e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./PrivilegeView.vue?vue&type=template&id=fc7ab76e& */ "./resources/js/views/privilege/PrivilegeView.vue?vue&type=template&id=fc7ab76e&");
/* harmony import */ var _PrivilegeView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./PrivilegeView.vue?vue&type=script&lang=js& */ "./resources/js/views/privilege/PrivilegeView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _PrivilegeView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _PrivilegeView_vue_vue_type_template_id_fc7ab76e___WEBPACK_IMPORTED_MODULE_0__["render"],
  _PrivilegeView_vue_vue_type_template_id_fc7ab76e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/views/privilege/PrivilegeView.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/views/privilege/PrivilegeView.vue?vue&type=script&lang=js&":
/*!*********************************************************************************!*\
  !*** ./resources/js/views/privilege/PrivilegeView.vue?vue&type=script&lang=js& ***!
  \*********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PrivilegeView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/babel-loader/lib??ref--4-0!../../../../node_modules/vue-loader/lib??vue-loader-options!./PrivilegeView.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/privilege/PrivilegeView.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_PrivilegeView_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/views/privilege/PrivilegeView.vue?vue&type=template&id=fc7ab76e&":
/*!***************************************************************************************!*\
  !*** ./resources/js/views/privilege/PrivilegeView.vue?vue&type=template&id=fc7ab76e& ***!
  \***************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PrivilegeView_vue_vue_type_template_id_fc7ab76e___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../node_modules/vue-loader/lib??vue-loader-options!./PrivilegeView.vue?vue&type=template&id=fc7ab76e& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/views/privilege/PrivilegeView.vue?vue&type=template&id=fc7ab76e&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PrivilegeView_vue_vue_type_template_id_fc7ab76e___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_PrivilegeView_vue_vue_type_template_id_fc7ab76e___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);