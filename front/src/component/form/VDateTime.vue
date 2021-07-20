<template>
    <div class="row pb-2">
        <div class="col-3 py-2">
            {{ title }}
        </div>
        <div class="col-7">
            <vue-ctk-date-time-picker
                :aria-valuenow="datetime"
                :formatted="formatted"
                :format="format"
                :label="label"
            ></vue-ctk-date-time-picker>
            <div v-for="(error,index) in errors"
                 :class="[{'invalid': isInvalid}]"
                 :key="index">
                {{ error }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "VDateTime",
    props: {
        datetime: {
            type: String,
            require: false,
            default: ''
        },
        formatted: {
            type: String,
            require: false,
            default: ''
        },
        format: {
            type: String,
            require: false,
            default: ''
        },
        label: {
            type: String,
            require: false,
            default: ''
        },
        title: {
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
.invalid{
    color: #e55353;
    font-size: 11.2px;
}
</style>
