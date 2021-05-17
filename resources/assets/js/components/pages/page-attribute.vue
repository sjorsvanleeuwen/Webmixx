<template>
    <div class="row g-3" :class="classObject">
        <div class="col">
            <vue-page-attribute-template v-if="childPageAttributeTemplates.length > 0" v-for="childPageAttributeTemplate in childPageAttributeTemplates" v-bind:key="childPageAttributeTemplate.id" :page-attribute-template="childPageAttributeTemplate" :page-attribute="pageAttribute" :base-name="fieldName"/>
            <component v-bind:is="fieldTypeComponent" v-if="childPageAttributeTemplates.length === 0" :name="fieldName" :label="pageAttributeTemplate.name" :value="pageAttribute.value" :page-attribute-template="pageAttributeTemplate" />
        </div>
        <div v-if="pageAttributeTemplate.repeatable" class="col-auto text-end">
            <span class="btn btn-sm btn-link handle"><i class="fas fa-arrows-alt"></i></span>
            <span class="btn btn-sm btn-outline-danger" @click="removePageAttribute"><i class="fas fa-trash-alt"></i></span>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';
import {mapGetters} from 'vuex';

import TypeImage from '../field_types/type-image';
import TypeModuleItem from '../field_types/type-module-item';
import TypeModuleSet from '../field_types/type-module-set';
import TypeRichText from '../field_types/type-rich-text';
import TypeString from '../field_types/type-string';
import TypeText from '../field_types/type-text';

export default {
    components: {
        'vue-type-image': TypeImage,
        'vue-type-module-item': TypeModuleItem,
        'vue-type-module-set': TypeModuleSet,
        'vue-type-rich-text': TypeRichText,
        'vue-type-string': TypeString,
        'vue-type-text': TypeText,
    },
    name: 'vue-page-attribute',

    props: {
        pageAttributeTemplate: {
            required: true,
            type: Object,
        },
        pageAttribute: {
            required: true,
            type: Object,
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
            return this.pageAttributeTemplate.page_attribute_templates;
        },
        fieldName() {
            if (this.pageAttributeTemplate.repeatable) {
                return this.baseName + '[' + this.pageAttributeTemplate.id + '][U' + this._uid + ']';
            }
            return this.baseName + '[' + this.pageAttributeTemplate.id + ']';
        },
        fieldTypeComponent() {
            return 'vue-type-' + _.replace(this.pageAttributeTemplate.field_type, '_', '-');
        },
        classObject() {
            let classes = {
                'mb-3': this.pageAttributeTemplate.repeatable === false || this.pageAttribute.order === 0,
                'my-3': this.pageAttributeTemplate.repeatable === true && this.pageAttribute.order > 0,
                border: this.pageAttributeTemplate.field_type === 'compound',
                rounded: this.pageAttributeTemplate.field_type === 'compound',
            };
            classes['field-' + _.replace(this.pageAttributeTemplate.field_type, '_', '-')] = true;
            return classes;
        }
    },
}
</script>

<style scoped>
    .field-compound {
        padding: 7px 0;
    }
    .btn.handle {
        cursor: move;
    }
</style>
