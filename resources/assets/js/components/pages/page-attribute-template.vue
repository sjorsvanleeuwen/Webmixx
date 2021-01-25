<template>
    <div :id="'attributeTemplate' + pageAttributeTemplate.id" :class="{ repeatable: pageAttributeTemplate.repeatable }">
        <draggable v-if="pageAttributeTemplate.repeatable" v-model="ownedPageAttributes">
            <page-attribute v-for="childPageAttribute in ownedPageAttributes" :page-attribute="childPageAttribute" :key="childPageAttribute.id" :page-attribute-template="pageAttributeTemplate" :base-name="baseName"/>
        </draggable>
        <page-attribute v-else v-for="childPageAttribute in ownedPageAttributes" :page-attribute="childPageAttribute" :key="childPageAttribute.id" :page-attribute-template="pageAttributeTemplate" :base-name="baseName"/>
        <div v-if="pageAttributeTemplate.repeatable" class="form-group text-right">
            <span class="btn btn-sm btn-outline-success" @click="addPageAttribute">
                <i class="fas fa-plus"></i> {{ pageAttributeTemplate.name}}
            </span>
        </div>
    </div>
</template>

<script>
import _ from 'lodash';
import {mapGetters} from "vuex";
import draggable from 'vuedraggable';

export default {
    name: "pageAttributeTemplate",

    components: {
        draggable
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
