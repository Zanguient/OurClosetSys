<template>
  <busca
    entidade="categorias"
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
          <lista-usuarios v-model="busca.criador_id" :label="trans('campo.criado_por')"></lista-usuarios>
        </v-col>
      </v-row>
    </template>
  </busca>
</template>

<script>
import Usuarios from "../../components/lists/Usuarios";

export default {
  data() {
    return {
      busca: {},
      headers: [
        { text: "ID", value: "id" },
        { text: this.trans("campo.nome"), value: "nome" },
        { text: this.trans("campo.criado_por"), value: "criador.nome" },
        { text: this.trans("campo.data_criacao"), value: "created_at" },
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
    "lista-usuarios": Usuarios,
  },
  methods: {
    buscar: function () {
      let ctr = this;
      axios.post("/categorias/pesquisar", this.busca).then(function (response) {
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