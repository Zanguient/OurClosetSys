<template>
  <v-dialog v-model="dialog" fullscreen :persistent="true">
    <template v-slot:activator="{ on }">
      <v-btn icon dark v-if="!activated" v-on="on">
        <v-icon>exit_to_app</v-icon>
      </v-btn>
    </template>
    <v-row dense style="height: 100%; width: 100%; background-color: #ccc">
      <v-col md="7" sm="6">
        <v-card style="background-color: #CCC" class="elevation-0 mt-5">
          <v-card-text align="center">
            <v-img src="/images/logo.png" class="mb-3" width="150px"></v-img>
            <p color='#6c757d !important' font-size="40px">
              Our Close SYS
            </p>
          </v-card-text>
        </v-card>
        <v-card style="background-color: #ccc; padding-left: 100px; padding-right: 100px" class="elevation-0 mt-15">
          <v-card-text>
            <v-form v-model="form" :lazy-validation="false">
              <v-text-field
                :label="trans('campo.email')"
                name="email"
                outlined
                clearable
                append-icon="email"
                autocomplete="off"
                :rules="[validacao.required]"
                required
                v-model="loginForm.email"
              />
              <v-text-field
                id="password"
                :label="trans('campo.senha')"
                outlined
                clearable
                append-icon="lock"
                name="password"
                type="password"
                :rules="[validacao.required]"
                required
                v-model="loginForm.password"
              />
            </v-form>
            <v-expand-transition>
              <v-alert type="error" v-if="loginError" icon="warning"
                >Usuário ou Senha Incorretos.</v-alert
              >
            </v-expand-transition>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              color="primary"
              block
              @click="login"
              type="submit"
              :disabled="!form"
              >Entrar</v-btn
            >
          </v-card-actions>
        </v-card>
        <v-row>
          <v-col cols="12" align="center"> v 1.0.0_00 </v-col>
        </v-row>
      </v-col>
      <v-col
        sm="6"
        md="5"
        style="
          background-image: url('/images/wall.jpg');
          background-position: center;
          background-size: auto 100%;
        "
      ></v-col>
    </v-row>
  </v-dialog>
</template>

<script>
import Validacao from "./Validacao.vue";

export default {
  data() {
    return {
      dialog: false,
      form: false,
      loginForm: {
        username: null,
        password: null,
      },
      loginError: false,
      validacao: Validacao,
    };
  },
  props: {
    activated: {
      type: Boolean,
      default: false,
    },
  },
  mounted() {
    if (this.activated) {
      this.dialog = true;
    }
  },
  methods: {
    login: function () {
      let ctr = this;
      axios.post("/login", this.loginForm).then(
        function (response) {
          window.location = "/";
        },
        function (error) {
          ctr.loginError = true;
        }
      );
    },
    cancelar: function () {
      window.location = "/";
    },
  }
};
</script>