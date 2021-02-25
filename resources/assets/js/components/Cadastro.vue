<template>
  <div class="container">
    <v-overlay :value="overlay">
      <v-progress-circular indeterminate size="64"></v-progress-circular>
    </v-overlay>
    <v-row dense v-show="breadcrumb != null" class="mb-3">
      <v-col cols="12">
        <v-breadcrumbs class="pa-0" :items="breadcrumb"></v-breadcrumbs>
      </v-col>
    </v-row>
    <v-row dense>
      <v-col cols="12">
        <slot name="formulario"></slot>
      </v-col>
      <v-col cols="12" class="text-right">
        <v-btn small color="red" dark @click="limpar()"><i class="far fa-eraser mr-2"></i>Limpar</v-btn>
        <v-btn small dark @click="cancelar()"><i class="far fa-undo mr-2"></i>Cancelar</v-btn>
        <v-btn small color="primary" @click="dialog_salvar = true"><i class="far fa-check mr-2"></i>Salvar</v-btn>
      </v-col>
    </v-row>

    <v-dialog v-model="dialog_salvar" width="500">
      <v-card>
        <v-card-title>{{ trans("mensagem.salvar_novo_registro") }}</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red" dark text @click="dialog_salvar = false">
            <v-icon left>clear</v-icon>
            {{ trans("botao.cancelar") }}
          </v-btn>
          <v-btn
            color="green"
            dark
            text
            @click="
              dialog_salvar = false;
              salvar();
            "
          >
            <v-icon left>check</v-icon>
            {{ trans("botao.confirmar") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar color="success" right top :timeout="3000" v-model="snackbar">
      {{ trans("mensagem.salvo_com_sucesso") }}
      <v-btn dark text @click="snackbar = false">
        <v-icon>clear</v-icon>
      </v-btn>
    </v-snackbar>
    <v-snackbar color="error" right top :timeout="3000" v-model="snackbarError">
      {{ erro }}
      <v-btn dark text @click="snackbarError = false">
        <v-icon>clear</v-icon>
      </v-btn>
    </v-snackbar>
  </div>
</template>

<script>
export default {
  data() {
    return {
      overlay: false,
      dialog_salvar: false,
      snackbar: false,
      snackbarError: false,
      erro: null,
    };
  },
  props: {
    entidade: {
      type: String,
      default: null
    },
    breadcrumb: {
      type: Array,
      default: null
    },
    finalizado: {
      default: null
    }
  },
  methods: {
    limpar: function () {
      window.location = '/' + this.entidade + '/create';
    },
    cancelar: function () {
      window.location = "/" + this.entidade;
    },
    salvar: function () {
      this.overlay = true;
      this.$parent.salvar();
    },
  },
  watch: {
    finalizado: function (val, oldVal) {
      if (val != oldVal && this.finalizado !== null) {
        if (val === true) {
          this.snackbar = true;
        } else {
          this.overlay = false;
          this.snackbarError = true;
          this.erro = val;
        }
        this.$parent.salvoComSucesso = null;
      }
    },
    snackbar: function (val, oldVal) {
      if (val !== oldVal && oldVal == true) {
        this.limpar();
      }
    }
  }
};
</script>