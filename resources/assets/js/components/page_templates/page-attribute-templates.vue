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
        <div class="item-group" v-for="pageAttributeTemplate in realValue" :key="pageAttributeTemplate.id">
            <div class="item border p-3" :class="[isEditing(pageAttributeTemplate.id) ? 'd-none' : 'd-flex']">
                <span class="btn btn-link handle" title="Move"><i class="fas fa-arrows-alt"></i></span>
                <span class="form-control-plaintext" v-text="pageAttributeTemplate.name + ' (' + pageAttributeTemplate.field_type + ')'"></span>
                <div class="d-inline-block ml-auto">
                    <div class="btn-group" role="group">
                        <span v-if="pageAttributeTemplate.actions.update" class="btn btn-outline-success" @click="startEdit(pageAttributeTemplate)" title="Edit"><i class="fas fa-pencil-alt"></i></span>
                        <span v-if="pageAttributeTemplate.actions.delete" class="btn btn-outline-danger" @click="deletePageAttributeTemplate(pageAttributeTemplate)" title="Delete"><i class="fas fa-trash-alt"></i></span>
                    </div>
                </div>
            </div>
            <div class="item border p-3" :class="[isEditing(pageAttributeTemplate.id) ? 'd-flex' : 'd-none']">
                <div class="input-group">
                    <input type="text" class="form-control" :value="editing.value" @input="change($event)">
                    <div class="input-group-append">
                        <span class="btn btn-outline-success" @click="finishEdit(pageAttributeTemplate)" title="Save"><i class="fas fa-check"></i></span>
                        <span class="btn btn-outline-danger" @click="cancelEdit" title="Cancel"><i class="fas fa-times"></i></span>
                    </div>
                </div>
            </div>
            <vue-webmixx-page-attribute-templates class="item-sub ms-3" :parent-page-attribute-template-id="pageAttributeTemplate.id" :list="pageAttributeTemplate.page_attribute_templates" />
        </div>
    </draggable>
</template>

<script>
import draggable from "vuedraggable";
import {mapGetters} from "vuex";

export default {
    name: 'vue-webmixx-page-attribute-templates',

    components: {
        draggable,
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
        parentPageAttributeTemplateId: {
            required: false,
            type: Number,
            default: null,
        },
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
        emitter(value) {
            this.$emit('input', value);
        },
        log(value) {
            if (value.hasOwnProperty('added')) {
                this.$store.dispatch('page_templates/updatePageAttributeTemplate', {
                    pageAttributeTemplate: value.added.element,
                    order: value.added.newIndex,
                    to_page_attribute_template_id: this.parentPageAttributeTemplateId,
                });
            } else if (value.hasOwnProperty('moved')) {
                this.$store.dispatch('page_templates/updatePageAttributeTemplate', {
                    pageAttributeTemplate: value.moved.element,
                    order: value.moved.newIndex,
                    to_page_attribute_template_id: this.parentPageAttributeTemplateId,
                });
            }
        },
        startEdit(item) {
            this.editing.id = item.id;
            this.editing.value = item.name;
        },
        isEditing(item_id) {
            return this.editing.id === item_id;
        },
        change(event) {
            this.editing.value = event.target.value;
        },
        finishEdit(pageAttributeTemplate) {
            pageAttributeTemplate.name = this.editing.value;
            this.$store.dispatch('page_templates/updatePageAttributeTemplate', {
                pageAttributeTemplate: pageAttributeTemplate,
                order: pageAttributeTemplate.order,
                to_page_attribute_template_id: this.parentPageAttributeTemplateId,
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
        deletePageAttributeTemplate(pageAttributeTemplate) {
            this.$store.dispatch('page_templates/deletePageAttributeTemplate', pageAttributeTemplate);
        },
    },

    computed: {
        ...mapGetters('page_templates', [
            'page_template',
        ]),
        dragOptions() {
            return {
                animation: 0,
                group: 'description',
                disabled: false,
                ghostClass: 'ghost'
            };
        },
        realValue() {
            return this.value ? this.value : this.list;
        },
    },
}
</script>

<style scoped>
    .btn.handle {
        cursor: move;
    }
</style>
