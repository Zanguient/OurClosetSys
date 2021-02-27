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
        <v-card>
          <v-card-title>
            <v-btn
              small
              color="grey"
              dark
              @click="showFilter = !showFilter"
              v-if="exibirFiltro"
            >
              Filtrar
              <v-icon right v-show="!showFilter">keyboard_arrow_down</v-icon>
              <v-icon right v-show="showFilter">keyboard_arrow_up</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn
              small
              color="primary"
              class="mr-3"
              v-if="exibirCadastrar"
              @click="cadastrar()"
            >
              <v-icon left>add</v-icon>
              Novo
            </v-btn>
          </v-card-title>
          <v-expand-transition>
            <div v-show="showFilter && exibirFiltro">
              <v-card-text class="mb-0 pt-3" style="background-color: #efefef">
                <slot name="filtro"></slot>
                <v-btn
                  small
                  dark
                  color="red"
                  @click="
                    limpar();
                    showFilter = false;
                  "
                >
                  <v-icon left>clear</v-icon>
                  Limpar
                </v-btn>
                <v-btn
                  small
                  dark
                  color="primary"
                  class="ml-3"
                  @click="
                    buscar();
                    showFilter = false;
                  "
                >
                  <v-icon left>search</v-icon>
                  Buscar
                </v-btn>
              </v-card-text>
            </div>
          </v-expand-transition>
          <v-card-text class="pt-0">
            <v-data-table
              :headers="headers"
              :items="resultados"
              :options.sync="options"
              :items-per-page="itensPerPage"
              :no-data-text="trans('mensagem.nao_ha_dados')"
              :footer-props="{
                showFirstLastPage: true,
                firstIcon: 'first_page',
                lastIcon: 'last_page',
                prevIcon: 'navigate_before',
                nextIcon: 'navigate_next',
                itemsPerPageText: 'Qtd. por página',
                itemsPerPageAllText: 'Todos',
              }"
            >
              <template v-slot:headers="props">
                <tr>
                  <th v-for="header in props.headers" :key="header.text">
                    <v-icon small>arrow_upward</v-icon>
                    {{ header.text }}
                  </th>
                </tr>
              </template>
              <template v-slot:item.peca="{ item }">
                {{item.peca.nome}} ({{item.peca.cor}}) [{{item.peca.tamanho}}]
              </template>
              <template v-slot:item.created_at="{ item }">
                {{ moment(item.created_at).format('DD/MM/YYYY HH:mm:ss') }}
              </template>
              <template v-slot:item.acoes="{ item }">
                <v-icon @click="editar(item)">edit</v-icon>
                <v-icon v-show="exibirExcluir" @click="remover(item)">clear</v-icon>
              </template>
            </v-data-table>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <slot name="alertas"></slot>

    <v-dialog v-model="dialog_remover" width="500">
      <v-card>
        <v-card-title>{{ trans("mensagem.tem_certeza_disso") }}</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="red" dark text @click="dialog_remover = false">
            <v-icon left>clear</v-icon>
            {{ trans("botao.cancelar") }}
          </v-btn>
          <v-btn
            color="green"
            dark
            text
            @click="
              dialog_remover = false;
              removeItem();
            "
          >
            <v-icon left>check</v-icon>
            {{ trans("botao.confirmar") }}
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-snackbar color="success" right top :timeout="3000" v-model="snackbar">
      {{ trans("mensagem.removido_com_sucesso") }}
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
import Moment from 'moment';
export default {
  data() {
    return {
      moment: Moment,
      overlay: false,
      showFilter: false,
      headers: [],
      options: {},
      itemParaRemover: {},
      dialog_remover: false,
      snackbar: false,
      snackbarError: false,
      erro: null,
    };
  },
  props: {
    cabecalho: {
      type: Array,
      default: null,
    },
    resultados: {
      type: Array,
      default: null,
    },
    entidade: {
      type: String,
      default: null,
    },
    exibirCadastrar: {
      type: Boolean,
      default: true,
    },
    exibirFiltro: {
      type: Boolean,
      default: true,
    },
    exibirExcluir: {
      type: Boolean,
      default: true,
    },
    itensPerPage: {
      type: Number,
      default: 10,
    },
    breadcrumb: {
      type: Array,
      default: null,
    },
  },
  mounted() {
    this.buscar();
    this.headers = this.cabecalho;
  },
  methods: {
    buscar: function () {
      this.$parent.buscar();
    },
    limpar: function () {
      this.$parent.limpar();
    },
    cadastrar: function () {
      window.location = "/" + this.entidade + "/create";
    },
    editar: function (item) {
      window.location = "/" + this.entidade + "/" + item.id + "/edit";
    },
    remover: function (item) {
      this.itemParaRemover = item;
      this.dialog_remover = true;
    },
    removeItem: function () {
      let ctr = this;
      this.overlay = true;
      axios.delete("/" + this.entidade + "/" + this.itemParaRemover.id).then(
        function (response) {
          ctr.snackbar = true;
          ctr.resultados.splice(ctr.resultados.indexOf(ctr.itemParaRemover), 1);
          ctr.overlay = false;
        },
        function (error) {
          ctr.erro = error.response.statusText;
          ctr.snackbarError = true;
          ctr.overlay = false;
        }
      );
    },
  }
};
</script>