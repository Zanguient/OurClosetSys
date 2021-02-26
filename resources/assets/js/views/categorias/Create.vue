<template>
  <cadastro
    entidade="categorias"
    :breadcrumb="[
      { text: 'Buscar Categorias', href: '/categorias' },
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
            </v-row>
          </v-card-text>
        </v-card>
      </v-row>
    </template>
  </cadastro>
</template>

<script>
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
      axios.post("/categorias", this.model).then(
        function (response) {
          ctr.salvoComSucesso = true;
        },
        function (error) {
          ctr.salvoComSucesso = error.response.data.message;
        }
      );
    },
  }
};
</script>