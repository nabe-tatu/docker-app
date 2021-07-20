<template>
    <div class="form-group">
        <label :for="id">{{ label }}</label>
        <input type="file" class="form-control-file" :id="id">
        <div v-for="(error,index) in errors"
             :class="[{'invalid-feedback': isInvalid}]"
             :key="index">
            {{ error }}
        </div>
    </div>
</template>

<script>
export default {
    name: "VFile",
    props: {
        label: {
            type: String,
            require: false,
            default: ''
        },
        id: {
            type: String,
            require: false,
            default: ''
        },
        errors: {
            type: Array,
            require: true,
            default: () => ([])
        },
    },
    computed: {
        isInvalid: function () {
            return this.errors.length > 0;
        }
    }
}
</script>

<style scoped>

</style>
