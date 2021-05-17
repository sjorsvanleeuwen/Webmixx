<template>
    <div class="row g-3 mb-3">
        <div class="col-2">
            <label :for="name" v-text="label" class="col-form-label" />
        </div>
        <div class="col-10">
            <textarea class="form-control" :id="name" :name="name" rows="3">{{ $value }}</textarea>
        </div>
    </div>
</template>

<script>
export default {
    name: 'vue-type-text',

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
