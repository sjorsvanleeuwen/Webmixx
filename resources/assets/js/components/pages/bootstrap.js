import PageAttributeTemplate from './page-attribute-template';
import PageAttribute from './page-attribute';
import PageForm from './page-form';

import Vue from 'vue';

export default () => {
    Vue.component('vue-page-attribute-template', PageAttributeTemplate);
    Vue.component('vue-page-attribute', PageAttribute);
    Vue.component('vue-page-form', PageForm);
};
