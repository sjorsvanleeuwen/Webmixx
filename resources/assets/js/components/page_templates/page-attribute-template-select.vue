<template>
    <div class="modal fade" tabindex="-1" aria-labelledby="pageAttributeTemplateSelectModalHeader" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pageAttributeTemplateSelectModalHeader">Add page attribute template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-3">
                                <label for="attribute_name" class="col-form-label">Name</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="attribute_name" name="name" v-model="name" class="form-control">
                            </div>
                        </div>
                        <fieldset class="row g-3 mb-3">
                            <legend class="col-form-label col-3 pt-0">Repeatable</legend>
                            <div class="col-9">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="repeatable" id="attribute_repeatable" v-model="repeatable" aria-label="Repeatable">
                                </div>
                            </div>
                        </fieldset>
                        <div class="row g-3 mb-3">
                            <div class="col-3">
                                <label for="field_type" class="col-form-label">Field Type</label>
                            </div>
                            <div class="col-9">
                                <select id="field_type" name="field_type" v-model="field_type" class="form-control" @change="loadFieldTypeModels">
                                    <option value="" disabled="disabled">Please Select</option>
                                    <option v-for="field_type in field_types" :value="field_type.id">{{ field_type.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3" v-if="data_providers.length > 0">
                            <div class="col-3">
                                <label for="data_provider" class="col-form-label">Data provider</label>
                            </div>
                            <div class="col-9">
                                <select id="data_provider" name="data_provider" v-model="data_provider" class="form-control">
                                    <option value="" disabled="disabled">Please Select</option>
                                    <option v-for="data_provider in data_providers" :value="data_provider.id">{{ data_provider.name }}</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {Modal} from 'bootstrap';
import {mapGetters} from "vuex";

export default {
    name: 'page-attribute-template-select',

    props: {
        pageTemplateId: {
            required: true,
            type: Number,
        }
    },

    beforeMount() {
        this.$store.dispatch('field_types/index');
    },

    mounted() {
        this.$el.addEventListener('hidden.bs.modal', this.reset);
    },

    data() {
        return {
            name: '',
            repeatable: false,
            field_type: '',
            data_provider: '',
            data_providers: [],
        }
    },

    methods: {
        loadFieldTypeModels() {
            this.data_provider = '';
            this.$store.dispatch('field_types/show', {
                field_type: this.field_type,
            }).then((data_providers) => {
                this.data_providers = data_providers;
            }).catch(() => {
                this.data_providers = [];
            });
        },
        save() {
            this.$store.dispatch('page_templates/addPageAttributeTemplate', {
                page_template_id: this.pageTemplateId,
                name: this.name,
                repeatable: this.repeatable,
                field_type: this.field_type,
                data_provider: this.data_provider,
            }).then(() => {
                Modal.getInstance(this.$el).hide();
            });
        },
        reset() {
            this.name = '';
            this.repeatable = false;
            this.field_type = '';
            this.data_provider = null;
            this.data_providers = [];
            this.$store.commit('field_types/clearFieldTypeDataProviders');
        },
    },

    computed: {
        ...mapGetters('field_types', [
            'field_types',
        ]),
    }
}
</script>

<style scoped>

</style>
