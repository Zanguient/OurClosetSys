<template>
  <div>
    <v-row>
      <v-col cols="auto" align="center" v-show="perfil">
        <span v-if="perfil.current_store">
          <i class="far fa-store-alt fa-fw mr-1 text-white-50"></i> {{perfil.current_store.name}}
        </span>
        <span class="ml-3">
          <i class="far fa-user fa-fw mr-1 text-white-50"></i> {{perfil.username}}
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