import Axios from "axios";
import _ from 'lodash';

const mapMenuItems = function(menuItems, parentMenuItemId) {
    let menu_items = _.filter(menuItems, {
        menu_item_id: parentMenuItemId,
    });
    _.each(menu_items, (menuItem) => {
        menuItem.menu_items = mapMenuItems(menuItems, menuItem.id);
    });

    return menu_items;
};

export default {
    namespaced: true,
    state: () => ({
        menu: {},
        menus: [],
    }),
    actions: {
        show({commit}, payload) {
            return new Promise((resolve, reject) => {
                Axios.get('/webmixx/api/menu/' + payload.id)
                    .then((response) => {
                        commit('set', response.data.data);
                        resolve(response.data.data);
                    });
            });
        },
        updateMenuItems({ commit }, payload) {
            commit('updateMenuItems', payload);
        },
        addMenuItem({ commit }, payload) {
            return new Promise((resolve, reject) => {
                Axios.post('/webmixx/api/menu/' + payload.menu_id + '/menu_item', payload)
                    .then((response) => {
                        commit('addMenuItem', response.data.data);
                        resolve(response.data.data);
                    });
            });
        },
    },
    mutations: {
        set (state, menu) {
            menu.menu_items = mapMenuItems(menu.menu_items, null);
            state.menu = menu;
        },
        addMenuItem(state, menuItem) {
            state.menu.menu_items.push(menuItem);
        },
        updateMenuItems: (state, menuItems) => {
            state.menu.menu_items = menuItems;
        },
    },
    getters: {
        menu (state) {
            return state.menu;
        }
    },
};
