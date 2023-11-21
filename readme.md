# Dashboard Web Application

Este é um projeto desenvolvido como parte do curso de Desenvolvimento Web. A aplicação apresenta um painel de controle (dashboard) construído utilizando HTML, PHP, jQuery e integração com um banco de dados MySQL para fornecer dados dinâmicos.

## Conteúdo do Repositório

- **index.html**: Página inicial da aplicação, que contém um menu de navegação e incorpora o painel de controle (`dashboard`) como parte da página principal.
  
- **dashboard.html**: Página que exibe o painel de controle com informações estatísticas. Nesta página, os dados são atualizados dinamicamente usando AJAX e jQuery, buscando informações no servidor PHP (`app.php`).

- **documentacao.html**: Página que fornece documentação ou informações adicionais sobre a aplicação.

- **suporte.html**: Página de suporte que pode conter informações de contato ou recursos de ajuda.

- **app.php**: Script PHP que se comunica com o banco de dados para fornecer dados dinâmicos para o painel de controle. Este script recebe parâmetros da requisição AJAX feita pela página `dashboard.html`.

- **script.js**: Arquivo JavaScript contendo código jQuery para manipulação de eventos e interação com a API do servidor.

- **style.css**: Arquivo CSS contendo estilos para a aplicação.

- **Bd.php**: Classe PHP para gerenciar a conexão com o banco de dados e recuperar dados para o painel de controle.

- **Dashboard.php**: Classe PHP que representa o modelo de dados para o painel de controle.

## Configuração do Ambiente

Certifique-se de ter um servidor web configurado (por exemplo, Apache) e um servidor MySQL em execução.

1. **Configuração do Banco de Dados:**
   - Crie um banco de dados chamado `dashboard`.
   - Importe o esquema do banco de dados usando o arquivo SQL fornecido (`database.sql`).

2. **Configuração da Conexão com o Banco de Dados:**
   - Atualize as informações de conexão no arquivo `Conexao.php` com as credenciais do seu banco de dados.

3. **Executando a Aplicação:**
   - Inicie seu servidor web.
   - Acesse a aplicação através do navegador usando o endereço `http://localhost/dashboard`.