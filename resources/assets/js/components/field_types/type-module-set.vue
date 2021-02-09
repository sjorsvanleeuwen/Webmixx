<template>
    <div class="invisible">
        <input type="hidden" :name="name" value="1"/>
    </div>
</template>

<script>
export default {
    name: "type-module-set",
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
