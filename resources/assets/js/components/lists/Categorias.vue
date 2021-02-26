<template>
  <v-autocomplete
    v-bind="$attrs"
    @change="$emit('input', $event)"
    append-icon="keyboard_arrow_down"
    :items="items"
    item-value="id"
    item-text="nome"
    :label="label"
    dense
    outlined
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
      default: 'Categoria',
      type: String
    }
  },
  mounted() {
    let ctr = this;
    axios.post("/categorias/pesquisar", {}).then(function(response) {
      ctr.items = response.data;
    });
  }
};
</script>