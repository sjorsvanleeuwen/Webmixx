import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import pageTemplateStore from './stores/page_templates';
import pageStore from './stores/pages';

export default new Vuex.Store({
    modules: {
        page_templates: pageTemplateStore,
        pages: pageStore,
    }
});
