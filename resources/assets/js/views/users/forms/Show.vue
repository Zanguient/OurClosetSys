<template>
  <v-form class="pa-5">
    <v-row dense>
      <v-col cols="12" md="6">
        <v-text-field
          :label="trans('campo.nome')"
          v-model="model.nome"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="3">
        <v-text-field
          :label="trans('campo.data_nascimento')"
          v-model="model.data_nascimento"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="3">
        <v-text-field
          :label="trans('campo.telefone')"
          v-model="model.telefone"
          dense
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
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="3">
        <v-text-field
          :label="trans('campo.data_inicio')"
          v-model="model.data_inicio"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
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

      <v-col cols="12" md="4" v-show="model.user">
        <v-text-field
          :label="trans('campo.funcionario_responsavel')"
          v-model="model.user.nome"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>

      <v-col cols="12" md="4">
        <v-text-field
          :label="trans('campo.valor_atendimento')"
          v-model="model.valor_atendimento"
          dense
          outlined
          clearable
          clear-icon="clear"
        ></v-text-field>
      </v-col>
    </v-row>

    <v-row>
      <v-col cols="12" md="12">
        <v-card class="elevation-8">
          <v-card-subtitle>Evoluções do Paciente</v-card-subtitle>
          <v-card-text>
            <v-col cols="12">
              <v-simple-table>
                <template v-slot:default>
                  <thead>
                    <tr>
                      <th class="text-left">{{trans('campo.data')}}</th>
                      <th class="text-left">{{trans('campo.responsavel')}}</th>
                      <th class="text-left">{{trans('campo.pre_teste')}}</th>
                      <th class="text-left">{{trans('campo.pos_teste')}}</th>
                      <th class="text-left">{{trans('campo.conduta')}}</th>
                      <th class="text-left">{{trans('campo.acoes')}}</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(evolution, index) in model.evolutions" :key="index">
                      <td>{{ evolution.data }}</td>
                      <td>{{ evolution.user.nome }}</td>
                      <td>{{ evolution.pre_teste }}</td>
                      <td>{{ evolution.pos_teste }}</td>
                      <td>{{ evolution.conduta }}</td>
                      <td align="center">
                        <v-icon small class="mr-2" @click="editar(evolution)">edit</v-icon>
                      </td>
                    </tr>
                    <tr v-show="model.evolutions.length == 0">
                      <td colspan="5">Nenhuma Evolução</td>
                    </tr>
                  </tbody>
                </template>
              </v-simple-table>
            </v-col>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-form>
</template>

<script>
export default {
  data() {
    return {
      model: {
        evolutions: [
        ]
      },
    };
  },
  props: ["init"],
  created() {
    if (this.init) {
      this.model = JSON.parse(JSON.stringify(this.init));
    }
  },
  methods: {
    editar: function (evolution) {
      window.location = '/evolutions/'+evolution.id+'/edit';
    }
  },
  watch: {
    init: function (newValue, oldValue) {
      if (newValue !== oldValue) {
        this.model = JSON.parse(JSON.stringify(newValue));
      }
    },
  },
};
</script>