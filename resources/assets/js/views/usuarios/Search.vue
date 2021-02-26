<template>
  <busca
    entidade="usuarios"
    :breadcrumb="[{ text: $route.name, href: $route.path }]"
    :cabecalho="headers"
    :resultados="resultados"
  >
    <template slot="filtro">
      <v-row dense>
        <v-col cols="12" md="4">
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
          <v-text-field
            v-model="busca.email"
            autocomplete="off"
            clearable
            :label="trans('campo.email')"
            outlined
            dense
          ></v-text-field>
        </v-col>
        <v-col cols="12" md="4">
          <lista-status v-model="busca.status"></lista-status>
        </v-col>
      </v-row>
    </template>
  </busca>
</template>

<script>
import Status from "../../components/lists/Status";

export default {
  data() {
    return {
      busca: {},
      headers: [
        { text: "ID", value: "id" },
        { text: this.trans("campo.nome"), value: "nome" },
        { text: this.trans("campo.email"), value: "email" },
        { text: this.trans("campo.status"), value: "status" },
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
    "lista-status": Status,
  },
  methods: {
    buscar: function () {
      let ctr = this;
      axios.post("/usuarios/pesquisar", this.busca).then(function (response) {
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