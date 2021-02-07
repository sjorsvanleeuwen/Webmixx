import Axios from 'axios';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from "vue";
Object.defineProperty(Vue.prototype, 'csrfToken', {
    get () {
        return document.head.querySelector('meta[name="csrf-token"]').content;
    }
})

import Store from './store';

import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use(CKEditor);

import bootstrapPages from "./components/pages/bootstrap";
import bootstrapMenus from "./components/menus/bootstrap";

if ($('#app').hasClass('no-vue') === false) {
    bootstrapPages();
    bootstrapMenus();

    new Vue({
        el: '#app',
        store: Store,
    });
}
