import PageAttributeTemplate from './page-attribute-template';
import PageAttribute from './page-attribute';
import PageForm from './page-form';

import Vue from 'vue';

export default () => {
    Vue.component('vue-webmixx-pages-attribute-template', PageAttributeTemplate);
    Vue.component('vue-webmixx-pages-attribute', PageAttribute);
    Vue.component('vue-webmixx-pages-form', PageForm);
};
