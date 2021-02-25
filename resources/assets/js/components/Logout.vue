<template>
  <v-btn icon @click="logout">
    <v-icon>logout</v-icon>
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