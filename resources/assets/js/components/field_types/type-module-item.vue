<template>
    <div class="row g-3 mb-3">
        <div class="col-2">
            <label :for="name" v-text="label" class="col-form-label" />
        </div>
        <div class="col-10">
            <select :id="name" :name="name" v-model="value" class="form-control">
                <option :value="null" disabled="disabled">Please Select</option>
                <option v-for="module_item in module_items" :value="module_item.id">{{ module_item.name }}</option>
            </select>
        </div>
    </div>
</template>

<script>
export default {
    name: 'vue-type-module-item',

    props: {
        name: {
            required: true,
            type: String,
        },
        label: {
            required: true,
            type: String,
        },
        value: {
            required: false,
            type: String,
            default: null,
        },
        pageAttributeTemplate: {
            required: true,
            type: Object,
        }
    },

    data() {
        return {
            module_items: [],
        };
    },

    mounted() {
        this.$store.dispatch('module_items/show', {
            page_attribute_template_id: this.pageAttributeTemplate.id,
        }).then((module_items) => {
            this.module_items = module_items;
        }).catch(() => {
            this.module_items = [];
        });
    },
}
</script>

<style scoped>

</style>
