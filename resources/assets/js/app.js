import Axios from 'axios';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from "vue";
import bootstrapPages from "./components/pages/bootstrap";
window.Vue = Vue;

Object.defineProperty(Vue.prototype, 'csrfToken', {
    get () {
        return document.head.querySelector('meta[name="csrf-token"]').content;
    }
})

import Store from './store';

if ($('#app').hasClass('no-vue') === false) {
    bootstrapPages();

    new Vue({
        el: '#app',
        store: Store,
    });
}
