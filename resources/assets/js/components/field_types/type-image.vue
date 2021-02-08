<template>
    <div class="form-group row">
        <label :for="name" v-text="label" class="col-3 col-form-label"></label>
        <div class="col-9">
            <input v-if="value" type="hidden" :name="name" :value="value"/>
            <input type="file" class="form-control-file" :id="name" :name="name"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "type-image",

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
