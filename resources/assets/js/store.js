import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

import fieldTypeStore from './stores/field_types';
import linkTypeStore from './stores/link_types';
import menuStore from './stores/menus';
import moduleItemStore from './stores/module_items';
import pageTemplateStore from './stores/page_templates';
import pageStore from './stores/pages';

export default new Vuex.Store({
    modules: {
        field_types: fieldTypeStore,
        link_types: linkTypeStore,
        menus: menuStore,
        module_items: moduleItemStore,
        page_templates: pageTemplateStore,
        pages: pageStore,
    }
});
