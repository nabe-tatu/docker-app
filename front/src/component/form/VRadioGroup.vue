<template>
    <div class="form-group row">
        <label class="col-sm-3 radio-inline control-label">{{ label }}</label>
        <div class="col-sm-9">
            <slot></slot>
            <div :class="[{'invalid-feedback': isInvalid}]"
                 v-for="error in errors" :key="error">{{ error }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "VRadioGroup",
    props: {
        label: {
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
