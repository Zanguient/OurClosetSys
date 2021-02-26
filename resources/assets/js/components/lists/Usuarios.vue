<template>
  <v-autocomplete
    v-bind="$attrs"
    @change="$emit('input', $event)"
    append-icon="keyboard_arrow_down"
    :items="items"
    item-text="nome"
    :label="label"
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
    },
    label: {
      default: 'Nome',
      type: String
    }
  },
  mounted() {
    let ctr = this;
    axios.post("/usuarios/pesquisar", {}).then(function(response) {
      ctr.items = response.data;
    });
  }
};
</script>