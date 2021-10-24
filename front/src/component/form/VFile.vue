<template>
    <div class="form-group">
        <label :for="id">{{ label }}</label>
        <div>
            <slot name="img"></slot>
            <slot name="btn"></slot>
        </div>
        <input type="file"
               class="form-control-file pt-2"
               :accept="accept"
               :id="id"
               @change=changeFile($event.target.files[0])>
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
        accept: {
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
    methods: {
        changeFile: function (file) {
            this.$emit('file', file);
        }
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
