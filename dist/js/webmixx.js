(self.webpackChunkwebmixx=self.webpackChunkwebmixx||[]).push([[979],{363:(e,t,a)=>{"use strict";var n=a(669),r=a.n(n),i=a(234),s=a.n(i),o=function(){null!==document.querySelector(".form-control-editor")&&s().create(document.querySelector(".form-control-editor"),{toolbar:{items:["heading","|","bold","italic","link","bulletedList","numberedList","|","indent","outdent","|","blockQuote","insertTable","undo","redo"]}}).catch((function(e){console.log(e)}))};var l=a(538),u=a(629);const p={namespaced:!0,state:function(){return{link_types:[],link_type_models:{}}},actions:{index:function(e){var t=e.commit;return new Promise((function(e,a){r().get("/webmixx/api/link_types").then((function(a){t("load",a.data.data),e(a.data.data)}))}))},show:function(e,t){var a=e.commit;return new Promise((function(e,n){r().get("/webmixx/api/link_types/"+t.link_type).then((function(n){a("setLinkTypeModel",{link_type:t.link_type,models:n.data.data}),e(n.data.data)}))}))}},mutations:{load:function(e,t){e.link_types=t},setLinkTypeModel:function(e,t){e.link_type_models[t.link_type]=t.models},clearLinkTypeModels:function(e){e.link_type_models={}}},getters:{link_types:function(e){return e.link_types}}};var c=a(486),m=a.n(c),d=function e(t,a){var n=m().filter(t,{menu_item_id:a});return m().each(n,(function(a){a.menu_items=e(t,a.id)})),n},f=function e(t,a){m().each(t,(function(t){t.id===a.menu_item_id?m().remove(t.menu_items,{id:a.id}):t.menu_items.length>0&&e(t.menu_items,a)}))};const b={namespaced:!0,state:function(){return{menu:{},menus:[]}},actions:{show:function(e,t){var a=e.commit;return new Promise((function(e,n){r().get("/webmixx/api/menu/"+t.id).then((function(t){a("set",t.data.data),e(t.data.data)}))}))},setMenuItems:function(e,t){(0,e.commit)("setMenuItems",t)},addMenuItem:function(e,t){var a=e.commit;return new Promise((function(e,n){r().post("/webmixx/api/menu/"+t.menu_id+"/menu_item",t).then((function(t){a("addMenuItem",t.data.data),e(t.data.data)}))}))},updateMenuItem:function(e,t){e.commit;return new Promise((function(e,a){r().put("/webmixx/api/menu/"+t.menuItem.menu_id+"/menu_item/"+t.menuItem.id,{name:t.menuItem.name,order:t.order,menu_item_id:t.to_menu_item_id}).then((function(t){e()}))}))},deleteMenuItem:function(e,t){var a=e.commit;return new Promise((function(e,n){r().delete("/webmixx/api/menu/"+t.menu_id+"/menu_item/"+t.id).then((function(n){a("removeMenuItem",t),e()}))}))}},mutations:{set:function(e,t){t.menu_items=d(t.menu_items,null),e.menu=t},setMenuItems:function(e,t){e.menu.menu_items=t},addMenuItem:function(e,t){e.menu.menu_items.push(t)},removeMenuItem:function(e,t){var a=m().cloneDeep(e.menu.menu_items);null===t.menu_item_id?m().remove(a,{id:t.id}):f(a,t),e.menu.menu_items=a}},getters:{menu:function(e){return e.menu}}},g={namespaced:!0,state:function(){return{page_templates:[],page_template:{page_attribute_templates:[]}}},actions:{index:function(e){var t=e.commit;return new Promise((function(e,a){r().get("/webmixx/api/page_templates").then((function(a){t("load",a.data.data),e(a.data.data)}))}))}},mutations:{load:function(e,t){e.page_templates=t},set:function(e,t){e.page_template=t}},getters:{page_templates:function(e){return e.page_templates},page_template:function(e){return e.page_template}}},_={namespaced:!0,state:function(){return{pages:[],page:{page_template_id:null,page_attributes:[]}}},actions:{show:function(e,t){var a=e.commit;return new Promise((function(e,n){r().get("/webmixx/api/page/"+t.id).then((function(t){a("set",t.data.data),e(t.data.data)}))}))}},mutations:{set:function(e,t){e.page=t}},getters:{page:function(e){return e.page}}};l.default.use(u.ZP);const v=new u.ZP.Store({modules:{link_types:p,menus:b,page_templates:g,pages:_}});var h=a(272),y=a.n(h),O=a(980),w=a.n(O);function P(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function k(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?P(Object(a),!0).forEach((function(t){C(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):P(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function C(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const j={name:"pageAttributeTemplate",components:{draggable:w()},beforeMount:function(){0===this.ownedPageAttributes.length&&this.addPageAttribute()},props:{pageAttributeTemplate:{required:!0,type:Object},pageAttribute:{required:!1,type:Object,default:function(){return{id:null,page_attribute_template_id:this.pageAttributeTemplate.id}}},baseName:{required:!1,type:String,default:"attributes"}},methods:{addPageAttribute:function(){var e=0;this.page.page_attributes.length>0&&(e=m().maxBy(this.page.page_attributes,"id").id),this.page.page_attributes.push({id:e+1,page_attribute_template_id:this.pageAttributeTemplate.id,page_attribute_id:this.pageAttribute.id,order:this.ownedPageAttributes.length})}},computed:k(k(k({},(0,u.Se)("pages",["page"])),(0,u.Se)("page_templates",["page_template"])),{},{elementId:function(){return"attributeTemplate"},ownedPageAttributes:{get:function(){return m().sortBy(m().filter(this.page.page_attributes,{page_attribute_template_id:this.pageAttributeTemplate.id,page_attribute_id:this.pageAttribute.id}),"order")},set:function(e){var t=this;m().each(e,(function(e,a){void 0!==e&&(m().find(t.page.page_attributes,{id:e.id}).order=a)}))}}})};var x=a(900);const A=(0,x.Z)(j,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{class:{repeatable:e.pageAttributeTemplate.repeatable},attrs:{id:"attributeTemplate"+e.pageAttributeTemplate.id}},[e.pageAttributeTemplate.repeatable?a("draggable",{model:{value:e.ownedPageAttributes,callback:function(t){e.ownedPageAttributes=t},expression:"ownedPageAttributes"}},e._l(e.ownedPageAttributes,(function(t){return a("page-attribute",{key:t.id,attrs:{"page-attribute":t,"page-attribute-template":e.pageAttributeTemplate,"base-name":e.baseName}})})),1):e._l(e.ownedPageAttributes,(function(t){return a("page-attribute",{key:t.id,attrs:{"page-attribute":t,"page-attribute-template":e.pageAttributeTemplate,"base-name":e.baseName}})})),e._v(" "),e.pageAttributeTemplate.repeatable?a("div",{staticClass:"form-group text-right"},[a("span",{staticClass:"btn btn-sm btn-outline-success",on:{click:e.addPageAttribute}},[a("i",{staticClass:"fas fa-plus"}),e._v(" "+e._s(e.pageAttributeTemplate.name)+"\n        ")])]):e._e()],2)}),[],!1,null,"252a5d13",null).exports;function I(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function S(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?I(Object(a),!0).forEach((function(t){T(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):I(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function T(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const M={name:"pageAttribute",props:{pageAttributeTemplate:{required:!0,type:Object},pageAttribute:{required:!1,type:Object,default:function(){return{id:null,page_attribute_template_id:this.pageAttributeTemplate.id}}},baseName:{required:!0,type:String}},methods:{removePageAttribute:function(){var e=this.page.page_attributes.indexOf(this.pageAttribute);this.page.page_attributes.splice(e,1)}},computed:S(S(S({},(0,u.Se)("pages",["page"])),(0,u.Se)("page_templates",["page_template"])),{},{hasChildPageAttributeTemplates:function(){return"compound"===this.pageAttributeTemplate.field_type},childPageAttributeTemplates:function(){return m().orderBy(m().filter(this.page_template.page_attribute_templates,{page_attribute_template_id:this.pageAttributeTemplate.id}),"order")},fieldName:function(){return this.pageAttributeTemplate.repeatable?this.baseName+"["+this.pageAttributeTemplate.id+"][U"+this._uid+"]":this.baseName+"["+this.pageAttributeTemplate.id+"]"},fieldTypeComponent:function(){return"type"+m().replace(m().startCase(this.pageAttributeTemplate.field_type)," ","")}})};var q=a(379),E=a.n(q),D=a(910),N={insert:"head",singleton:!1};E()(D.Z,N);D.Z.locals;const Z=(0,x.Z)(M,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{class:"row field-"+e.pageAttributeTemplate.field_type,attrs:{"data-bound-by":"attributeTemplate"+e.pageAttributeTemplate.id}},[a("div",{staticClass:"col"},[e._l(e.childPageAttributeTemplates,(function(t){return e.childPageAttributeTemplates.length>0?a("page-attribute-template",{key:t.id,attrs:{"page-attribute-template":t,"page-attribute":e.pageAttribute,"base-name":e.fieldName}}):e._e()})),e._v(" "),0===e.childPageAttributeTemplates.length?a(e.fieldTypeComponent,{tag:"component",attrs:{name:e.fieldName,label:e.pageAttributeTemplate.name,value:e.pageAttribute.value}}):e._e()],2),e._v(" "),e.pageAttributeTemplate.repeatable?a("div",{staticClass:"col-auto text-right"},[e._m(0),e._v(" "),a("span",{staticClass:"btn btn-sm btn-outline-danger",on:{click:e.removePageAttribute}},[a("i",{staticClass:"fas fa-trash-alt"})])]):e._e()])}),[function(){var e=this.$createElement,t=this._self._c||e;return t("span",{staticClass:"btn btn-sm btn-link handle"},[t("i",{staticClass:"fas fa-arrows-alt"})])}],!1,null,"2caf435c",null).exports;function L(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function V(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?L(Object(a),!0).forEach((function(t){B(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):L(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function B(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const F={name:"pageForm",props:{pageId:{required:!1,type:Number,default:null}},watch:{"page.page_template_id":function(e){this.$store.commit("page_templates/set",m().find(this.page_templates,{id:e}))}},beforeMount:function(){var e=this;this.$store.dispatch("page_templates/index"),null!==this.pageId&&this.$store.dispatch("pages/show",{id:this.pageId}).then((function(t){e.$store.commit("page_templates/set",m().find(e.page_templates,{id:t.page_template_id}))}))},computed:V(V(V({},(0,u.Se)("pages",["page"])),(0,u.Se)("page_templates",["page_templates","page_template"])),{},{httpMethod:function(){return null===this.pageId?"post":"put"},httpUrl:function(){return null===this.pageId?"/webmixx/pages":"/webmixx/pages/"+this.pageId},rootPageAttributeTemplates:function(){return void 0===this.page_template?[]:m().orderBy(m().filter(this.page_template.page_attribute_templates,{page_attribute_template_id:null}),"order")}})};const R=(0,x.Z)(F,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("form",{attrs:{method:"post",action:e.httpUrl,enctype:"multipart/form-data"}},[a("input",{attrs:{type:"hidden",name:"_method"},domProps:{value:e.httpMethod}}),e._v(" "),a("input",{attrs:{type:"hidden",name:"_token"},domProps:{value:e.csrfToken}}),e._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:"name"}},[e._v("Name")]),e._v(" "),a("div",{staticClass:"col-9"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.page.name,expression:"page.name"}],staticClass:"form-control ",attrs:{type:"text",id:"name",name:"name"},domProps:{value:e.page.name},on:{input:function(t){t.target.composing||e.$set(e.page,"name",t.target.value)}}})])]),e._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:"page_template_id"}},[e._v("Page Template")]),e._v(" "),a("div",{staticClass:"col-9"},[a("select",{directives:[{name:"model",rawName:"v-model",value:e.page.page_template_id,expression:"page.page_template_id"}],staticClass:"form-control ",attrs:{disabled:null!==e.pageId,id:"page_template_id",name:"page_template_id"},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.$set(e.page,"page_template_id",t.target.multiple?a:a[0])}}},[a("option",{attrs:{value:"",disabled:"disabled"}},[e._v("Please Select")]),e._v(" "),e._l(e.page_templates,(function(t){return a("option",{domProps:{value:t.id,textContent:e._s(t.name)}})}))],2)])]),e._v(" "),a("h3",[e._v("Attributes")]),e._v(" "),e._l(e.rootPageAttributeTemplates,(function(e){return a("page-attribute-template",{key:e.id,attrs:{"page-attribute-template":e}})})),e._v(" "),e._m(0)],2)}),[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"form-group"},[a("a",{staticClass:"btn btn-secondary",attrs:{href:"/webmixx/pages"}},[e._v("Cancel")]),e._v(" "),a("button",{staticClass:"btn btn-primary",attrs:{type:"submit",name:"save",value:"save"}},[e._v("Save")])])}],!1,null,"7e399992",null).exports;const U={name:"type-image",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}}};const Q=(0,x.Z)(U,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:e.name},domProps:{textContent:e._s(e.label)}}),e._v(" "),a("div",{staticClass:"col-9"},[e.value?a("input",{attrs:{type:"hidden",name:e.name},domProps:{value:e.value}}):e._e(),e._v(" "),a("input",{staticClass:"form-control-file",attrs:{type:"file",id:e.name,name:e.name}})])])}),[],!1,null,"0d233447",null).exports;const X={name:"type-module-set",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}}};const H=(0,x.Z)(X,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"invisible"},[a("input",{attrs:{type:"hidden",name:e.name,value:"1"}})])}),[],!1,null,"04bb2f8e",null).exports;const W={name:"type-rich-text",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}},data:function(){return{editor:s(),editorConfig:{toolbar:{items:["heading","|","bold","italic","link","bulletedList","numberedList","|","indent","outdent","|","blockQuote","insertTable","undo","redo"]}},internalValue:this.value}},computed:{editorValue:{get:function(){return this.value},set:function(e){this.internalValue=e}}}};var z=a(6),G={insert:"head",singleton:!1};E()(z.Z,G);z.Z.locals;const J=(0,x.Z)(W,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:e.name},domProps:{textContent:e._s(e.label)}}),e._v(" "),a("div",{staticClass:"col-9"},[a("ckeditor",{attrs:{editor:e.editor,config:e.editorConfig},model:{value:e.editorValue,callback:function(t){e.editorValue=t},expression:"editorValue"}}),e._v(" "),a("input",{staticClass:"d-none",attrs:{type:"text",id:e.name,name:e.name},domProps:{value:e.internalValue}})],1)])}),[],!1,null,null,null).exports;const K={name:"type-string",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}}};const Y=(0,x.Z)(K,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:e.name},domProps:{textContent:e._s(e.label)}}),e._v(" "),a("div",{staticClass:"col-9"},[a("input",{staticClass:"form-control",attrs:{type:"text",id:e.name,name:e.name},domProps:{value:e.value}})])])}),[],!1,null,"39a26520",null).exports;const ee={name:"type-text",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}}};const te=(0,x.Z)(ee,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:e.name},domProps:{textContent:e._s(e.label)}}),e._v(" "),a("div",{staticClass:"col-9"},[a("textarea",{staticClass:"form-control",attrs:{id:e.name,name:e.name,rows:"3"}},[e._v(e._s(e.$value))])])])}),[],!1,null,"0c1a08c3",null).exports;function ae(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function ne(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?ae(Object(a),!0).forEach((function(t){re(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):ae(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function re(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const ie={name:"menuItems",components:{draggable:w()},props:{value:{required:!1,type:Array,default:null},list:{required:!1,type:Array,default:null},parentName:{required:!0,type:String},parentMenuItemId:{required:!1,type:Number,default:null}},methods:{emitter:function(e){this.$emit("input",e)},log:function(e){e.hasOwnProperty("added")?this.$store.dispatch("menus/updateMenuItem",{menuItem:e.added.element,order:e.added.newIndex,to_menu_item_id:this.parentMenuItemId}):e.hasOwnProperty("moved")&&this.$store.dispatch("menus/updateMenuItem",{menuItem:e.moved.element,order:e.moved.newIndex,to_menu_item_id:this.parentMenuItemId})},deleteMenuItem:function(e){this.$store.dispatch("menus/deleteMenuItem",e)}},computed:ne(ne({},(0,u.Se)("menus",["menu"])),{},{dragOptions:function(){return{animation:0,group:"description",disabled:!1,ghostClass:"ghost"}},realValue:function(){return this.value?this.value:this.list}})};var se=a(431),oe={insert:"head",singleton:!1};E()(se.Z,oe);se.Z.locals;const le=(0,x.Z)(ie,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("draggable",e._b({staticClass:"item-container",attrs:{tag:"div",list:e.list,value:e.value},on:{input:e.emitter,change:e.log}},"draggable",e.dragOptions,!1),e._l(e.realValue,(function(t){return a("div",{key:t.id,staticClass:"item-group"},[a("div",{staticClass:"item d-flex"},[a("span",{staticClass:"btn btn-sm btn-link handle"},[a("i",{staticClass:"fas fa-arrows-alt"})]),e._v("\n            "+e._s(t.name)+"\n            "),a("input",{attrs:{type:"hidden",name:e.parentName+"["+t.id+"][id]"},domProps:{value:t.id}}),e._v(" "),a("div",{staticClass:"d-inline-block ml-auto"},[t.actions.delete?a("span",{staticClass:"btn btn-sm btn-outline-danger",on:{click:function(a){return e.deleteMenuItem(t)}}},[a("i",{staticClass:"fas fa-trash-alt"})]):e._e()])]),e._v(" "),a("menu-items",{staticClass:"item-sub",attrs:{parentMenuItemId:t.id,list:t.menu_items,parentName:e.parentName+"["+t.id+"][menu_items]"}})],1)})),0)}),[],!1,null,"4a32c008",null).exports;function ue(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function pe(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const ce={name:"menuItemSelect",props:{menuId:{required:!0,type:Number}},beforeMount:function(){this.$store.dispatch("link_types/index")},data:function(){return{name:"",link_type:"",link_id:null,link_models:[]}},methods:{loadLinkTypeModels:function(){var e=this;this.$store.dispatch("link_types/show",{link_type:this.link_type}).then((function(t){e.link_models=t})).catch((function(){e.link_models=[]}))},saveMenuItem:function(){var e=this;this.$store.dispatch("menus/addMenuItem",{menu_id:this.menuId,link_type:this.link_type,link_id:this.link_id,name:this.name}).then((function(){$(e.$el).modal("hide"),e.resetForm(),e.$store.commit("link_types/clearLinkTypeModels")}))},resetForm:function(){this.data={name:"",link_type:"",link_id:null,link_models:[]}}},computed:function(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?ue(Object(a),!0).forEach((function(t){pe(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):ue(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}({},(0,u.Se)("link_types",["link_types"]))};function me(e,t){var a=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),a.push.apply(a,n)}return a}function de(e){for(var t=1;t<arguments.length;t++){var a=null!=arguments[t]?arguments[t]:{};t%2?me(Object(a),!0).forEach((function(t){fe(e,t,a[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(a)):me(Object(a)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(a,t))}))}return e}function fe(e,t,a){return t in e?Object.defineProperty(e,t,{value:a,enumerable:!0,configurable:!0,writable:!0}):e[t]=a,e}const be={name:"menuBuilder",components:{MenuItems:le,MenuItemSelect:(0,x.Z)(ce,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"modal",attrs:{tabindex:"-1"}},[a("div",{staticClass:"modal-dialog"},[a("div",{staticClass:"modal-content"},[e._m(0),e._v(" "),a("div",{staticClass:"modal-body"},[a("form",[a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:"name"}},[e._v("Name")]),e._v(" "),a("div",{staticClass:"col-9"},[a("input",{directives:[{name:"model",rawName:"v-model",value:e.name,expression:"name"}],staticClass:"form-control ",attrs:{type:"text",id:"name",name:"name"},domProps:{value:e.name},on:{input:function(t){t.target.composing||(e.name=t.target.value)}}})])]),e._v(" "),a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:"link_type"}},[e._v("Link Type")]),e._v(" "),a("div",{staticClass:"col-9"},[a("select",{directives:[{name:"model",rawName:"v-model",value:e.link_type,expression:"link_type"}],staticClass:"form-control",attrs:{id:"link_type",name:"link_type"},on:{change:[function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.link_type=t.target.multiple?a:a[0]},e.loadLinkTypeModels]}},[a("option",{attrs:{value:"",disabled:"disabled"}},[e._v("Please Select")]),e._v(" "),e._l(e.link_types,(function(t){return a("option",{domProps:{value:t.id}},[e._v(e._s(t.name))])}))],2)])]),e._v(" "),""!==e.link_type?a("div",{staticClass:"form-group row"},[a("label",{staticClass:"col-3 col-form-label",attrs:{for:"link_type"}},[e._v("Link Model")]),e._v(" "),a("div",{staticClass:"col-9"},[a("select",{directives:[{name:"model",rawName:"v-model",value:e.link_id,expression:"link_id"}],staticClass:"form-control",attrs:{id:"link_id",name:"link_id"},on:{change:function(t){var a=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.link_id=t.target.multiple?a:a[0]}}},[a("option",{attrs:{value:"",disabled:"disabled"}},[e._v("Please Select")]),e._v(" "),e._l(e.link_models,(function(t){return a("option",{domProps:{value:t.id}},[e._v(e._s(t.name))])}))],2)])]):e._e()])]),e._v(" "),a("div",{staticClass:"modal-footer"},[a("button",{staticClass:"btn btn-secondary",attrs:{type:"button","data-dismiss":"modal"}},[e._v("Close")]),e._v(" "),a("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:e.saveMenuItem}},[e._v("Save changes")])])])])])}),[function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"modal-header"},[a("h5",{staticClass:"modal-title"},[e._v("Modal title")]),e._v(" "),a("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[a("span",{attrs:{"aria-hidden":"true"}},[e._v("×")])])])}],!1,null,"75b6dda2",null).exports},props:{menuId:{required:!0,type:Number}},beforeMount:function(){this.$store.dispatch("menus/show",{id:this.menuId})},methods:{openAddMenuItemModal:function(){$(this.$refs.menuItemModal.$el).modal()}},computed:de(de({},(0,u.Se)("menus",["menu"])),{},{menuItems:{get:function(){return this.menu.menu_items},set:function(e){this.$store.dispatch("menus/setMenuItems",e)}}})};const ge=(0,x.Z)(be,(function(){var e=this,t=e.$createElement,a=e._self._c||t;return a("div",{staticClass:"justify-content-between row"},[a("div",{staticClass:"col-12 mt-4"},[a("span",{staticClass:"btn btn-sm btn-outline-success",on:{click:e.openAddMenuItemModal}},[a("i",{staticClass:"fas fa-plus"})])]),e._v(" "),a("menu-items",{staticClass:"col-12",attrs:{parentName:"menu_items"},model:{value:e.menuItems,callback:function(t){e.menuItems=t},expression:"menuItems"}}),e._v(" "),a("div",{staticClass:"col-12 mt-4"},[a("menu-item-select",{ref:"menuItemModal",attrs:{"menu-id":e.menuId}})],1)],1)}),[],!1,null,"861c6d9a",null).exports;r().defaults.headers.common["X-Requested-With"]="XMLHttpRequest",Object.defineProperty(l.default.prototype,"csrfToken",{get:function(){return document.head.querySelector('meta[name="csrf-token"]').content}}),l.default.use(y()),!1===$("#app").hasClass("no-vue")&&(l.default.component("pageAttributeTemplate",A),l.default.component("pageAttribute",Z),l.default.component("pageForm",R),l.default.component("typeImage",Q),l.default.component("typeModuleSet",H),l.default.component("typeRichText",J),l.default.component("typeString",Y),l.default.component("typeText",te),l.default.component("menuBuilder",ge),new l.default({el:"#app",store:v})),o()},6:(e,t,a)=>{"use strict";a.d(t,{Z:()=>i});var n=a(645),r=a.n(n)()((function(e){return e[1]}));r.push([e.id,".ck.ck-editor__editable{min-height:200px}",""]);const i=r},431:(e,t,a)=>{"use strict";a.d(t,{Z:()=>i});var n=a(645),r=a.n(n)()((function(e){return e[1]}));r.push([e.id,".item-container[data-v-4a32c008]{max-width:30rem;margin:0}.item[data-v-4a32c008]{padding:1rem;border:1px solid #000;background-color:#fefefe}.item-sub[data-v-4a32c008]{margin:0 0 0 1rem}.btn .handle[data-v-4a32c008]{cursor:move}",""]);const i=r},910:(e,t,a)=>{"use strict";a.d(t,{Z:()=>i});var n=a(645),r=a.n(n)()((function(e){return e[1]}));r.push([e.id,".field-compound[data-v-2caf435c]{padding:7px 0;border:1px solid var(--secondary);border-radius:7px;margin-bottom:7px}.btn .handle[data-v-2caf435c]{cursor:move}",""]);const i=r},839:()=>{}},0,[[363,929,898],[839,929,898]]]);