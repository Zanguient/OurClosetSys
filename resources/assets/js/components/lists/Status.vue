<template>
  <v-select
    v-bind="$attrs"
    @change="$emit('input', $event)"
    append-icon="keyboard_arrow_down"
    :items="items"
    item-value="codigo"
    item-text="descricao"
    :label="trans('campo.status')"
    dense
    outlined
    :clearable="limpar"
    clear-icon="clear"
  ></v-select>
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
    this.items = [
      {codigo: 'ATIVO', descricao: 'Ativo'},
      {codigo: 'INATIVO', descricao: 'Inativo'}
    ];
  }
};
</script>