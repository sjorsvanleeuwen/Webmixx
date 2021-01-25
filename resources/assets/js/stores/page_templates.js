import Axios from "axios";

export default {
    namespaced: true,
    state: () => ({
        page_templates: [],
        page_template: {},
    }),
    actions: {
        index ({commit}) {
            return Axios.get('/webmixx/api/page_templates')
                .then((response) => {
                    commit('load', response.data.data);
                })
        }
    },
    mutations: {
        load (state, page_templates) {
            state.page_templates = page_templates;
        },
        set (state, pageTemplate) {
            state.page_template = pageTemplate;
        },
    },
    getters: {
        page_templates (state) {
            return state.page_templates;
        },
        page_template (state) {
            return state.page_template;
        }
    }
};
