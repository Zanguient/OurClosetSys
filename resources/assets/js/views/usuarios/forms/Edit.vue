<template>
  <v-form v-model="formSolicitacao" :lazy-validation="false">
    <v-row dense>
      <v-col cols="12" md="6">
        <v-text-field
          :label="trans('campo.nome')"
          v-model="model.nome"
          dense
          outlined
          :rules="[validacao.required]"
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="3">
        <datepicker v-model="model.data_nascimento" :init="model.data_nascimento" :rules="[validacao.required]" :texto="trans('campo.data_nascimento')"></datepicker>
      </v-col>

      <v-col cols="12" md="3">
        <v-text-field
          :label="trans('campo.telefone')"
          v-model="model.telefone"
          dense
          :rules="[validacao.required]"
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="4">
        <v-text-field
          :label="trans('campo.nome_pai')"
          v-model="model.nome_pai"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="4">
        <v-text-field
          :label="trans('campo.nome_mae')"
          v-model="model.nome_mae"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="4">
        <v-text-field
          :label="trans('campo.responsavel')"
          v-model="model.responsavel"
          dense
          :rules="[validacao.required]"
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="4">
        <v-textarea
          :label="trans('campo.diagnostico')"
          v-model="model.diagnostico"
          dense
          rows="3"
          :rules="[validacao.required]"
          outlined
          clearable
          clear-icon="clear"
        ></v-textarea>
      </v-col>

      <v-col cols="12" md="5">
        <v-text-field
          :label="trans('campo.colegio')"
          v-model="model.colegio"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="3">
        <v-text-field
          :label="trans('campo.contato')"
          v-model="model.contato"
          dense
          :rules="[validacao.required]"
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="4">
        <v-text-field
          :label="trans('campo.frequencia_semana')"
          v-model="model.frequencia_semana"
          dense
          :rules="[validacao.required]"
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="3">
        <datepicker v-model="model.data_inicio" :init="model.data_inicio" :texto="trans('campo.data_inicio')"></datepicker>
      </v-col>

      <v-col cols="12" md="5">
        <v-text-field
          :label="trans('campo.tamanho_pediasuit')"
          v-model="model.tamanho_pediasuit"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="4">
        <lista-usuarios v-model="model.user"></lista-usuarios>
      </v-col>

      <v-col cols="12" md="4">
        <v-text-field
          :label="trans('campo.valor_atendimento')"
          v-model="model.valor_atendimento"
          dense
          type="number"
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>
    </v-row>
  </v-form>
</template>

<script>
import Validacao from "../../../components/Validacao";
import Usuarios from "../../../components/lists/Usuarios";
import Datepicker from "../../../components/Datepicker";

export default {
  data() {
    return {
      model: {
        user_banks: [],
      },
      userBank_form: {},
      validacao: Validacao,
      formSolicitacao: false,
    };
  },
  props: ["id"],
  created() {
    if (this.id) {
      this.buscar(this.id);
    }
  },
  methods: {
    resetar: function () {
      this.model = {};
    },
    adicionarBanco() {
      let item = { ...this.userBank_form };
      this.model.user_banks.push(item);

      this.userBank_form = {};
    },
    removerBanco(index) {
      this.model.user_banks.splice(index, 1);
    },
    buscar: function (id) {
      let ctr = this;
      axios.post("/clients/buscar", { id: id }).then(function (response) {
        ctr.model = response.data[0];
        ctr.$emit("input", ctr.model);
      });
    },
  },
  watch: {
    model: {
      deep: true,
      handler(val, oldVal) {
        this.$emit("input", val);
      },
    },
    formSolicitacao: function (val) {
      this.$emit("validacaoFormulario", val);
    },
  },
  components: {
    "lista-usuarios": Usuarios,
    datepicker: Datepicker
  },
};
</script>