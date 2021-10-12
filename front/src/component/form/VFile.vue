<template>
    <div class="form-group">
        <label :for="id">{{ label }}</label>
        <p>
            <img :src=url
                 :alt=alt
                 class="img-thumbnail"
                 style="max-height: 100px; max-width: 100px">
        </p>
        <input type="file"
               class="form-control-file"
               :accept="accept"
               :id="id"
               @change="$emit('file', $event.target.files[0])">
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
        url: {
            type: String,
            require: false,
            default: ''
        },
        alt: {
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
    computed: {
        isInvalid: function () {
            return this.errors.length > 0;
        }
    }
}
</script>

<style scoped>

</style>
