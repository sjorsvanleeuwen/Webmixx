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

const removeDeep = function(menuItems, deleteMenuItem) {
    _.each(menuItems, (menuItem) => {
        if (menuItem.id === deleteMenuItem.menu_item_id) {
            _.remove(menuItem.menu_items, {'id': deleteMenuItem.id});
        } else if (menuItem.menu_items.length > 0) {
            removeDeep(menuItem.menu_items, deleteMenuItem);
        }
    });
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
        setMenuItems({ commit }, payload) {
            commit('setMenuItems', payload);
        },
        addMenuItem({ commit }, payload) {
            return new Promise((resolve, reject) => {
                Axios.post('/webmixx/api/menu/' + payload.menu_id + '/menu_item', payload)
                    .then((response) => {
                        commit('addMenuItem', response.data.data);
                        resolve();
                    });
            });
        },
        updateMenuItem({ commit }, payload) {
            return new Promise((resolve, reject) => {
                Axios.put('/webmixx/api/menu/' + payload.menuItem.menu_id + '/menu_item/' + payload.menuItem.id, {
                    name: payload.menuItem.name,
                    order: payload.order,
                    menu_item_id: payload.to_menu_item_id,
                })
                    .then((response) => {
                        commit('setMenuItems', mapMenuItems(response.data.data, null));
                        resolve();
                    });
            });
        },
        deleteMenuItem({commit}, payload) {
            return new Promise((resolve, reject) => {
                Axios.delete('/webmixx/api/menu/' + payload.menu_id + '/menu_item/' + payload.id)
                    .then((response) => {
                        commit('removeMenuItem', payload);
                        commit('setMenuItems', mapMenuItems(response.data.data, null));
                        resolve();
                    });
            });
        },
    },
    mutations: {
        set (state, menu) {
            menu.menu_items_all = menu.menu_items;
            menu.menu_items = mapMenuItems(menu.menu_items, null);
            state.menu = menu;
        },
        setMenuItems: (state, menuItems) => {
            state.menu.menu_items = menuItems;
        },
        addMenuItem(state, menuItem) {
            state.menu.menu_items.push(menuItem);
        },
        removeMenuItem: (state, menuItem) => {
            let menu_items = _.cloneDeep(state.menu.menu_items);
            if (menuItem.menu_item_id === null) {
                _.remove(menu_items, {'id': menuItem.id});
            } else {
                removeDeep(menu_items, menuItem);
            }
            state.menu.menu_items = menu_items;
            state.menu.menu_items_all.splice(_.findIndex(state.menu.menu_items_all, {
                id: menuItem.id
            }), 1);
        },
    },
    getters: {
        menu (state) {
            return state.menu;
        }
    },
};
