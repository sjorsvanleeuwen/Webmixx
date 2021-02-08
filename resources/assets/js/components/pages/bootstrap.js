import PageAttributeTemplate from './page-attribute-template';
import PageAttribute from './page-attribute';
import PageForm from './page-form';

import TypeImage from '../field_types/type-image';
import TypeRichText from '../field_types/type-rich-text';
import TypeString from '../field_types/type-string';
import TypeText from '../field_types/type-text';

import Vue from 'vue';


export default () => {
    Vue.component('pageAttributeTemplate', PageAttributeTemplate);
    Vue.component('pageAttribute', PageAttribute);
    Vue.component('pageForm', PageForm);
    Vue.component('typeImage', TypeImage);
    Vue.component('typeRichText', TypeRichText);
    Vue.component('typeString', TypeString);
    Vue.component('typeText', TypeText);
}
