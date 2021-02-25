<template>
  <v-tabs height="55px">
    <v-tab href="/movimentacoes">
      <v-icon left>sync_alt</v-icon>
      Movimentações
    </v-tab>
    <v-tab href="/estoque">
      <v-icon left>shopping_basket</v-icon>
      Estoque
    </v-tab>
    <v-tab href="/pecas">
      <v-icon left>sell</v-icon>
      Peças
    </v-tab>
    <v-tab href="/financeiro">
      <v-icon left>savings</v-icon>
      Financeiro
    </v-tab>
    <v-tab href="/categorias">
      <v-icon left>style</v-icon>
      Categorias
    </v-tab>
    <v-tab href="/usuarios">
      <v-icon left>groups</v-icon>
      Usuários
    </v-tab>
  </v-tabs>
</template>

<style>
a.v-tab {
  text-decoration: none !important;
}
</style>

<script>
export default {
  data() {
    return {
      perfil: {},
    };
  },
};
</script>