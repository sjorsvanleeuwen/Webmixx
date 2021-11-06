<template>
    <form method="post" :action="httpUrl">
        <input type="hidden" name="_method" :value="httpMethod">
        <input type="hidden" name="_token" :value="csrfToken">
        <div class="row g-3 mb-3">
            <div class="col-3">
                <label for="name" class="col-form-label">Name</label>
            </div>
            <div class="col-9">
                <input type="text" id="name" name="name" v-model="page_template.name" class="form-control">
            </div>
        </div>
        <fieldset class="row g-3 mb-3">
            <legend class="col-form-label col-3 pt-0">Repeatable</legend>
            <div class="col-9">
                <div class="form-check form-switch">
                    <input type="checkbox" name="repeatable" id="repeatable" value="1" v-model="page_template.repeatable" class="form-check-input" aria-label="Repeatable">
                </div>
            </div>
        </fieldset>
        <div class="form-group">
            <a href="/webmixx/page_template" class="btn btn-secondary">Cancel</a>
            <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
        </div>
        <h3 class="d-flex my-3 justify-content-between align-items-center">
            Template Attributes
            <span @click="openAddPageAttributeTemplateModal" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i></span>
        </h3>
        <vue-webmixx-page-attribute-templates v-model="pageAttributeTemplates"/>
        <page-attribute-template-select :page-template-id="pageTemplateId" ref="pageAttributeTemplateModal"/>
    </form>
</template>

<script>
import PageAttributeTemplateSelect from './page-attribute-template-select';
import {Modal} from 'bootstrap';
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
            let modal = new Modal(this.$refs.pageAttributeTemplateModal.$el);
            modal.show();
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
                return '/webmixx/page_template';
            }
            return '/webmixx/page_template/' + this.pageTemplateId;
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
