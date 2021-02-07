<template>
    <draggable
        v-bind="dragOptions"
        tag="div"
        class="item-container"
        :list="list"
        :value="value"
        @input="emitter"
    >
        <div class="item-group" :key="menuItem.id" v-for="menuItem in realValue">
            <div class="item">
                <span class="btn btn-sm btn-link handle"><i class="fas fa-arrows-alt"></i></span>
                {{ menuItem.name }}
                <input type="hidden" :name="parentName + '[' + menuItem.id + '][id]'" :value="menuItem.id">
            </div>
            <menu-items class="item-sub" :list="menuItem.menu_items" :parentName="parentName + '[' + menuItem.id + '][menu_items]'" />
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
    },
    methods: {
        emitter(value) {
            this.$emit("input", value);
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
        }
    },
}
</script>

<style scoped>
    .item-container {
        max-width: 20rem;
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
