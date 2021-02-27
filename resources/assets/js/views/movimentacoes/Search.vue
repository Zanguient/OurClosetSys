<template>
  <busca
    entidade="movimentacoes"
    :breadcrumb="[{ text: $route.name, href: $route.path }]"
    :cabecalho="headers"
    :resultados="resultados"
  >
    <template slot="filtro">
      <v-row dense>
        <v-col cols="12" md="4">
          <lista-tipos-movimentacoes-estoque v-model="busca.tipo"></lista-tipos-movimentacoes-estoque>
        </v-col>
        <v-col cols="12" md="4">
          <lista-pecas v-model="busca.peca_id"></lista-pecas>
        </v-col>
        <v-col cols="12" md="4">
          <lista-usuarios v-model="busca.responsavel_id" :label="trans('campo.responsavel')"></lista-usuarios>
        </v-col>
        <v-col cols="12" md="4">
          <datepicker ref="periodo_inicio" v-model="busca.periodo_inicio" :texto="trans('campo.periodo_inicio')"></datepicker>
        </v-col>
        <v-col cols="12" md="4">
          <datepicker ref="periodo_fim" v-model="busca.periodo_fim" :texto="trans('campo.periodo_fim')"></datepicker>
        </v-col>
      </v-row>
    </template>
  </busca>
</template>

<script>
import Usuarios from "../../components/lists/Usuarios";
import Pecas from "../../components/lists/Pecas";
import TiposMovimentacoesEstoque from "../../components/lists/TiposMovimentacoesEstoque"
import Datepicker from "../../components/Datepicker"

export default {
  data() {
    return {
      busca: {},
      headers: [
        { text: this.trans("campo.peca"), value: "peca" },
        { text: this.trans("campo.quantidade"), value: "quantidade" },
        { text: this.trans("campo.tipo"), value: "tipo" },
        { text: this.trans("campo.responsavel"), value: "responsavel.nome" },
        { text: this.trans("campo.data"), value: "created_at" }
      ],
      resultados: [],
    };
  },
  components: {
    "lista-usuarios": Usuarios,
    "lista-pecas": Pecas,
    "lista-tipos-movimentacoes-estoque": TiposMovimentacoesEstoque,
    "datepicker": Datepicker
  },
  methods: {
    buscar: function () {
      let ctr = this;
      axios.post("/movimentacoes/pesquisar", this.busca).then(function (response) {
        ctr.resultados = response.data;
      });
    },
    limpar: function () {
      this.$refs.periodo_inicio.limpar();
      this.$refs.periodo_fim.limpar();
      this.busca = {};
      this.buscar();
    },
  },
};
</script>