(self.webpackChunkwebmixx=self.webpackChunkwebmixx||[]).push([[979],{415:(e,t,n)=>{"use strict";var a=n(669),i=n.n(a),r=n(234),s=n.n(r),o=function(){null!==document.querySelector(".form-control-editor")&&s().create(document.querySelector(".form-control-editor"),{toolbar:{items:["heading","|","bold","italic","link","bulletedList","numberedList","|","indent","outdent","|","blockQuote","insertTable","undo","redo"]}}).catch((function(e){console.log(e)}))};var l=n(538),u=n(629);const c={namespaced:!0,state:function(){return{link_types:[],link_type_models:{}}},actions:{index:function(e){var t=e.commit;return new Promise((function(e,n){i().get("/webmixx/api/link_types").then((function(n){t("load",n.data.data),e(n.data.data)}))}))},show:function(e,t){var n=e.commit;return new Promise((function(e,a){i().get("/webmixx/api/link_types/"+t.link_type).then((function(a){n("setLinkTypeModel",{link_type:t.link_type,models:a.data.data}),e(a.data.data)}))}))}},mutations:{load:function(e,t){e.link_types=t},setLinkTypeModel:function(e,t){e.link_type_models[t.link_type]=t.models},clearLinkTypeModels:function(e){e.link_type_models={}}},getters:{link_types:function(e){return e.link_types}}};var p=n(486),m=n.n(p),d=function e(t,n){var a=m().filter(t,{menu_item_id:n});return m().each(a,(function(n){n.menu_items=e(t,n.id)})),a},f=function e(t,n){m().each(t,(function(t){t.id===n.menu_item_id?m().remove(t.menu_items,{id:n.id}):t.menu_items.length>0&&e(t.menu_items,n)}))};const b={namespaced:!0,state:function(){return{menu:{},menus:[]}},actions:{show:function(e,t){var n=e.commit;return new Promise((function(e,a){i().get("/webmixx/api/menu/"+t.id).then((function(t){n("set",t.data.data),e(t.data.data)}))}))},setMenuItems:function(e,t){(0,e.commit)("setMenuItems",t)},addMenuItem:function(e,t){var n=e.commit;return new Promise((function(e,a){i().post("/webmixx/api/menu/"+t.menu_id+"/menu_item",t).then((function(t){n("addMenuItem",t.data.data),e(t.data.data)}))}))},updateMenuItem:function(e,t){e.commit;return new Promise((function(e,n){i().put("/webmixx/api/menu/"+t.menuItem.menu_id+"/menu_item/"+t.menuItem.id,{name:t.menuItem.name,order:t.order,menu_item_id:t.to_menu_item_id}).then((function(t){e(t.data)}))}))},deleteMenuItem:function(e,t){var n=e.commit;return new Promise((function(e,a){i().delete("/webmixx/api/menu/"+t.menu_id+"/menu_item/"+t.id).then((function(a){n("removeMenuItem",t),e()}))}))}},mutations:{set:function(e,t){t.menu_items=d(t.menu_items,null),e.menu=t},setMenuItems:function(e,t){e.menu.menu_items=t},addMenuItem:function(e,t){e.menu.menu_items.push(t)},removeMenuItem:function(e,t){var n=m().cloneDeep(e.menu.menu_items);null===t.menu_item_id?m().remove(n,{id:t.id}):f(n,t),e.menu.menu_items=n}},getters:{menu:function(e){return e.menu}}},g={namespaced:!0,state:function(){return{page_templates:[],page_template:{page_attribute_templates:[]}}},actions:{index:function(e){var t=e.commit;return new Promise((function(e,n){i().get("/webmixx/api/page_templates").then((function(n){t("load",n.data.data),e(n.data.data)}))}))}},mutations:{load:function(e,t){e.page_templates=t},set:function(e,t){e.page_template=t}},getters:{page_templates:function(e){return e.page_templates},page_template:function(e){return e.page_template}}},_={namespaced:!0,state:function(){return{pages:[],page:{page_template_id:null,page_attributes:[]}}},actions:{show:function(e,t){var n=e.commit;return new Promise((function(e,a){i().get("/webmixx/api/page/"+t.id).then((function(t){n("set",t.data.data),e(t.data.data)}))}))}},mutations:{set:function(e,t){e.page=t}},getters:{page:function(e){return e.page}}};l.default.use(u.ZP);const v=new u.ZP.Store({modules:{link_types:c,menus:b,page_templates:g,pages:_}});var h=n(272),y=n.n(h),O=n(980),P=n.n(O);function w(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function C(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?w(Object(n),!0).forEach((function(t){k(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):w(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function k(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const x={name:"pageAttributeTemplate",components:{draggable:P()},beforeMount:function(){0===this.ownedPageAttributes.length&&this.addPageAttribute()},props:{pageAttributeTemplate:{required:!0,type:Object},pageAttribute:{required:!1,type:Object,default:function(){return{id:null,page_attribute_template_id:this.pageAttributeTemplate.id}}},baseName:{required:!1,type:String,default:"attributes"}},methods:{addPageAttribute:function(){var e=0;this.page.page_attributes.length>0&&(e=m().maxBy(this.page.page_attributes,"id").id),this.page.page_attributes.push({id:e+1,page_attribute_template_id:this.pageAttributeTemplate.id,page_attribute_id:this.pageAttribute.id,order:this.ownedPageAttributes.length})}},computed:C(C(C({},(0,u.Se)("pages",["page"])),(0,u.Se)("page_templates",["page_template"])),{},{elementId:function(){return"attributeTemplate"},ownedPageAttributes:{get:function(){return m().sortBy(m().filter(this.page.page_attributes,{page_attribute_template_id:this.pageAttributeTemplate.id,page_attribute_id:this.pageAttribute.id}),"order")},set:function(e){var t=this;m().each(e,(function(e,n){void 0!==e&&(m().find(t.page.page_attributes,{id:e.id}).order=n)}))}}})};var j=n(900);const I=(0,j.Z)(x,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{class:{repeatable:e.pageAttributeTemplate.repeatable},attrs:{id:"attributeTemplate"+e.pageAttributeTemplate.id}},[e.pageAttributeTemplate.repeatable?n("draggable",{model:{value:e.ownedPageAttributes,callback:function(t){e.ownedPageAttributes=t},expression:"ownedPageAttributes"}},e._l(e.ownedPageAttributes,(function(t){return n("page-attribute",{key:t.id,attrs:{"page-attribute":t,"page-attribute-template":e.pageAttributeTemplate,"base-name":e.baseName}})})),1):e._l(e.ownedPageAttributes,(function(t){return n("page-attribute",{key:t.id,attrs:{"page-attribute":t,"page-attribute-template":e.pageAttributeTemplate,"base-name":e.baseName}})})),e._v(" "),e.pageAttributeTemplate.repeatable?n("div",{staticClass:"form-group text-right"},[n("span",{staticClass:"btn btn-sm btn-outline-success",on:{click:e.addPageAttribute}},[n("i",{staticClass:"fas fa-plus"}),e._v(" "+e._s(e.pageAttributeTemplate.name)+"\n        ")])]):e._e()],2)}),[],!1,null,"252a5d13",null).exports;function A(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function S(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?A(Object(n),!0).forEach((function(t){T(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):A(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function T(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const M={name:"pageAttribute",props:{pageAttributeTemplate:{required:!0,type:Object},pageAttribute:{required:!1,type:Object,default:function(){return{id:null,page_attribute_template_id:this.pageAttributeTemplate.id}}},baseName:{required:!0,type:String}},methods:{removePageAttribute:function(){var e=this.page.page_attributes.indexOf(this.pageAttribute);this.page.page_attributes.splice(e,1)}},computed:S(S(S({},(0,u.Se)("pages",["page"])),(0,u.Se)("page_templates",["page_template"])),{},{hasChildPageAttributeTemplates:function(){return"compound"===this.pageAttributeTemplate.field_type},childPageAttributeTemplates:function(){return m().orderBy(m().filter(this.page_template.page_attribute_templates,{page_attribute_template_id:this.pageAttributeTemplate.id}),"order")},fieldName:function(){return this.pageAttributeTemplate.repeatable?this.baseName+"["+this.pageAttributeTemplate.id+"][U"+this._uid+"]":this.baseName+"["+this.pageAttributeTemplate.id+"]"},fieldTypeComponent:function(){return"type"+m().replace(m().startCase(this.pageAttributeTemplate.field_type)," ","")}})};var E=n(379),q=n.n(E),D=n(910),N={insert:"head",singleton:!1};q()(D.Z,N);D.Z.locals;const Z=(0,j.Z)(M,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{class:"row field-"+e.pageAttributeTemplate.field_type,attrs:{"data-bound-by":"attributeTemplate"+e.pageAttributeTemplate.id}},[n("div",{staticClass:"col"},[e._l(e.childPageAttributeTemplates,(function(t){return e.childPageAttributeTemplates.length>0?n("page-attribute-template",{key:t.id,attrs:{"page-attribute-template":t,"page-attribute":e.pageAttribute,"base-name":e.fieldName}}):e._e()})),e._v(" "),0===e.childPageAttributeTemplates.length?n(e.fieldTypeComponent,{tag:"component",attrs:{name:e.fieldName,label:e.pageAttributeTemplate.name,value:e.pageAttribute.value}}):e._e()],2),e._v(" "),e.pageAttributeTemplate.repeatable?n("div",{staticClass:"col-auto text-right"},[e._m(0),e._v(" "),n("span",{staticClass:"btn btn-sm btn-outline-danger",on:{click:e.removePageAttribute}},[n("i",{staticClass:"fas fa-trash-alt"})])]):e._e()])}),[function(){var e=this.$createElement,t=this._self._c||e;return t("span",{staticClass:"btn btn-sm btn-link handle"},[t("i",{staticClass:"fas fa-arrows-alt"})])}],!1,null,"2caf435c",null).exports;function L(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function V(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?L(Object(n),!0).forEach((function(t){B(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):L(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function B(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const R={name:"pageForm",props:{pageId:{required:!1,type:Number,default:null}},watch:{"page.page_template_id":function(e){this.$store.commit("page_templates/set",m().find(this.page_templates,{id:e}))}},beforeMount:function(){var e=this;this.$store.dispatch("page_templates/index"),null!==this.pageId&&this.$store.dispatch("pages/show",{id:this.pageId}).then((function(t){e.$store.commit("page_templates/set",m().find(e.page_templates,{id:t.page_template_id}))}))},computed:V(V(V({},(0,u.Se)("pages",["page"])),(0,u.Se)("page_templates",["page_templates","page_template"])),{},{httpMethod:function(){return null===this.pageId?"post":"put"},httpUrl:function(){return null===this.pageId?"/webmixx/pages":"/webmixx/pages/"+this.pageId},rootPageAttributeTemplates:function(){return void 0===this.page_template?[]:m().orderBy(m().filter(this.page_template.page_attribute_templates,{page_attribute_template_id:null}),"order")}})};const U=(0,j.Z)(R,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("form",{attrs:{method:"post",action:e.httpUrl,enctype:"multipart/form-data"}},[n("input",{attrs:{type:"hidden",name:"_method"},domProps:{value:e.httpMethod}}),e._v(" "),n("input",{attrs:{type:"hidden",name:"_token"},domProps:{value:e.csrfToken}}),e._v(" "),n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:"name"}},[e._v("Name")]),e._v(" "),n("div",{staticClass:"col-9"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.page.name,expression:"page.name"}],staticClass:"form-control ",attrs:{type:"text",id:"name",name:"name"},domProps:{value:e.page.name},on:{input:function(t){t.target.composing||e.$set(e.page,"name",t.target.value)}}})])]),e._v(" "),n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:"page_template_id"}},[e._v("Page Template")]),e._v(" "),n("div",{staticClass:"col-9"},[n("select",{directives:[{name:"model",rawName:"v-model",value:e.page.page_template_id,expression:"page.page_template_id"}],staticClass:"form-control ",attrs:{disabled:null!==e.pageId,id:"page_template_id",name:"page_template_id"},on:{change:function(t){var n=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.$set(e.page,"page_template_id",t.target.multiple?n:n[0])}}},[n("option",{attrs:{value:"",disabled:"disabled"}},[e._v("Please Select")]),e._v(" "),e._l(e.page_templates,(function(t){return n("option",{domProps:{value:t.id,textContent:e._s(t.name)}})}))],2)])]),e._v(" "),n("h3",[e._v("Attributes")]),e._v(" "),e._l(e.rootPageAttributeTemplates,(function(e){return n("page-attribute-template",{key:e.id,attrs:{"page-attribute-template":e}})})),e._v(" "),e._m(0)],2)}),[function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"form-group"},[n("a",{staticClass:"btn btn-secondary",attrs:{href:"/webmixx/pages"}},[e._v("Cancel")]),e._v(" "),n("button",{staticClass:"btn btn-primary",attrs:{type:"submit",name:"save",value:"save"}},[e._v("Save")])])}],!1,null,"7e399992",null).exports;const F={name:"type-image",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}}};const Q=(0,j.Z)(F,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:e.name},domProps:{textContent:e._s(e.label)}}),e._v(" "),n("div",{staticClass:"col-9"},[e.value?n("input",{attrs:{type:"hidden",name:e.name},domProps:{value:e.value}}):e._e(),e._v(" "),n("input",{staticClass:"form-control-file",attrs:{type:"file",id:e.name,name:e.name}})])])}),[],!1,null,"0d233447",null).exports;const X={name:"type-module-set",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}}};const H=(0,j.Z)(X,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"invisible"},[n("input",{attrs:{type:"hidden",name:e.name,value:"1"}})])}),[],!1,null,"04bb2f8e",null).exports;const W={name:"type-rich-text",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}},data:function(){return{editor:s(),editorConfig:{toolbar:{items:["heading","|","bold","italic","link","bulletedList","numberedList","|","indent","outdent","|","blockQuote","insertTable","undo","redo"]}},internalValue:this.value}},computed:{editorValue:{get:function(){return this.value},set:function(e){this.internalValue=e}}}};var z=n(6),G={insert:"head",singleton:!1};q()(z.Z,G);z.Z.locals;const J=(0,j.Z)(W,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:e.name},domProps:{textContent:e._s(e.label)}}),e._v(" "),n("div",{staticClass:"col-9"},[n("ckeditor",{attrs:{editor:e.editor,config:e.editorConfig},model:{value:e.editorValue,callback:function(t){e.editorValue=t},expression:"editorValue"}}),e._v(" "),n("input",{staticClass:"d-none",attrs:{type:"text",id:e.name,name:e.name},domProps:{value:e.internalValue}})],1)])}),[],!1,null,null,null).exports;const K={name:"type-string",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}}};const Y=(0,j.Z)(K,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:e.name},domProps:{textContent:e._s(e.label)}}),e._v(" "),n("div",{staticClass:"col-9"},[n("input",{staticClass:"form-control",attrs:{type:"text",id:e.name,name:e.name},domProps:{value:e.value}})])])}),[],!1,null,"39a26520",null).exports;const ee={name:"type-text",props:{name:{required:!0,type:String},label:{required:!0,type:String},value:{required:!1,type:String,default:""}}};const te=(0,j.Z)(ee,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:e.name},domProps:{textContent:e._s(e.label)}}),e._v(" "),n("div",{staticClass:"col-9"},[n("textarea",{staticClass:"form-control",attrs:{id:e.name,name:e.name,rows:"3"}},[e._v(e._s(e.$value))])])])}),[],!1,null,"0c1a08c3",null).exports;function ne(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function ae(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?ne(Object(n),!0).forEach((function(t){ie(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):ne(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function ie(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const re={name:"menuItems",components:{draggable:P()},props:{value:{required:!1,type:Array,default:null},list:{required:!1,type:Array,default:null},parentName:{required:!0,type:String},parentMenuItemId:{required:!1,type:Number,default:null}},data:function(){return{editing:{id:null,value:null}}},methods:{startEdit:function(e){this.editing.id=e},isEditing:function(e){return this.editing.id===e},change:function(e){this.editing.value=e.target.value},emitter:function(e){this.$emit("input",e)},finishEdit:function(e){var t=this;e.name=this.editing.value,this.$store.dispatch("menus/updateMenuItem",{menuItem:e,order:e.order,to_menu_item_id:this.parentMenuItemId}).then((function(){t.editing.id=null,t.editing.value=null}))},cancelEdit:function(){this.editing.id=null,this.editing.value=null},log:function(e){e.hasOwnProperty("added")?this.$store.dispatch("menus/updateMenuItem",{menuItem:e.added.element,order:e.added.newIndex,to_menu_item_id:this.parentMenuItemId}):e.hasOwnProperty("moved")&&this.$store.dispatch("menus/updateMenuItem",{menuItem:e.moved.element,order:e.moved.newIndex,to_menu_item_id:this.parentMenuItemId})},deleteMenuItem:function(e){this.$store.dispatch("menus/deleteMenuItem",e)}},computed:ae(ae({},(0,u.Se)("menus",["menu"])),{},{dragOptions:function(){return{animation:0,group:"description",disabled:!1,ghostClass:"ghost"}},realValue:function(){return this.value?this.value:this.list}})};var se=n(396),oe={insert:"head",singleton:!1};q()(se.Z,oe);se.Z.locals;const le=(0,j.Z)(re,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("draggable",e._b({staticClass:"item-container",attrs:{tag:"div",list:e.list,value:e.value},on:{input:e.emitter,change:e.log}},"draggable",e.dragOptions,!1),e._l(e.realValue,(function(t){return n("div",{key:t.id,staticClass:"item-group"},[n("div",{staticClass:"item",class:[e.isEditing(t.id)?"d-none":"d-flex"]},[n("span",{staticClass:"btn btn-link handle",attrs:{title:"Move"}},[n("i",{staticClass:"fas fa-arrows-alt"})]),e._v(" "),n("input",{staticClass:"form-control-plaintext",attrs:{type:"text",readonly:""},domProps:{value:t.name}}),e._v(" "),n("input",{attrs:{type:"hidden",name:e.parentName+"["+t.id+"][id]"},domProps:{value:t.id}}),e._v(" "),n("div",{staticClass:"d-inline-block ml-auto"},[n("div",{staticClass:"btn-group",attrs:{role:"group"}},[t.actions.update?n("span",{staticClass:"btn btn-outline-success",attrs:{title:"Edit"},on:{click:function(n){return e.startEdit(t.id)}}},[n("i",{staticClass:"fas fa-pencil-alt"})]):e._e(),e._v(" "),t.actions.delete?n("span",{staticClass:"btn btn-outline-danger",attrs:{title:"Delete"},on:{click:function(n){return e.deleteMenuItem(t)}}},[n("i",{staticClass:"fas fa-trash-alt"})]):e._e()])])]),e._v(" "),n("div",{staticClass:"item",class:[e.isEditing(t.id)?"d-flex":"d-none"]},[n("div",{staticClass:"input-group"},[n("input",{staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.name},on:{input:function(t){return e.change(t)}}}),e._v(" "),n("div",{staticClass:"input-group-append"},[n("span",{staticClass:"btn btn-outline-success",attrs:{title:"Save"},on:{click:function(n){return e.finishEdit(t)}}},[n("i",{staticClass:"fas fa-check"})]),e._v(" "),n("span",{staticClass:"btn btn-outline-danger",attrs:{title:"Cancel"},on:{click:e.cancelEdit}},[n("i",{staticClass:"fas fa-times"})])])])]),e._v(" "),n("menu-items",{staticClass:"item-sub",attrs:{parentMenuItemId:t.id,list:t.menu_items,parentName:e.parentName+"["+t.id+"][menu_items]"}})],1)})),0)}),[],!1,null,"51998932",null).exports;function ue(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function ce(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const pe={name:"menuItemSelect",props:{menuId:{required:!0,type:Number}},beforeMount:function(){this.$store.dispatch("link_types/index")},mounted:function(){$(this.$el).on("hidden.bs.modal",this.reset)},data:function(){return{name:"",link_type:"",link_id:null,link_models:[]}},methods:{loadLinkTypeModels:function(){var e=this;this.$store.dispatch("link_types/show",{link_type:this.link_type}).then((function(t){e.link_models=t})).catch((function(){e.link_models=[]}))},saveMenuItem:function(){var e=this;this.$store.dispatch("menus/addMenuItem",{menu_id:this.menuId,link_type:this.link_type,link_id:this.link_id,name:this.name}).then((function(){$(e.$el).modal("hide")}))},reset:function(){this.name="",this.link_type="",this.link_id=null,this.link_models=[],this.$store.commit("link_types/clearLinkTypeModels")}},computed:function(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?ue(Object(n),!0).forEach((function(t){ce(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):ue(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}({},(0,u.Se)("link_types",["link_types"]))};function me(e,t){var n=Object.keys(e);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(e);t&&(a=a.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),n.push.apply(n,a)}return n}function de(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{};t%2?me(Object(n),!0).forEach((function(t){fe(e,t,n[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(n)):me(Object(n)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(n,t))}))}return e}function fe(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}const be={name:"menuBuilder",components:{MenuItems:le,MenuItemSelect:(0,j.Z)(pe,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"modal",attrs:{tabindex:"-1"}},[n("div",{staticClass:"modal-dialog"},[n("div",{staticClass:"modal-content"},[e._m(0),e._v(" "),n("div",{staticClass:"modal-body"},[n("form",[n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:"name"}},[e._v("Name")]),e._v(" "),n("div",{staticClass:"col-9"},[n("input",{directives:[{name:"model",rawName:"v-model",value:e.name,expression:"name"}],staticClass:"form-control ",attrs:{type:"text",id:"name",name:"name"},domProps:{value:e.name},on:{input:function(t){t.target.composing||(e.name=t.target.value)}}})])]),e._v(" "),n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:"link_type"}},[e._v("Link Type")]),e._v(" "),n("div",{staticClass:"col-9"},[n("select",{directives:[{name:"model",rawName:"v-model",value:e.link_type,expression:"link_type"}],staticClass:"form-control",attrs:{id:"link_type",name:"link_type"},on:{change:[function(t){var n=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.link_type=t.target.multiple?n:n[0]},e.loadLinkTypeModels]}},[n("option",{attrs:{value:"",disabled:"disabled"}},[e._v("Please Select")]),e._v(" "),e._l(e.link_types,(function(t){return n("option",{domProps:{value:t.id}},[e._v(e._s(t.name))])}))],2)])]),e._v(" "),""!==e.link_type?n("div",{staticClass:"form-group row"},[n("label",{staticClass:"col-3 col-form-label",attrs:{for:"link_type"}},[e._v("Link Model")]),e._v(" "),n("div",{staticClass:"col-9"},[n("select",{directives:[{name:"model",rawName:"v-model",value:e.link_id,expression:"link_id"}],staticClass:"form-control",attrs:{id:"link_id",name:"link_id"},on:{change:function(t){var n=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.link_id=t.target.multiple?n:n[0]}}},[n("option",{attrs:{value:"",disabled:"disabled"}},[e._v("Please Select")]),e._v(" "),e._l(e.link_models,(function(t){return n("option",{domProps:{value:t.id}},[e._v(e._s(t.name))])}))],2)])]):e._e()])]),e._v(" "),n("div",{staticClass:"modal-footer"},[n("button",{staticClass:"btn btn-secondary",attrs:{type:"button","data-dismiss":"modal"}},[e._v("Close")]),e._v(" "),n("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:e.saveMenuItem}},[e._v("Save changes")])])])])])}),[function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"modal-header"},[n("h5",{staticClass:"modal-title"},[e._v("Modal title")]),e._v(" "),n("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"}},[n("span",{attrs:{"aria-hidden":"true"}},[e._v("×")])])])}],!1,null,"d411db12",null).exports},props:{menuId:{required:!0,type:Number}},beforeMount:function(){this.$store.dispatch("menus/show",{id:this.menuId})},methods:{openAddMenuItemModal:function(){$(this.$refs.menuItemModal.$el).modal()}},computed:de(de({},(0,u.Se)("menus",["menu"])),{},{menuItems:{get:function(){return this.menu.menu_items},set:function(e){this.$store.dispatch("menus/setMenuItems",e)}}})};const ge=(0,j.Z)(be,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("div",{staticClass:"justify-content-between row"},[n("div",{staticClass:"col-12 mt-4"},[n("span",{staticClass:"btn btn-sm btn-outline-success",on:{click:e.openAddMenuItemModal}},[n("i",{staticClass:"fas fa-plus"})])]),e._v(" "),n("menu-items",{staticClass:"col-12",attrs:{parentName:"menu_items"},model:{value:e.menuItems,callback:function(t){e.menuItems=t},expression:"menuItems"}}),e._v(" "),n("div",{staticClass:"col-12 mt-4"},[n("menu-item-select",{ref:"menuItemModal",attrs:{"menu-id":e.menuId}})],1)],1)}),[],!1,null,"861c6d9a",null).exports;i().defaults.headers.common["X-Requested-With"]="XMLHttpRequest",Object.defineProperty(l.default.prototype,"csrfToken",{get:function(){return document.head.querySelector('meta[name="csrf-token"]').content}}),l.default.use(y()),!1===$("#app").hasClass("no-vue")&&(l.default.component("pageAttributeTemplate",I),l.default.component("pageAttribute",Z),l.default.component("pageForm",U),l.default.component("typeImage",Q),l.default.component("typeModuleSet",H),l.default.component("typeRichText",J),l.default.component("typeString",Y),l.default.component("typeText",te),l.default.component("menuBuilder",ge),new l.default({el:"#app",store:v})),o()},6:(e,t,n)=>{"use strict";n.d(t,{Z:()=>r});var a=n(645),i=n.n(a)()((function(e){return e[1]}));i.push([e.id,".ck.ck-editor__editable{min-height:200px}",""]);const r=i},396:(e,t,n)=>{"use strict";n.d(t,{Z:()=>r});var a=n(645),i=n.n(a)()((function(e){return e[1]}));i.push([e.id,".item-container[data-v-51998932]{max-width:30rem;margin:0}.item[data-v-51998932]{padding:1rem;border:1px solid #000;background-color:#fefefe}.item-sub[data-v-51998932]{margin:0 0 0 1rem}.btn .handle[data-v-51998932]{cursor:move}",""]);const r=i},910:(e,t,n)=>{"use strict";n.d(t,{Z:()=>r});var a=n(645),i=n.n(a)()((function(e){return e[1]}));i.push([e.id,".field-compound[data-v-2caf435c]{padding:7px 0;border:1px solid var(--secondary);border-radius:7px;margin-bottom:7px}.btn .handle[data-v-2caf435c]{cursor:move}",""]);const r=i},839:()=>{}},0,[[415,929,898],[839,929,898]]]);