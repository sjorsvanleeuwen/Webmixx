<template>
    <div class="form-group">
        <label :for="name" v-text="label"></label>
        <input type="text" class="form-control" :id="name" :name="name" :value="value"/>
    </div>
</template>

<script>
export default {
    name: "type-text",

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
