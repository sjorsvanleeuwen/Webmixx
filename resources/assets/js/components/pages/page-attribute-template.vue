<template>
    <div :id="'attributeTemplate' + pageAttributeTemplate.id" :class="{ repeatable: pageAttributeTemplate.repeatable }">
        <div class="row g-3 mb-3" v-if="pageAttributeTemplate.field_type === 'compound'">
            <div class="12">
                <label v-text="pageAttributeTemplate.name" class="col-form-label"></label>
            </div>
        </div>
        <draggable v-if="pageAttributeTemplate.repeatable" v-model="ownedPageAttributes" class="col mx-3">
            <vue-page-attribute v-for="childPageAttribute in ownedPageAttributes" :page-attribute="childPageAttribute" :key="childPageAttribute.id" :page-attribute-template="pageAttributeTemplate" :base-name="baseName"/>
        </draggable>
        <vue-page-attribute v-else v-for="childPageAttribute in ownedPageAttributes" :page-attribute="childPageAttribute" :key="childPageAttribute.id" :page-attribute-template="pageAttributeTemplate" :base-name="baseName"/>
        <div v-if="pageAttributeTemplate.repeatable" class="form-group text-end">
            <span class="btn btn-sm btn-outline-success" @click="addPageAttribute">
                <i class="fas fa-plus"></i> {{ pageAttributeTemplate.name}}
            </span>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';
import {mapGetters} from 'vuex';
import draggable from 'vuedraggable';

export default {
    name: 'vue-page-attribute-template',

    components: {
        draggable,
    },

    beforeMount() {
        if (this.ownedPageAttributes.length === 0) {
            this.addPageAttribute();
        }
    },

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
                    value: this.pageAttributeTemplate.data_provider,
                };
            },
        },
        baseName: {
            required: false,
            type: String,
            default: 'attributes'
        }
    },

    methods: {
        addPageAttribute: function() {
            let max = 0;

            if (this.page.page_attributes.length > 0) {
                max = _.maxBy(this.page.page_attributes, 'id').id;
            }

            this.page.page_attributes.push({
                id: max + 1,
                page_attribute_template_id: this.pageAttributeTemplate.id,
                page_attribute_id: this.pageAttribute.id,
                order: this.ownedPageAttributes.length,
                value: this.pageAttributeTemplate.field_type === 'module_set' ? this.pageAttributeTemplate.data_provider : null,
            });
        },
    },

    computed: {
        ...mapGetters('pages', [
            'page',
        ]),
        ...mapGetters('page_templates', [
            'page_template',
        ]),
        elementId() {
            return 'attributeTemplate'
        },
        ownedPageAttributes: {
            get() {
                return _.sortBy(_.filter(this.page.page_attributes, {
                    page_attribute_template_id: this.pageAttributeTemplate.id,
                    page_attribute_id: this.pageAttribute.id,
                }), 'order');
            },
            set(values) {
                _.each(values, (value, index) => {
                    if (value !== undefined) {
                        _.find(this.page.page_attributes, {
                            id: value.id,
                        }).order = index;
                    }
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
