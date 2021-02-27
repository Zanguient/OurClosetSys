<template>
  <busca
    entidade="pecas"
    :breadcrumb="[{ text: $route.name, href: $route.path }]"
    :cabecalho="headers"
    :resultados="resultados"
  >
    <template slot="filtro">
      <v-row dense>
        <v-col cols="12" md="5">
          <v-text-field
            v-model="busca.nome"
            autocomplete="off"
            clearable
            :label="trans('campo.nome')"
            outlined
            dense
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="4">
          <lista-categorias v-model="busca.categoria_id"></lista-categorias>
        </v-col>
        <v-col cols="12" md="3">
          <v-text-field
            v-model="busca.cor"
            autocomplete="off"
            clearable
            :label="trans('campo.cor')"
            outlined
            dense
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="3">
          <v-text-field
            v-model="busca.tamanho"
            autocomplete="off"
            clearable
            :label="trans('campo.tamanho')"
            outlined
            dense
          ></v-text-field>
        </v-col>
      </v-row>
    </template>
  </busca>
</template>

<script>
import Categorias from "../../components/lists/Categorias";

export default {
  data() {
    return {
      busca: {},
      headers: [
        { text: this.trans("campo.nome"), value: "nome" },
        { text: this.trans("campo.cor"), value: "cor" },
        { text: this.trans("campo.tamanho"), value: "tamanho" },
        { text: this.trans("campo.categoria"), value: "categoria.nome" },
        { text: this.trans("campo.custo"), value: "custo" },
        { text: this.trans("campo.valor_venda"), value: "valor_venda" },
        {
          text: this.trans("campo.acoes"),
          value: "acoes",
          align: "center",
          sortable: false,
          class: "action-column",
        },
      ],
      resultados: [],
    };
  },
  components: {
    "lista-categorias": Categorias,
  },
  methods: {
    buscar: function () {
      let ctr = this;
      axios.post("/pecas/pesquisar", this.busca).then(function (response) {
        ctr.resultados = response.data;
      });
    },
    limpar: function () {
      this.busca = {};
      this.buscar();
    },
  },
};
</script>