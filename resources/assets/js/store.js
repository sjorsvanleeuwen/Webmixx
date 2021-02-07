import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import linkTypeStore from './stores/link_types';
import menuStore from './stores/menus';
import pageTemplateStore from './stores/page_templates';
import pageStore from './stores/pages';

export default new Vuex.Store({
    modules: {
        link_types: linkTypeStore,
        menus: menuStore,
        page_templates: pageTemplateStore,
        pages: pageStore,
    }
});
