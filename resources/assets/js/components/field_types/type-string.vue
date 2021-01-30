<template>
    <div class="form-group row">
        <label :for="name" v-text="label" class="col-3 col-form-label"></label>
        <div class="col-9">
            <input type="text" class="form-control" :id="name" :name="name" :value="value"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "type-string",

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
