<template>
    <draggable
        v-bind="dragOptions"
        tag="div"
        class="item-container"
        :list="list"
        :value="value"
        @input="emitter"
        @change="log"
    >
        <div class="item-group" :key="menuItem.id" v-for="menuItem in realValue">
            <div class="item d-flex">
                <span class="btn btn-sm btn-link handle"><i class="fas fa-arrows-alt"></i></span>
                {{ menuItem.name }}
                <input type="hidden" :name="parentName + '[' + menuItem.id + '][id]'" :value="menuItem.id">
                <div class="d-inline-block ml-auto">
                    <span v-if="menuItem.actions.delete" class="btn btn-sm btn-outline-danger" @click="deleteMenuItem(menuItem)"><i class="fas fa-trash-alt"></i></span>
                </div>
            </div>
            <menu-items class="item-sub" :parentMenuItemId="menuItem.id" :list="menuItem.menu_items" :parentName="parentName + '[' + menuItem.id + '][menu_items]'" />
        </div>
    </draggable>
</template>

<script>
import draggable from 'vuedraggable';
import _ from "lodash";
import {mapGetters} from "vuex";

export default {
    name: "menuItems",
    components: {
        draggable
    },
    props: {
        value: {
            required: false,
            type: Array,
            default: null
        },
        list: {
            required: false,
            type: Array,
            default: null
        },
        parentName: {
            required: true,
            type: String,
        },
        parentMenuItemId: {
            required: false,
            type: Number,
            default: null,
        }
    },
    methods: {
        emitter(value) {
            this.$emit("input", value);
        },
        log(value) {
            if (value.hasOwnProperty('added')) {
                this.$store.dispatch('menus/updateMenuItem', {
                    menuItem: value.added.element,
                    order: value.added.newIndex,
                    to_menu_item_id: this.parentMenuItemId,
                });
            } else if (value.hasOwnProperty('moved')) {
                this.$store.dispatch('menus/updateMenuItem', {
                    menuItem: value.moved.element,
                    order: value.moved.newIndex,
                    to_menu_item_id: this.parentMenuItemId,
                });
            }
        },
        deleteMenuItem(menuItem) {
            this.$store.dispatch('menus/deleteMenuItem', menuItem);
        },
    },
    computed: {
        ...mapGetters('menus', [
            'menu',
        ]),
        dragOptions() {
            return {
                animation: 0,
                group: "description",
                disabled: false,
                ghostClass: "ghost"
            };
        },
        realValue() {
            return this.value ? this.value : this.list;
        },
    },
}
</script>

<style scoped>
    .item-container {
        max-width: 30rem;
        margin: 0;
    }
    .item {
        padding: 1rem;
        border: solid black 1px;
        background-color: #fefefe;
    }
    .item-sub {
        margin: 0 0 0 1rem;
    }
    .btn .handle {
        cursor: move;
    }
</style>
