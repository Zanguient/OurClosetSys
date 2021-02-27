<template>
  <busca
    entidade="estoques"
    :breadcrumb="[{ text: $route.name, href: $route.path }]"
    :cabecalho="headers"
    :resultados="resultados"
    :exibir-cadastrar="false"
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
        { text: this.trans("campo.quantidade"), value: "estoque.quantidade" },
        { text: this.trans("campo.nome"), value: "nome" },
        { text: this.trans("campo.cor"), value: "cor" },
        { text: this.trans("campo.tamanho"), value: "tamanho" },
        { text: this.trans("campo.categoria"), value: "categoria.nome" },
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
      axios.post("/estoques/pesquisar", this.busca).then(function (response) {
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