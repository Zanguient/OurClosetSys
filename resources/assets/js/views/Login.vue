<template>
  <login :activated="true"></login>
</template>

<script>
import Login from "../components/Login";

export default {
  data() {
    return {};
  },
  components: {
    login: Login,
  },
};
</script>