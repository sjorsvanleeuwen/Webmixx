<template>
    <div :id="'attributeTemplate' + pageAttributeTemplate.id" :class="{ repeatable: pageAttributeTemplate.repeatable }">
        <draggable v-if="pageAttributeTemplate.repeatable" v-model="ownedPageAttributes">
            <page-attribute v-for="childPageAttribute in ownedPageAttributes" :page-attribute="childPageAttribute" :key="childPageAttribute.id" :page-attribute-template="pageAttributeTemplate" :page-template="pageTemplate" :base-name="baseName"/>
        </draggable>
        <page-attribute v-else v-for="childPageAttribute in ownedPageAttributes" :page-attribute="childPageAttribute" :key="childPageAttribute.id" :page-attribute-template="pageAttributeTemplate" :page-template="pageTemplate" :base-name="baseName"/>
        <div v-if="pageAttributeTemplate.repeatable" class="form-group text-right">
            <span class="btn btn-primary" v-text="'Add another ' + pageAttributeTemplate.name" @click="addPageAttribute"></span>
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
            required: false,
            type: String,
            default: 'attributes'
        }
    },

    methods: {
        addPageAttribute: function() {
            let max = _.maxBy(this.page.page_attributes, 'id').id;
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
