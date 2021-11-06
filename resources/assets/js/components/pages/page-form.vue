<template>
    <form method="post" :action="httpUrl" enctype="multipart/form-data">
        <input type="hidden" name="_method" :value="httpMethod">
        <input type="hidden" name="_token" :value="csrfToken">
        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="name" class="col-form-label">Name</label>
            </div>
            <div class="col-8">
                <input type="text" id="name" name="name" v-model="page.name" class="form-control">
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-2">
                <label for="page_template_id" class="col-form-label">Page Template</label>
            </div>
            <div class="col-8">
                <select :disabled="pageId !== null" id="page_template_id" name="page_template_id" v-model="page.page_template_id" class="form-control" @change="loadPageTemplate">
                    <option value="" disabled="disabled">Please Select</option>
                    <option v-for="page_template in page_templates" :value="page_template.id" v-text="page_template.name"></option>
                </select>
            </div>
        </div>
        <h3>Attributes</h3>
        <div class="row g-3">
            <div class="col-10">
                <vue-page-attribute-template v-for="pageAttributeTemplate in rootPageAttributeTemplates" v-bind:key="pageAttributeTemplate.id" :page-attribute-template="pageAttributeTemplate" />
            </div>
        </div>
        <div class="form-group">
            <a href="/webmixx/page" class="btn btn-secondary">Cancel</a>
            <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
        </div>
    </form>
</template>

<script>
import _ from 'lodash';
import { mapGetters } from 'vuex';

export default {
    name: 'vue-page-form',

    props: {
        pageId: {
            required: false,
            type: Number,
            default: null,
        }
    },

    beforeMount() {
        this.$store.dispatch('page_templates/index', {page_id: this.pageId})
            .then(() => {
                if (this.pageId !== null) {
                    this.$store.dispatch('pages/show', {id: this.pageId})
                        .then((page) => {
                            this.$store.commit('page_templates/set', _.find(this.page_templates, {id: page.page_template_id}));
                        });
                }
            });
    },

    methods: {
        loadPageTemplate() {
            this.$store.commit('page_templates/set', _.find(this.page_templates, {id: this.page.page_template_id}));
        }
    },

    computed: {
        ...mapGetters('pages', [
            'page',
        ]),
        ...mapGetters('page_templates', [
            'page_templates',
            'page_template'
        ]),
        httpMethod() {
            if (this.pageId === null) {
                return 'post';
            }
            return 'put';
        },
        httpUrl() {
            if (this.pageId === null) {
                return '/webmixx/page';
            }
            return '/webmixx/page/' + this.pageId;
        },
        rootPageAttributeTemplates() {
            if (this.page_template === undefined) {
                return [];
            }
            return _.orderBy(_.filter(this.page_template.page_attribute_templates, {
                page_attribute_template_id: null,
            }), 'order');
        }
    }
}
</script>

<style scoped>

</style>
