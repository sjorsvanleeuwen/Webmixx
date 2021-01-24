<template>
    <div :class="'field-' + pageAttributeTemplate.field_type" :data-bound-by="'attributeTemplate' + pageAttributeTemplate.id">
        <i v-if="pageAttributeTemplate.repeatable" class="fas fa-align-justify handle"></i>
        <page-attribute-template v-if="childPageAttributeTemplates.length > 0" v-for="childPageAttributeTemplate in childPageAttributeTemplates" v-bind:key="childPageAttributeTemplate.id" :page-template="pageTemplate" :page-attribute-template="childPageAttributeTemplate" :page-attribute="pageAttribute" :base-name="fieldName"/>
        <typeText v-if="childPageAttributeTemplates.length === 0" :name="fieldName" :label="pageAttributeTemplate.name" :value="pageAttribute.value"/>
        <div v-if="pageAttributeTemplate.repeatable" class="form-group text-right">
            <span class="btn btn-sm btn-danger" @click="removePageAttribute">Delete</span>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';
import typeText from "../field_types/type-text";
import {mapGetters} from "vuex";

export default {
    name: "pageAttribute",
    components: {
        typeText,
    },
    props: {
        pageAttributeTemplate: {
            required: true,
            type: Object,
        },
        pageTemplate: {
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
        hasChildPageAttributeTemplates() {
            return this.pageAttributeTemplate.field_type === 'compound';
        },
        childPageAttributeTemplates() {
            return _.filter(this.pageTemplate.page_attribute_templates, {
                page_attribute_template_id: this.pageAttributeTemplate.id,
            });
        },
        fieldName() {
            if (this.pageAttributeTemplate.repeatable) {
                return this.baseName + '[' + this.pageAttributeTemplate.id + '][U' + this._uid + ']';
            }
            return this.baseName + '[' + this.pageAttributeTemplate.id + ']';
        }
    },
}
</script>

<style scoped>
    .field-compound {
        padding: 7px;
        border: 1px solid var(--secondary);
        border-radius: 7px;
        margin-bottom: 7px;
    }
    .handle {
        padding-top: 8px;
        padding-bottom: 8px;
        cursor: move;
    }
</style>
