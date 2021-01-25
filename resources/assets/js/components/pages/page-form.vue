<template>
    <form method="post" :action="httpUrl">
        <input type="hidden" name="_method" :value="httpMethod">
        <input type="hidden" name="_token" :value="csrfToken">
        <div class="form-group row">
            <label for="name" class="col-3 col-form-label">Naam</label>
            <div class="col-9">
                <input type="text" id="name" name="name" v-model="page.name" class="form-control ">
            </div>
        </div>
        <div class="form-group row">
            <label for="page_template_id" class="col-3 col-form-label">Page Template</label>
            <div class="col-9">
                <select :disabled="pageId !== null" id="page_template_id" name="page_template_id" v-model="page.page_template_id" class="form-control ">
                    <option value="" disabled="disabled">Please Select</option>
                    <option v-for="page_template in page_templates" :value="page_template.id" v-text="page_template.name"></option>
                </select>
            </div>
        </div>
        <h3>Attributes</h3>
        <page-attribute-template v-for="pageAttributeTemplate in rootPageAttributeTemplates" v-bind:key="pageAttributeTemplate.id" :page-attribute-template="pageAttributeTemplate" />
        <div class="form-group">
            <a href="/webmixx/pages" class="btn btn-secondary">Cancel</a>
            <button type="submit" name="save" value="save" class="btn btn-primary">Save</button>
        </div>
    </form>
</template>

<script>
import { mapGetters } from 'vuex'
import _ from 'lodash';

export default {
    name: "pageForm",

    props: {
        pageId: {
            required: false,
            type: Number,
            default: null,
        }
    },

    watch: {
        'page.page_template_id': function(page_template_id) {
            this.$store.commit('page_templates/set', _.find(this.page_templates, {id: page_template_id}));
        },
    },

    beforeMount() {
        this.$store.dispatch('page_templates/index');

        if (this.pageId !== null) {
            this.$store.dispatch('pages/show', {id: this.pageId})
                .then((page) => {
                    this.$store.commit('page_templates/set', _.find(this.page_templates, {id: page.page_template_id}));
                });
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
                return '/webmixx/pages';
            }
            return '/webmixx/pages/' + this.pageId;
        },
        rootPageAttributeTemplates() {
            if (this.page_template === undefined) {
                return [];
            }
            return _.filter(this.page_template.page_attribute_templates, {
                page_attribute_template_id: null,
            });
        }
    }
}
</script>

<style scoped>

</style>
