import Axios from "axios";
export default {
    namespaced: true,
    state: () => ({
        pages: [],
        page: {},
    }),
    actions: {
        show ({commit}, payload) {
            return Axios.get('/webmixx/api/page/' + payload.id)
                .then((response) => {
                    commit('set', response.data.data);
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
