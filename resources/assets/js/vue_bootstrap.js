import Vue from 'vue';
import Store from './store';
import CKEditor from '@ckeditor/ckeditor5-vue2';
import bootstrapPages from './components/pages/bootstrap';
import bootstrapPageTemplates from './components/page_templates/bootstrap';
import bootstrapMenus from './components/menus/bootstrap';

export default function() {
    Object.defineProperty(Vue.prototype, 'csrfToken', {
        get () {
            return document.head.querySelector('meta[name="csrf-token"]').content;
        }
    })

    Vue.use(CKEditor);

    if ($('#app').hasClass('no-vue') === false) {
        bootstrapPages();
        bootstrapPageTemplates();
        bootstrapMenus();

        new Vue({
            el: '#app',
            store: Store,
        });
    }
};
