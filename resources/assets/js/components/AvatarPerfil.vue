<template>
  <div>
    <v-row>
      <v-col cols="auto" align="center" v-show="perfil">
        <span>
          <v-icon left>person</v-icon>{{perfil.nome}}
        </span>
        <logout></logout>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import Logout from "./Logout";
export default {
  data() {
    return {
      perfil: {},
    };
  },
  mounted() {
    if (logged) {
      this.buscarPerfil();
    }
  },
  methods: {
    buscarPerfil: function () {
      let ctr = this;
      axios.post("/profile", {}).then(function (response) {
        ctr.perfil = response.data;
      });
    },
  },
  components: {
    logout: Logout,
  },
};
</script>