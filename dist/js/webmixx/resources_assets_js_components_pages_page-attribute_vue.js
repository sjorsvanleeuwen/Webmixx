(self["webpackChunkwebmixx"] = self["webpackChunkwebmixx"] || []).push([["resources_assets_js_components_pages_page-attribute_vue"],{

/***/ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/components/pages/page-attribute.vue?vue&type=script&lang=js&":
/*!**********************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/components/pages/page-attribute.vue?vue&type=script&lang=js& ***!
  \**********************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
/* harmony import */ var lodash__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(lodash__WEBPACK_IMPORTED_MODULE_0__);
//
//
//
//
//
//
//
//
//

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  name: "page-attribute",
  components: {
    PageAttributeTemplate: function PageAttributeTemplate() {
      return Promise.resolve(/*! import() */).then(__webpack_require__.bind(__webpack_require__, /*! ./page-attribute-template.vue */ "./resources/assets/js/components/pages/page-attribute-template.vue"));
    }
  },
  props: {
    pageAttributeTemplate: {
      required: true,
      type: Object
    },
    pageTemplate: {
      required: true,
      type: Object
    },
    pageAttribute: {
      required: false,
      type: Object,
      "default": {}
    },
    baseName: {
      required: true,
      type: String
    }
  },
  computed: {
    hasChildPageAttributeTemplates: function hasChildPageAttributeTemplates() {
      return this.pageTemplate.field_type === 'compound';
    },
    childPageAttributeTemplates: function childPageAttributeTemplates() {
      return lodash__WEBPACK_IMPORTED_MODULE_0___default().filter(this.pageTemplate.page_attribute_templates, {
        page_attribute_template_id: this.pageAttributeTemplate.id
      });
    },
    fieldName: function fieldName() {
      if (this.pageAttributeTemplate.repeatable) {
        return this.baseName + '[' + this.pageAttributeTemplate.id + '][' + this._uid + ']';
      }

      return this.baseName + '[' + this.pageAttributeTemplate.id + ']';
    }
  }
});

/***/ }),

/***/ "./resources/assets/js/components/pages/page-attribute.vue":
/*!*****************************************************************!*\
  !*** ./resources/assets/js/components/pages/page-attribute.vue ***!
  \*****************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _page_attribute_vue_vue_type_template_id_d56e66c0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./page-attribute.vue?vue&type=template&id=d56e66c0&scoped=true& */ "./resources/assets/js/components/pages/page-attribute.vue?vue&type=template&id=d56e66c0&scoped=true&");
/* harmony import */ var _page_attribute_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./page-attribute.vue?vue&type=script&lang=js& */ "./resources/assets/js/components/pages/page-attribute.vue?vue&type=script&lang=js&");
/* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! !../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */
;
var component = (0,_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__.default)(
  _page_attribute_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__.default,
  _page_attribute_vue_vue_type_template_id_d56e66c0_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
  _page_attribute_vue_vue_type_template_id_d56e66c0_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns,
  false,
  null,
  "d56e66c0",
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/assets/js/components/pages/page-attribute.vue"
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (component.exports);

/***/ }),

/***/ "./resources/assets/js/components/pages/page-attribute.vue?vue&type=script&lang=js&":
/*!******************************************************************************************!*\
  !*** ./resources/assets/js/components/pages/page-attribute.vue?vue&type=script&lang=js& ***!
  \******************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => __WEBPACK_DEFAULT_EXPORT__
/* harmony export */ });
/* harmony import */ var _node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_page_attribute_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./page-attribute.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js??clonedRuleSet-5[0].rules[0].use[0]!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/components/pages/page-attribute.vue?vue&type=script&lang=js&");
 /* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (_node_modules_babel_loader_lib_index_js_clonedRuleSet_5_0_rules_0_use_0_node_modules_vue_loader_lib_index_js_vue_loader_options_page_attribute_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__.default); 

/***/ }),

/***/ "./resources/assets/js/components/pages/page-attribute.vue?vue&type=template&id=d56e66c0&scoped=true&":
/*!************************************************************************************************************!*\
  !*** ./resources/assets/js/components/pages/page-attribute.vue?vue&type=template&id=d56e66c0&scoped=true& ***!
  \************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_page_attribute_vue_vue_type_template_id_d56e66c0_scoped_true___WEBPACK_IMPORTED_MODULE_0__.render,
/* harmony export */   "staticRenderFns": () => /* reexport safe */ _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_page_attribute_vue_vue_type_template_id_d56e66c0_scoped_true___WEBPACK_IMPORTED_MODULE_0__.staticRenderFns
/* harmony export */ });
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_page_attribute_vue_vue_type_template_id_d56e66c0_scoped_true___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib/index.js??vue-loader-options!./page-attribute.vue?vue&type=template&id=d56e66c0&scoped=true& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/components/pages/page-attribute.vue?vue&type=template&id=d56e66c0&scoped=true&");


/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/components/pages/page-attribute.vue?vue&type=template&id=d56e66c0&scoped=true&":
/*!***************************************************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib/index.js??vue-loader-options!./resources/assets/js/components/pages/page-attribute.vue?vue&type=template&id=d56e66c0&scoped=true& ***!
  \***************************************************************************************************************************************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "render": () => /* binding */ render,
/* harmony export */   "staticRenderFns": () => /* binding */ staticRenderFns
/* harmony export */ });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "div",
    {
      class: "field-" + _vm.pageAttributeTemplate.field_type,
      attrs: {
        "data-bound-by": "attributeTemplate" + _vm.pageAttributeTemplate.id
      }
    },
    _vm._l(_vm.childPageAttributeTemplates, function(
      childPageAttributeTemplate
    ) {
      return _vm.hasChildPageAttributeTemplates
        ? _c("page-attribute-template", {
            key: childPageAttributeTemplate.id,
            attrs: {
              "page-template": _vm.pageTemplate,
              "page-attribute-template": childPageAttributeTemplate,
              "page-attribute": _vm.pageAttribute,
              "base-name": _vm.fieldName
            }
          })
        : _vm._e()
    }),
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ })

}]);