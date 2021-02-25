<template>
  <div class="container">
    <v-overlay :value="overlay">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>
    <v-row>
      <v-col cols="12">
        <v-card>
          <v-toolbar dense color="primary" dark>
            <v-icon left>emoji_people</v-icon>
            <v-toolbar-title>{{trans('titulo.editar')}} {{trans('titulo.clientes')}}</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <formulario v-model="model" ref="formulario" :id="$route.params.id" @validacaoFormulario="formValido = $event"></formulario>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn small dark @click="voltar">
              <v-icon left>undo</v-icon>
              {{trans('botao.voltar')}}
            </v-btn>
            <v-btn color="red" small dark @click="resetarFormulario">
              <v-icon left>clear</v-icon>
              {{trans('botao.limpar')}}
            </v-btn>
            <v-btn color="primary" small @click="confirmarSalvar" :disabled="!formValido">
              <v-icon left>save</v-icon>
              {{trans('botao.salvar')}}
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <v-dialog v-model="confirmDialog" width="500">
      <v-card>
        <v-card-title>{{trans('mensagem.tem_certeza_disso')}}</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red" dark text @click="confirmDialog = false">
            <v-icon left>clear</v-icon>
            {{trans('botao.cancelar')}}
          </v-btn>
          <v-btn color="green" dark text @click="confirmDialog = false;salvar()">
            <v-icon left>check</v-icon>
            {{trans('botao.confirmar')}}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar color="success" right top :timeout="4000" v-model="snackbar">
      {{trans('mensagem.salvo_com_sucesso')}}
      <v-btn dark text @click="snackbar = false">
        <v-icon>clear</v-icon>
      </v-btn>
    </v-snackbar>
    <v-snackbar color="error" right top :timeout="4000" v-model="snackbarError">
      {{erro}}
      <v-btn dark text @click="snackbarError = false">
        <v-icon>clear</v-icon>
      </v-btn>
    </v-snackbar>
  </div>
</template>

<script>
import Formulario from "./forms/Edit";

export default {
  data() {
    return {
      snackbar: false,
      snackbarError: false,
      erro: null,
      overlay: false,
      formValido: false,
      confirmDialog: false,
      model: {},
    };
  },
  methods: {
    voltar: function () {
      window.location = "/clients";
    },
    resetarFormulario: function () {
      this.$router.go();
    },
    confirmarSalvar: function () {
      this.confirmDialog = true;
    },
    salvar: function () {
      let ctr = this;
      this.overlay = true;
      axios.put("/clients", this.model).then(function (response) {
        ctr.snackbar = true;
      }, function (error) {
          console.log(error.response.data.message);
          ctr.erro = error.response.statusText;
          ctr.snackbarError = true;
          ctr.overlay = false;
      });
    }
  },
  components: {
    formulario: Formulario,
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