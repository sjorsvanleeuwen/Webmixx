<template>
    <form method="post" :action="httpUrl">
        <input type="hidden" name="_method" :value="httpMethod">
        <input type="hidden" name="_token" :value="csrfToken">
        <div class="form-group row">
            <label for="name" class="col-3 col-form-label">Name</label>
            <div class="col-9">
                <input type="text" id="name" name="name" v-model="page_template.name" class="form-control ">
            </div>
        </div>
        <div class="form-group row">
            <legend class="col-form-label col-3 float-left pt-0">Options</legend>
            <div class="col-9">
                <div class="form-check">
                    <input type="checkbox" name="repeatable" id="repeatable" value="1" v-model="page_template.repeatable" class="form-check-input">
                    <label for="repeatable">Repeatable</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <a href="/webmixx/page_templates" class="btn btn-secondary">Cancel</a>
            <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
        </div>
        <h3>Template Attributes</h3>
        <div class="col-12 mt-4">
            <span @click="openAddPageAttributeTemplateModal" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i></span>
        </div>
        <vue-webmixx-page-attribute-templates v-model="pageAttributeTemplates"/>
        <div class="col-12 mt-4">
            <page-attribute-template-select :page-template-id="pageTemplateId" ref="pageAttributeTemplateModal"/>
        </div>
    </form>
</template>

<script>
import PageAttributeTemplateSelect from './page-attribute-template-select';
import {mapGetters} from 'vuex';

export default {
    name: 'vue-webmixx-page-template-form',

    components: {
        PageAttributeTemplateSelect,
    },

    props: {
        pageTemplateId: {
            required: false,
            type: Number,
            default: null,
        }
    },

    beforeMount() {
        if (this.pageTemplateId !== null) {
            this.$store.dispatch('page_templates/show', {id: this.pageTemplateId});
        }
    },

    methods: {
        openAddPageAttributeTemplateModal() {
            $(this.$refs.pageAttributeTemplateModal.$el).modal();
        }
    },

    computed: {
        ...mapGetters('page_templates', [
            'page_template'
        ]),
        httpMethod() {
            if (this.pageTemplateId === null) {
                return 'post';
            }
            return 'put';
        },
        httpUrl() {
            if (this.pageTemplateId === null) {
                return '/webmixx/page_templates';
            }
            return '/webmixx/page_templates/' + this.pageTemplateId;
        },
        pageAttributeTemplates: {
            get() {
                return this.page_template.page_attribute_templates;
            },
            set(values) {
                this.$store.dispatch("page_templates/setPageAttributeTemplates", values);
            }
        },
    }
}
</script>

<style scoped>

</style>
