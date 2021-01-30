import PageAttributeTemplate from './page-attribute-template';
import PageAttribute from './page-attribute';
import PageForm from './page-form';

import TypeString from '../field_types/type-string';
import TypeRichText from '../field_types/type-rich-text';

import Vue from 'vue';


export default () => {
    Vue.component('pageAttributeTemplate', PageAttributeTemplate);
    Vue.component('pageAttribute', PageAttribute);
    Vue.component('pageForm', PageForm);
    Vue.component('typeString', TypeString);
    Vue.component('typeRichText', TypeRichText);
}
