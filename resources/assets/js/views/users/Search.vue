<template>
    <busca
      entidade="clients"
      :breadcrumb="[{text: 'Clientes', href: '/clients'}]"
      :cabecalho="headers"
      :resultados="resultados"
    >
      <template slot="filtro">
        <v-row dense>
          <v-col cols="12" md="4">
            <v-text-field v-model="busca.nome" autocomplete="off" clearable :label="trans('campo.nome')" outlined dense></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field v-model="busca.nome_pai" autocomplete="off" clearable :label="trans('campo.nome_pai')" outlined dense></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field v-model="busca.nome_mae" autocomplete="off" clearable :label="trans('campo.nome_mae')" outlined dense></v-text-field>
          </v-col>
          <v-col cols="12" md="4">
            <v-text-field v-model="busca.responsavel" autocomplete="off" clearable :label="trans('campo.responsavel')" outlined dense></v-text-field>
          </v-col>
        </v-row>
      </template>
    </busca>
</template>

<script>

export default {
  data() {
    return {
      busca: {},
      headers: [
        { text: "ID", value: "id" },
        { text: this.trans("campo.nome"), value: "name" },
        { text: 'CPF/CNPJ', value: "cpf_cnpj" },
        { text: this.trans("campo.email"), value: "email" },
        { text: 'Origem', value: "location_origin.name" },
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
  methods: {
    buscar: function () {
      let ctr = this;
      axios.post("/clients/pesquisar", this.busca).then(function (response) {
        ctr.resultados = response.data;
        ctr.resultados.map(function(e) {
          e.cpf_cnpj = e.cpf?(e.cpf):(e.cnpj?e.cnpj:'');
        })
      });
    },
    limpar: function () {
      this.busca = {};
      this.buscar();
    },
  }
};
</script>