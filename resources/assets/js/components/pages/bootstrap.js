import PageAttributeTemplate from './page-attribute-template';
import PageAttribute from './page-attribute';
import PageForm from './page-form';
import Vue from 'vue';

export default function() {
    Vue.component('pageAttributeTemplate', PageAttributeTemplate);
    Vue.component('pageAttribute', PageAttribute);
    Vue.component('pageForm', PageForm);
}
