<template>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label"
               :for="id">
            {{ label }}
        </label>
        <div class="col-sm-7">
            <select :class="[{'is-invalid': isInvalid},'custom-select']"
                    :id="id"
                    :disabled="disabled"
                    @change="event">
                <slot></slot>
            </select>
            <div v-for="(error,index) in errors"
                 :key="index"
                 :class="[{'invalid-feedback': isInvalid}]">
                {{ error }}
            </div>
        </div>
        <span class="col-sm-2" style="padding: 7px">{{ unit }}</span>
    </div>
</template>

<script>
export default {
    name: "VSelect",
    props: {
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
        unit: {
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
    methods: {
        event: function ($event) {
            this.$emit('input', $event.target.value);
            this.$emit('selectedIndex', $event.target.selectedIndex);
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
