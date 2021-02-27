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
                <lista-pecas v-model="model.peca_id"></lista-pecas>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="model.quantidade"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.quantidade')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="model.tamanho"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.tamanho')"
                  outlined
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
      salvoComSucesso: null,
    };
  },
  methods: {
    salvar: function () {
      let ctr = this;
      this.overlay = true;
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
    "lista-tipos-movimentacoes-estoque": TiposMovimentacoesEstoque
  }
};
</script>