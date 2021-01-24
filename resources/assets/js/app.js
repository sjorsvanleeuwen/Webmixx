import Axios from 'axios';

Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Vue from "vue";
import bootstrap from "./components/pages/bootstrap";

Object.defineProperty(Vue.prototype, 'csrfToken', {
    get () {
        return document.head.querySelector('meta[name="csrf-token"]').content;
    }
})

import Store from './store';

import pageForm from './components/pages/page-form';
if ($('#app').hasClass('no-vue') === false) {
    new Vue({
        el: '#app',
        store: Store,
        components: {
            pageForm,
        }
    });

    bootstrap();
}
