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
            <div class="item" :class="[isEditing(menuItem.id) ? 'd-none' : 'd-flex']">
                <span class="btn btn-link handle" title="Move"><i class="fas fa-arrows-alt"></i></span>
                <input type="text" readonly class="form-control-plaintext" :value="menuItem.name">
                <input type="hidden" :name="parentName + '[' + menuItem.id + '][id]'" :value="menuItem.id">
                <div class="d-inline-block ml-auto">
                    <div class="btn-group" role="group">
                        <span v-if="menuItem.actions.update" class="btn btn-outline-success" @click="startEdit(menuItem)" title="Edit"><i class="fas fa-pencil-alt"></i></span>
                        <span v-if="menuItem.actions.delete" class="btn btn-outline-danger" @click="deleteMenuItem(menuItem)" title="Delete"><i class="fas fa-trash-alt"></i></span>
                    </div>
                </div>
            </div>
            <div class="item" :class="[isEditing(menuItem.id) ? 'd-flex' : 'd-none']">
                <div class="input-group">
                    <input type="text" class="form-control" :value="editing.value" @input="change($event)">
                    <div class="input-group-append">
                        <span class="btn btn-outline-success" @click="finishEdit(menuItem)" title="Save"><i class="fas fa-check"></i></span>
                        <span class="btn btn-outline-danger" @click="cancelEdit" title="Cancel"><i class="fas fa-times"></i></span>
                    </div>
                </div>
            </div>
            <menu-items class="item-sub" :parentMenuItemId="menuItem.id" :list="menuItem.menu_items" :parentName="parentName + '[' + menuItem.id + '][menu_items]'" />
        </div>
    </draggable>
</template>

<script>
import draggable from 'vuedraggable';
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

    data() {
        return {
            editing: {
                id: null,
                value: null,
            },
        };
    },

    methods: {
        startEdit(menu_item) {
            this.editing.id = menu_item.id;
            this.editing.value = menu_item.name;
        },
        isEditing(menu_item_id) {
            return this.editing.id === menu_item_id;
        },
        change(event) {
            this.editing.value = event.target.value;
        },
        emitter(value) {
            this.$emit("input", value);
        },
        finishEdit(menuItem) {
            menuItem.name = this.editing.value;
            this.$store.dispatch('menus/updateMenuItem', {
                menuItem: menuItem,
                order: menuItem.order,
                to_menu_item_id: this.parentMenuItemId,
            }).then(() => {
                this.editing.id = null;
                this.editing.value = null;
            });
        },
        cancelEdit()
        {
            this.editing.id = null;
            this.editing.value = null;
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
    .btn.handle {
        cursor: move;
    }
</style>
