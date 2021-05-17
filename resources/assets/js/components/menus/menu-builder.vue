<template>
    <div class="justify-content-between row">
        <h1 class="d-flex justify-content-between align-items-center" v-cloak>
            Menu "{{ menu.name }}"
            <div class="text-end">
                <span @click="openAddMenuItemModal" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i></span>
                <a href="/webmixx/menu" class="btn btn-sm btn-outline-primary"><i class="fas fa-reply"></i></a>
            </div>
        </h1>
        <menu-items class="col-12" v-model="menuItems" parentName="menu_items"/>
        <menu-item-select :menu-id="menuId" ref="menuItemModal"/>
    </div>
</template>

<script>
import MenuItems from './menu-items';
import MenuItemSelect from './menu-item-select';
import {Modal} from 'bootstrap';
import {mapGetters} from "vuex";

export default {
    name: "menuBuilder",

    components: {
        MenuItems,
        MenuItemSelect,
    },

    props: {
        menuId: {
            required: true,
            type: Number,
        }
    },

    beforeMount() {
        this.$store.dispatch('menus/show', {id: this.menuId});
    },

    methods: {
        openAddMenuItemModal() {
            let modal = new Modal(this.$refs.menuItemModal.$el);
            modal.show();
        }
    },

    computed: {
        ...mapGetters('menus', [
            'menu',
        ]),
        menuItems: {
            get() {
                return this.menu.menu_items;
            },
            set(values) {
                this.$store.dispatch("menus/setMenuItems", values);
            }
        },
    },
}
</script>

<style scoped>

</style>
