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
      <v-tabs grow height="55px">
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              OS
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/orders/create">
              <i class="far fa-plus fa-fw mr-2"></i> Nova OS
            </v-list-item>
            <v-list-item href="/orders">
              <i class="far fa-list fa-fw mr-2"></i> Listar
            </v-list-item>
            <v-list-item href="/guarantees">
              <i class="far fa-sync-alt fa-fw mr-2"></i> Garantias
            </v-list-item>
          </v-list>
        </v-menu>
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              Venda
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/sales/create">
              <i class="far fa-plus fa-fw mr-2"></i> Nova Venda
            </v-list-item>
            <v-list-item href="/sales">
              <i class="far fa-list fa-fw mr-2"></i> Listar
            </v-list-item>
            <v-list-item href="/guarantees">
              <i class="far fa-sync-alt fa-fw mr-2"></i> Troca/Garantia
            </v-list-item>
          </v-list>
        </v-menu>
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              Clientes
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/clients">
              <i class="far fa-search fa-fw mr-2"></i> Consultar
            </v-list-item>
            <v-list-item href="/clients/create">
              <i class="far fa-plus fa-fw mr-2"></i> Cadastrar
            </v-list-item>
          </v-list>
        </v-menu>
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              Estoque
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/stocks">
              <i class="far fa-search fa-fw mr-2"></i> Consultar
            </v-list-item>
            <v-list-item href="/transaction_requisitions/create">
              <i class="far fa-random fa-fw mr-2"></i> Solicitar Transferência
            </v-list-item>
            <v-list-item href="#">
              <i class="far fa-arrow-right fa-fw mr-2"></i> Transferir
            </v-list-item>
            <v-list-item href="#">
              <i class="far fa-arrow-left fa-fw mr-2"></i> Saída
            </v-list-item>
            <v-list-item href="/transactions">
              <i class="far fa-exchange fa-fw mr-2"></i> Transferências
            </v-list-item>
          </v-list>
        </v-menu>
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              Administrativo
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/products_to_review">
              <i class="far fa-eye fa-fw mr-2"></i> Produtos a Revisar
            </v-list-item>
            <v-list-item href="#">
              <i class="far fa-history fa-fw mr-2"></i> Logs de Acesso
            </v-list-item>
          </v-list>
        </v-menu>

        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              Cadastros
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/users">
              <v-icon>users</v-icon> Usuários
            </v-list-item>
          </v-list>
        </v-menu>
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              Financeiro
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/payments">
              <i class="far fa-hand-holding-usd fa-fw mr-2"></i> Fluxo de Caixa
            </v-list-item>
            <v-list-item href="/payments">
              <i class="far fa-cash-register fa-fw mr-2"></i> Caixas
            </v-list-item>
          </v-list>
        </v-menu>
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              Relatórios
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/transactions">
              <i class="far fa-exchange fa-fw mr-2"></i> Movimentações de
              Estoque
            </v-list-item>
          </v-list>
        </v-menu>
        <v-menu offset-y>
          <template v-slot:activator="{ on, attrs }">
            <v-tab class="px-0" v-bind="attrs" v-on="on">
              Configurações
              <v-icon>keyboard_arrow_down</v-icon>
            </v-tab>
          </template>
          <v-list dense>
            <v-list-item href="/guarantees">
              <i class="far fa-sync-alt fa-fw mr-2"></i> Garantias
            </v-list-item>
            <v-list-item href="/location_origins">
              <i class="far fa-street-view fa-fw mr-2"></i> Origens
            </v-list-item>
            <v-subheader>Ordem de Serviços</v-subheader>
            <v-list-item href="/#">
              <i class="far fa-spinner fa-fw mr-2"></i> Satus da OS
            </v-list-item>
            <v-list-item href="/defect_categories">
              <i class="far fa-exclamation-triangle fa-fw mr-2"></i> Categorias
              de Defeitos
            </v-list-item>
            <v-list-item href="/defect_items">
              <i class="far fa-list fa-fw mr-2"></i> Itens de Defeitos
            </v-list-item>
            <v-list-item href="/additional_infos">
              <i class="far fa-info fa-fw mr-2"></i> Informações Adicionais
            </v-list-item>
            <v-subheader>Equipamentos</v-subheader>
            <v-list-item href="/brands">
              <i class="far fa-tag fa-fw mr-2"></i> Marcas
            </v-list-item>
            <v-list-item href="/models">
              <i class="far fa-grip-horizontal fa-fw mr-2"></i> Modelos
            </v-list-item>
            <v-list-item href="/colors">
              <i class="far fa-fill-drip fa-fw mr-2"></i> Cores
            </v-list-item>
          </v-list>
        </v-menu>
      </v-tabs>
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

.v-tab {
  text-transform: none !important;
  font-family: Arial, Helvetica, sans-serif;
  letter-spacing: 0;
}
.busca-geral .v-text-field__details {
  display: none !important;
}
a.v-list-item {
  text-decoration: none !important;
}
</style>

<script>
import AvatarPerfil from "./AvatarPerfil";
export default {
  data() {
    return {
    };
  },
  components: {
    "avatar-perfil": AvatarPerfil,
  },
};
</script>