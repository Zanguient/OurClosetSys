## Our Closet Sys

Sistema para controle de estoque e gerenciamento financeiro, voltado para empresas de venda de roupas!

### Funcionalidades

##### Gerenciamento de Usuários
O sistema possui autenticação simples com cadastro de usuários, sem controle de permissão por funcionalidade.

##### Gerenciamento de Peças
O sistema possui um cadastro de peça onde ser possível definir o nome da peça, bem como o custo, o valor de venda e a categoria (as categorias são parametrizaveis)

##### Gerenciamento de Estoque
O sistema possui um gerenciamento de movimentações de estoque com 3 tipos de movimentaçes:

* Entrada no Estoque
  * Nesse tipo de movimentação será possível adicionar um produto (que já deve estar cadastrado) no estoque, definindo a quantidade e a cor.

* Saída de Estoque
  * Nesse tipo de movimentação será possível retirar produtos do estoque sem impactar o controle financeiro.

* Venda
  * Nesse tipo de movimentação será feita uma retirada de estoque do produto selecionado e será contabilizado no controle financeiro

##### Controle Financeiro
O sistema possui um dashboard com filtros de data e produto, para que seja possível consultar o lucro em qualquer período de tempo e até de um determinado produto.

### Tencologias Utilizadas

- Laravel Framework (v 5.5.*)
- vueJs (v ^2.5.7)
- vuetifyJs (v ^2.2.23)

### Criador

Jose Airton Moreira Filho
(85) 9 9666-1555