<template>
    <div class="form-group row">
<!--        <label class="col-sm-3 col-form-label"-->
<!--               :for="id">{{ label }}</label>-->
        <div class="col-12">
            <input :class="[{'is-invalid': isInvalid},
                  isPlainText ? 'form-control-plaintext' : 'form-control']"
                   :type="type"
                   :value="value"
                   :placeholder="placeholder"
                   :id="id"
                   :disabled="disabled"
                   :readonly="readonly"
                   @input="$emit('input', $event.target.value)">
<!--            <small class="text-muted">{{ text }}</small>-->
            <div v-for="(error,index) in errors"
                 :class="[{'invalid-feedback': isInvalid}]"
                 :key="index">
                {{ error }}
            </div>
        </div>
<!--        <span class="col-sm-2" style="padding: 7px">{{ unit }}</span>-->
    </div>
</template>

<script>
export default {
    name: "VInput",
    props: {
        isPlainText: {
            type: Boolean,
            require: false,
            default: false
        },
        readonly: {
            type: Boolean,
            require: false,
            default: false
        },
        disabled: {
            type: Boolean,
            require: false,
            default: false
        },
        type: {
            type: String,
            require: false,
            default: ''
        },
        unit: {
            type: String,
            require: false,
            default: ''
        },
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
        value: {
            // type: String,
            // require: false,
            // default: ''
        },
        placeholder: {
            type: String,
            require: false,
            default: ''
        },
        text: {
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
