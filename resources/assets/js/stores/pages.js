import Axios from "axios";
export default {
    namespaced: true,
    state: () => ({
        pages: [],
        page: {
            page_template_id: null,
            page_attributes: [],
        },
    }),
    actions: {
        show ({commit}, payload) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/page/' + payload.id)
                    .then((response) => {
                        commit('set', response.data.data);
                        resolve(response.data.data);
                    });
            });
        },
    },
    mutations: {
        set (state, page) {
            state.page = page;
        }
    },
    getters: {
        page (state) {
            return state.page;
        }
    }
};
