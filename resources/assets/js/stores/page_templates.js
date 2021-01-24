import Axios from "axios";

export default {
    namespaced: true,
    state: () => ({
        page_templates: [],
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
        }
    },
    getters: {
        page_templates (state) {
            return state.page_templates;
        }
    }
};
