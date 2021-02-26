<template>
  <edicao
    entidade="usuarios"
    :breadcrumb="[
      { text: 'Usuários', href: '/usuarios' },
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
              <v-col cols="12" md="5">
                <v-text-field
                  v-model="model.email"
                  autocomplete="off"
                  clearable
                  :label="trans('campo.email')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="3">
                <lista-status v-model="model.status"></lista-status>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.password"
                  type="password"
                  clearable
                  :label="trans('campo.senha')"
                  outlined
                  dense
                ></v-text-field>
              </v-col>
              <v-col cols="12" md="4">
                <v-text-field
                  v-model="model.password_confirmation"
                  type="password"
                  clearable
                  :label="trans('campo.senha') + ' *'"
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
import Status from '../../components/lists/Status';

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
    axios.post("/usuarios/pesquisar", { id: this.$route.params["id"] }).then(
      function (response) {
        ctr.model = response.data[0];
      },
      function (error) {}
    );
  },
  components: {
    'lista-status': Status
  },
  methods: {
    salvar: function () {
      let ctr = this;
      this.overlay = true;
      axios.put("/usuarios/edit", this.model).then(
        function (response) {
          ctr.salvoComSucesso = true;
        },
        function (error) {
          ctr.salvoComSucesso = error.response.data.message;
        }
      );
    },
  },
};
</script>