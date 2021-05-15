import Axios from 'axios';
import _ from 'lodash';

const mapPageAttributeTemplates = function (pageAttributeTemplates, parentAttributeTemplateId) {
    let page_attribute_templates = _.filter(pageAttributeTemplates, {
        page_attribute_template_id: parentAttributeTemplateId,
    });

    _.each(page_attribute_templates, (page_attribute_template) => {
        page_attribute_template.page_attribute_templates = mapPageAttributeTemplates(pageAttributeTemplates, page_attribute_template.id);
    });

    return page_attribute_templates;
};

const removeDeep = function(pageAttributeTemplates, deletePageAttributeTemplate) {


    _.each(pageAttributeTemplates, (pageAttributeTemplate) => {
        if (pageAttributeTemplate.id === deletePageAttributeTemplate.page_attribute_template_id) {
            _.remove(pageAttributeTemplate.page_attribute_templates, {'id': deletePageAttributeTemplate.id});
        } else if (pageAttributeTemplate.page_attribute_templates.length > 0) {
            removeDeep(pageAttributeTemplate.page_attribute_templates, deletePageAttributeTemplate);
        }
    });
};

export default {
    namespaced: true,
    state: () => ({
        page_templates: [],
        page_template: {
            name: null,
            field_type: null,
            repeatable: false,
            page_attribute_templates: [],
        },
    }),
    actions: {
        index ({commit}) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/page_template')
                    .then((response) => {
                        commit('load', response.data.data);
                        resolve(response.data.data);
                    });
            });
        },
        show({commit}, payload) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/page_template/' + payload.id)
                    .then((response) => {
                        commit('set', response.data.data);
                        resolve(response.data.data);
                    });
            });
        },
        setPageAttributeTemplates({ commit }, payload) {
            commit('setPageAttributeTemplates', payload);
        },
        addPageAttributeTemplate({ commit }, payload) {
            return new Promise((resolve, reject) => {
                Axios.post('/webmixx/api/page_template/' + payload.page_template_id + '/page_attribute_template', payload)
                    .then((response) => {
                        commit('addPageAttributeTemplate', response.data.data);
                        resolve();
                    });
            });
        },
        updatePageAttributeTemplate({ commit }, payload) {
            return new Promise((resolve, reject) => {
                Axios.put('/webmixx/api/page_template/' + payload.pageAttributeTemplate.page_template_id + '/page_attribute_template/' + payload.pageAttributeTemplate.id, {
                    name: payload.pageAttributeTemplate.name,
                    order: payload.order,
                    page_attribute_template_id: payload.to_page_attribute_template_id,
                })
                    .then((response) => {
                        commit('setPageAttributeTemplates', mapPageAttributeTemplates(response.data.data, null));
                        resolve();
                    });
            });
        },
        deletePageAttributeTemplate({commit}, payload) {
            return new Promise((resolve, reject) => {
                Axios.delete('/webmixx/api/page_template/' + payload.page_template_id + '/page_attribute_template/' + payload.id)
                    .then((response) => {
                        commit('removePageAttributeTemplate', payload);
                        commit('setPageAttributeTemplates', mapPageAttributeTemplates(response.data.data, null));
                        resolve();
                    })
            })
        },
    },
    mutations: {
        load (state, page_templates) {
            state.page_templates = page_templates;
        },
        set (state, pageTemplate) {
            pageTemplate.page_attribute_templates = mapPageAttributeTemplates(pageTemplate.page_attribute_templates, null);
            state.page_template = pageTemplate;
        },
        setPageAttributeTemplates: (state, pageAttributeTemplates) => {
            state.page_template.page_attribute_templates = pageAttributeTemplates;
        },
        addPageAttributeTemplate: (state, pageAttributeTemplate) => {
            state.page_template.page_attribute_templates.push(pageAttributeTemplate);
        },
        removePageAttributeTemplate: (state, pageAttributeTemplate) => {
            let page_attribute_templates = _.cloneDeep(state.page_template.page_attribute_templates);
            if (pageAttributeTemplate.page_attribute_template_id === null) {
                _.remove(page_attribute_templates, {'id': pageAttributeTemplate.id});
            } else {
                removeDeep(page_attribute_templates, pageAttributeTemplate);
            }
            state.page_template.page_attribute_templates = page_attribute_templates;
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
