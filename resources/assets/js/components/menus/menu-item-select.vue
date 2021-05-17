<template>
    <div class="modal fade" tabindex="-1" aria-labelledby="menuItemSelectModalHeader" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="menuItemSelectModalHeader">Add menu item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-3">
                                <label for="name" class="col-form-label">Name</label>
                            </div>
                            <div class="col-9">
                                <input type="text" id="name" name="name" v-model="name" class="form-control ">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-3">
                                <label for="link_type" class="col-form-label">Link Type</label>
                            </div>
                            <div class="col-9">
                                <select id="link_type" name="link_type" v-model="link_type" class="form-control" @change="loadLinkTypeModels">
                                    <option value="" disabled="disabled">Please Select</option>
                                    <option v-for="link_type in link_types" :value="link_type.id">{{ link_type.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-3 mb-3" v-if="link_type !== ''">
                            <div class="col-3">
                                <label for="link_type" class="col-form-label">Link Model</label>
                            </div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";
import {Modal} from "bootstrap";

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
        this.$el.addEventListener('hidden.bs.modal', this.reset);
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
        save() {
            this.$store.dispatch('menus/addMenuItem', {
                menu_id: this.menuId,
                link_type: this.link_type,
                link_id: this.link_id,
                name: this.name,
            }).then(() => {
                Modal.getInstance(this.$el).hide();
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
