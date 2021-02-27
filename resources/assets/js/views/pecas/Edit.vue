<template>
  <edicao
    entidade="pecas"
    :breadcrumb="[
      { text: 'Buscar Peças', href: '/pecas' },
      { text: $route.name, href: $route.path },
    ]"
    :finalizado="salvoComSucesso"
  >
    <template slot="formulario">
      <v-row dense>
        <v-card width="100%">
          <v-card-text>
            <v-row dense>
              <v-col cols="12" md="5">
                <v-text-field
                  v-model="model.nome"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="model.cor"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.cor')"
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
              <v-col cols="12" md="4">
                <lista-categorias
                  v-model="model.categoria_id"
                ></lista-categorias>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="model.custo"
                  type="number"
                  clearable
                  :label="trans('campo.custo')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <v-text-field
                  v-model="model.valor_venda"
                  type="number"
                  clearable
                  :label="trans('campo.valor_venda')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
      </v-row>
    </template>
  </edicao>
</template>

<script>
import Categorias from "../../components/lists/Categorias";

export default {
  data() {
    return {
      formValido: false,
      model: {},
      salvoComSucesso: null,
    };
  },
  mounted() {
    let ctr = this;
    axios.post("/pecas/pesquisar", { id: this.$route.params["id"] }).then(
      function (response) {
        ctr.model = response.data[0];
      },
      function (error) {}
    );
  },
  methods: {
    salvar: function () {
      let ctr = this;
      this.overlay = true;
      axios.put("/pecas/edit", this.model).then(
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
    "lista-categorias": Categorias,
  },
};
</script>