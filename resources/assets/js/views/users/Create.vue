<template>
  <cadastro
    entidade="clients"
    :breadcrumb="[
      { text: 'Clientes', href: '/clients' },
      { text: 'Cadastrar', href: '/clients/create' },
    ]"
    :finalizado="salvoComSucesso"
  >
    <template slot="formulario">
      <v-row dense>
        <v-card>
          <v-card-title> Informações Básicas </v-card-title>
          <v-card-text>
            <v-row dense>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome_pai"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome_pai')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome_mae"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome_mae')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.responsavel"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.responsavel')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
        <v-card class="mt-3">
          <v-card-title> Informações Básicas </v-card-title>
          <v-card-text>
            <v-row dense>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome_pai"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome_pai')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome_mae"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome_mae')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.responsavel"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.responsavel')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>
        </v-card>
        <v-card class="mt-3">
          <v-card-title> Informações Básicas </v-card-title>
          <v-card-text>
            <v-row dense>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome_pai"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome_pai')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.nome_mae"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.nome_mae')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.responsavel"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.responsavel')"
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
      salvoComSucesso: null
    };
  },
  methods: {
    salvar: function () {
      let ctr = this;
      this.overlay = true;
      axios.post("/clients", this.model).then(
        function (response) {
          ctr.salvoComSucesso = true;
        },
        function (error) {
          ctr.salvoComSucesso = error.response.data.message;
        }
      );
    },
  },
  watch: {
    snackbar: function (val) {
      if (!val) {
        window.location = "/clients";
      }
    },
  },
};
</script>