import PageTemplateForm from './page-template-form';
import PageAttributeTemplates from './page-attribute-templates';

import Vue from 'vue';

export default () => {
    Vue.component('vue-webmixx-page-attribute-templates', PageAttributeTemplates);
    Vue.component('vue-webmixx-page-template-form', PageTemplateForm);
};
