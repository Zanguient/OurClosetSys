<template>
  <v-btn icon @click="logout">
    <i class="far fa-sign-out align-self-center text-white fa-lg mx-2"></i>
  </v-btn>
</template>

<script>
export default {
  data() {
    return {
    };
  },
  methods: {
    logout: function() {
      axios.post("/logout", this.loginForm).then(
        function(response) {
          console.log('vai pro home porra!');
          window.location = "/home";
        }
      );
    }
  }
};
</script>