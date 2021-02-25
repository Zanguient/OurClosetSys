<template>
  <v-autocomplete
    v-bind="$attrs"
    @change="$emit('input', $event)"
    append-icon="keyboard_arrow_down"
    :items="items"
    item-text="nome"
    :label="trans('campo.usuario')"
    dense
    outlined
    return-object
    :clearable="limpar"
    clear-icon="clear"
  ></v-autocomplete>
</template>

  <script>
export default {
  data() {
    return {
      items: []
    };
  },
  props: {
    limpar: {
      default: true,
      type: Boolean
    }
  },
  mounted() {
    let ctr = this;
    axios.post("/users/buscar", {}).then(function(response) {
      ctr.items = response.data;
    });
  }
};
</script>