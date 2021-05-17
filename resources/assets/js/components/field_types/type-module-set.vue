<template>
    <div class="invisible">
        <input type="hidden" :name="name" :value="value"/>
    </div>
</template>

<script>
export default {
    name: 'vue-type-module-set',
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
            required: true,
            type: String,
        }
    },
}
</script>

<style scoped>

</style>
