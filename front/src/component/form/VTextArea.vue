<template>
    <div class="form-group">
        <label :for="id">{{ label }}</label>
        <textarea rows="3"
                  :class="[{'is-invalid': isInvalid},'form-control']"
                  :id="id"
                  :value="value"
                  :maxlength="maxlength"
                  :disabled="disabled"
                  :placeholder="placeholder"
                  @input="$emit('input', $event.target.value)"></textarea>
        <div v-for="(error,index) in errors"
             :class="[{'invalid-feedback': isInvalid}]"
             :key="index">
            {{ error }}
        </div>
    </div>
</template>

<script>
export default {
    name: "VTextArea",
    props: {
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
            type: String,
            require: false,
            default: ''
        },
        placeholder: {
            type: String,
            require: false,
            default: ''
        },
        maxlength: {
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
