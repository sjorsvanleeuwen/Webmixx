<template>
    <div class="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group row">
                            <label for="name" class="col-3 col-form-label">Name</label>
                            <div class="col-9">
                                <input type="text" id="name" name="name" v-model="name" class="form-control ">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="link_type" class="col-3 col-form-label">Link Type</label>
                            <div class="col-9">
                                <select id="link_type" name="link_type" v-model="link_type" class="form-control" @change="loadLinkTypeModels">
                                    <option value="" disabled="disabled">Please Select</option>
                                    <option v-for="link_type in link_types" :value="link_type.id">{{ link_type.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" v-if="link_type !== ''">
                            <label for="link_type" class="col-3 col-form-label">Link Model</label>
                            <div class="col-9">
                                <select id="link_id" name="link_id" v-model="link_id" class="form-control">
                                    <option value="" disabled="disabled">Please Select</option>
                                    <option v-for="link_model in link_models" :value="link_model.id">{{ link_model.name }}</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="saveMenuItem">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "menuItemSelect",

    props: {
        menuId: {
            required: true,
            type: Number,
        }
    },

    beforeMount() {
        this.$store.dispatch('link_types/index');
    },

    mounted() {
        $(this.$el).on('hidden.bs.modal', this.reset);
    },

    data() {
        return {
            name: '',
            link_type: '',
            link_id: null,
            link_models: [],
        }
    },

    methods: {
        loadLinkTypeModels() {
            this.$store.dispatch('link_types/show', {
                link_type: this.link_type,
            }).then((link_models) => {
                this.link_models = link_models;
            }).catch(() => {
                this.link_models = [];
            });
        },
        saveMenuItem() {
            this.$store.dispatch('menus/addMenuItem', {
                menu_id: this.menuId,
                link_type: this.link_type,
                link_id: this.link_id,
                name: this.name,
            }).then(() => {
                $(this.$el).modal('hide');
            });
        },
        reset() {
            this.name = '';
            this.link_type = '';
            this.link_id = null;
            this.link_models = [];
            this.$store.commit('link_types/clearLinkTypeModels');
        },
    },

    computed: {
        ...mapGetters('link_types', [
            'link_types',
        ]),
    }
}
</script>

<style scoped>

</style>
