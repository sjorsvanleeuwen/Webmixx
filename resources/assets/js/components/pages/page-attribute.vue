<template>
    <div :class="'row field-' + pageAttributeTemplate.field_type" :data-bound-by="'attributeTemplate' + pageAttributeTemplate.id">
        <div class="col">
            <page-attribute-template v-if="childPageAttributeTemplates.length > 0" v-for="childPageAttributeTemplate in childPageAttributeTemplates" v-bind:key="childPageAttributeTemplate.id" :page-attribute-template="childPageAttributeTemplate" :page-attribute="pageAttribute" :base-name="fieldName"/>
            <component v-bind:is="fieldTypeComponent" v-if="childPageAttributeTemplates.length === 0" :name="fieldName" :label="pageAttributeTemplate.name" :value="pageAttribute.value" />
        </div>
        <div v-if="pageAttributeTemplate.repeatable" class="col-auto text-right">
            <span class="btn btn-sm btn-link handle"><i class="fas fa-arrows-alt"></i></span>
            <span class="btn btn-sm btn-outline-danger" @click="removePageAttribute"><i class="fas fa-trash-alt"></i></span>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';
import {mapGetters} from "vuex";

export default {
    name: "pageAttribute",

    props: {
        pageAttributeTemplate: {
            required: true,
            type: Object,
        },
        pageAttribute: {
            required: false,
            type: Object,
            default: function () {
                return {
                    id: null,
                    page_attribute_template_id: this.pageAttributeTemplate.id,
                };
            },
        },
        baseName: {
            required: true,
            type: String,
        }
    },

    methods: {
        removePageAttribute() {
            let index = this.page.page_attributes.indexOf(this.pageAttribute);
            this.page.page_attributes.splice(index, 1);
        },
    },

    computed: {
        ...mapGetters('pages', [
            'page',
        ]),
        ...mapGetters('page_templates', [
            'page_template',
        ]),
        hasChildPageAttributeTemplates() {
            return this.pageAttributeTemplate.field_type === 'compound';
        },
        childPageAttributeTemplates() {
            return _.orderBy(_.filter(this.page_template.page_attribute_templates, {
                page_attribute_template_id: this.pageAttributeTemplate.id,
            }), 'order');
        },
        fieldName() {
            if (this.pageAttributeTemplate.repeatable) {
                return this.baseName + '[' + this.pageAttributeTemplate.id + '][U' + this._uid + ']';
            }
            return this.baseName + '[' + this.pageAttributeTemplate.id + ']';
        },
        fieldTypeComponent() {
            return 'type' + _.replace(_.startCase(this.pageAttributeTemplate.field_type), ' ', '');
        }
    },
}
</script>

<style scoped>
    .field-compound {
        padding: 7px 0px;
        border: 1px solid var(--secondary);
        border-radius: 7px;
        margin-bottom: 7px;
    }
    .btn .handle {
        cursor: move;
    }
</style>
