import Axios from 'axios';

export default {
    namespaced: true,
    state: () => ({
        field_types: [],
        data_providers: {},
    }),
    actions: {
        index ({ commit }) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/field_types')
                    .then((response) => {
                        commit('load', response.data.data);
                        resolve(response.data.data);
                    });
            });
        },
        show ({ commit }, payload) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/field_types/' + payload.field_type)
                    .then((response) => {
                        commit('setFieldTypeDataProviders', {
                            field_type: payload.field_type,
                            data_providers: response.data.data,
                        });
                        resolve(response.data.data);
                    });
            });
        },
    },
    mutations: {
        load (state, field_types) {
            state.field_types = field_types;
        },
        setFieldTypeDataProviders (state, payload) {
            state.data_providers[payload.field_type] = payload.data_providers;
        },
        clearFieldTypeDataProviders (state) {
            state.data_providers = {};
        }
    },
    getters: {
        field_types (state) {
            return state.field_types;
        }
    }
};
