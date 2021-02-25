<template>
  <v-app>
    <v-app-bar
      app
      style="
        background-color: linear-gradient(90deg, #242a33, #354052);
        height: 60px;
      "
      class="elevation-0"
      dark
    >
      <v-app-bar-nav-icon href="/home">
        <v-img width="35px" src="/images/logo-white.png"></v-img>
      </v-app-bar-nav-icon>
      <v-row class="ml-3" dense>
        <v-col cols="12">
          <h4>
            {{ $route.name }}
          </h4>
        </v-col>
      </v-row>
      <avatar-perfil class="ml-5"></avatar-perfil>
    </v-app-bar>
    <v-app-bar app style="height: 55px; margin-top: 60px" color="white">
      <menus></menus>
    </v-app-bar>

    <v-content style="margin-top: 60px">
      <v-container fluid>
        <v-layout justify-center>
          <router-view></router-view>
        </v-layout>
      </v-container>
    </v-content>
    <v-footer
      style="background-color: linear-gradient(90deg, #242a33, #354052)"
      app
    >
      <span class="white--text">&copy; 2021 -- airtonmrfilho@gmail.com -- (85) 9 9666-1555</span>
    </v-footer>
  </v-app>
</template>

<style>
.v-slide-group__prev {
  display: none !important;
}
</style>

<script>
import AvatarPerfil from "./AvatarPerfil";
import Menu from './Menu'
export default {
  data() {
    return {
    };
  },
  components: {
    "avatar-perfil": AvatarPerfil,
    "menus": Menu
  },
  mounted () {
    let ctr = this;
    setTimeout(function () {
      // window.location = ctr.$route.path;
    }, 2000)
  }
};
</script>