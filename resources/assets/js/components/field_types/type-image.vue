<template>
    <div class="row g-3 mb-3">
        <div class="col-2">
            <label :for="name" v-text="label" class="col-3 col-form-label" />
        </div>
        <div class="col-10">
            <input v-if="value" type="hidden" :name="name" :value="value"/>
            <input type="file" class="form-control-file" :id="name" :name="name"/>
        </div>
    </div>
</template>

<script>
export default {
    name: 'vue-type-image',

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
            default: '',
        }
    },
}
</script>

<style scoped>

</style>
