<template>
  <div :class="[{'is-invalid': isInvalid},
                 'custom-control',
                 'custom-radio',
                 'custom-control-inline']">
    <input type="radio"
           :class="[{'is-invalid': isInvalid},'custom-control-input']"
           :name="name"
           :id="id"
           :value="value"
           :checked="checked"
           @change="$emit('change', $event.target.value)"/>
    <label class="custom-control-label"
           :for="id">{{ label }}</label>
  </div>
</template>

<script>
export default {
  name: "v-radio",
  props: {
    checked: {
      type: Boolean,
      require: false,
      default: false
    },
    name: {
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
