<template>
    <div class="justify-content-between row">
        <menu-items class="col-12" v-model="menuItems" parentName="menu_items"/>
        <div class="col-12 mt-4">
            <span @click="openAddMenuItemModal" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i></span>
            <menu-item-select :menu-id="menuId" ref="menuItemModal"/>
        </div>
    </div>
</template>

<script>
import MenuItems from './menu-items';
import MenuItemSelect from './menu-item-select';
import {mapGetters} from "vuex";
import _ from "lodash";

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
            $(this.$refs.menuItemModal.$el).modal();
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
                this.$store.dispatch("menus/updateMenuItems", values);
            }
        },
    },
}
</script>

<style scoped>

</style>
