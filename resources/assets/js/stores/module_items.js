import Axios from 'axios';

export default {
    namespaced: true,

    state: () => ({
        module_items: {},
    }),

    actions: {
        show ({ commit }, payload) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/module_item/' + payload.page_attribute_template_id)
                    .then((response) => {
                        commit('setModuleItems', {
                            page_attribute_template_id: payload.page_attribute_template_id,
                            data: response.data.data,
                        });
                        resolve(response.data.data);
                    });
            });
        },
    },

    mutations: {
        setModuleItems (state, payload) {
            state.module_items[payload.page_attribute_template_id] = payload.data;
        },
    },

    getters: {
        module_items (state) {
            return state.module_items;
        },
    },
};
