import Axios from 'axios';

export default {
    namespaced: true,
    state: () => ({
        link_types: [],
        link_type_models: {},
    }),
    actions: {
        index ({commit}) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/link_types')
                    .then((response) => {
                        commit('load', response.data.data);
                        resolve(response.data.data);
                    });
            });
        },
        show ({commit}, payload) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/link_types/' + payload.link_type)
                    .then((response) => {
                        commit('setLinkTypeModel', {
                            link_type: payload.link_type,
                            models: response.data.data,
                        });
                        resolve(response.data.data);
                    });
            });
        },
    },
    mutations: {
        load (state, link_types) {
            state.link_types = link_types;
        },
        setLinkTypeModel (state, payload) {
            state.link_type_models[payload.link_type] = payload.models;
        },
        clearLinkTypeModels (state) {
            state.link_type_models = {};
        }
    },
    getters: {
        link_types (state) {
            return state.link_types;
        },
    },
};
