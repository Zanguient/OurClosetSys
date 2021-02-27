<template>
  <cadastro
    entidade="movimentacoes"
    :breadcrumb="[
      { text: 'Buscar Movimentações', href: '/movimentacoes' },
      { text: $route.name, href: $route.path },
    ]"
    :finalizado="salvoComSucesso"
  >
    <template slot="formulario">
      <v-row dense>
        <v-card width="100%">
          <v-card-text>
            <v-row dense>
              <v-col cols="12" md="4">
                <lista-tipos-movimentacoes-estoque
                  v-model="model.tipo"
                ></lista-tipos-movimentacoes-estoque>
              </v-col>
              <v-col cols="12" md="6">
                <lista-pecas v-model="model.peca" return-object></lista-pecas>
              </v-col>
              <v-col cols="12" md="2">
                <v-text-field
                  v-model="model.quantidade"
                  autocomplete="off"
                  @input="valorTotal = model.valor_unidade * model.quantidade"
                  clearable
                  :label="trans('campo.quantidade')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row dense v-show="model.tipo == 'VENDA'">
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="model.valor_unidade"
                  autocomplete="off"
                  clearable
                  @input="valorTotal = model.valor_unidade * model.quantidade"
                  :label="trans('campo.valor_unidade')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                  readonly
                  :label="trans('campo.valor_total')"
                  outlined
                  :value="valorTotal"
                  dense
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-row>
    </template>
  </cadastro>
</template>

<script>
import Pecas from "../../components/lists/Pecas";
import TiposMovimentacoesEstoque from "../../components/lists/TiposMovimentacoesEstoque";

export default {
  data() {
    return {
      formValido: false,
      model: {},
      valorTotal: 0,
      salvoComSucesso: null,
    };
  },
  methods: {
    salvar: function () {
      let ctr = this;
      this.overlay = true;
      this.model.peca_id = this.model.peca["id"];
      axios.post("/movimentacoes", this.model).then(
        function (response) {
          ctr.salvoComSucesso = true;
        },
        function (error) {
          ctr.salvoComSucesso = error.response.data.message;
        }
      );
    },
  },
  components: {
    "lista-pecas": Pecas,
    "lista-tipos-movimentacoes-estoque": TiposMovimentacoesEstoque,
  },
  watch: {
    "model.peca": function (val, oldVal) {
      if (
        this.model.tipo == "VENDA" &&
        this.model.peca != null
      ) {
        this.model.valor_unidade = this.model.peca["valor_venda"];
      }
    },
    "model.tipo": function (val, oldVal) {
      if (
        this.model.tipo == "VENDA" &&
        this.model.peca != null
      ) {
        this.model.valor_unidade = this.model.peca["valor_venda"];
      }
    },
  },
};
</script>