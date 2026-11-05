# 💗 Closet Virtual

**Um cantinho digital para organizar suas roupas!**

O **Closet Virtual** é uma aplicação web desenvolvida como projeto acadêmico para a disciplina de **Programação Web**, do curso de **Análise e Desenvolvimento de Sistemas**.

A proposta é facilitar a organização de peças de roupa em um só lugar, com uma interface simples, intuitiva e em tons de rosa.

O sistema permite criar uma conta, fazer login e manter um catálogo pessoal de roupas, registrando informações como categoria, cor, estação e ocasião de uso.

## ✨ Funcionalidades

- **Cadastro e login de usuários**, com armazenamento seguro de senhas utilizando hash.
- **Autenticação por sessões**, restringindo o acesso às páginas internas.
- **Cadastro de peças de roupa**, incluindo nome, categoria, cor, estação e ocasião.
- **Visualização do closet** em uma tabela organizada.
- **Filtros por categoria** para facilitar a busca de peças.
- **Edição de roupas** previamente cadastradas.
- **Organização individual**, permitindo que cada usuário acesse somente suas próprias peças.
- **Logout** para encerramento da sessão.

## 🛠️ Tecnologias utilizadas

- **PHP:** desenvolvimento da lógica e autenticação.
- **HTML5:** estrutura das páginas.
- **CSS3:** estilização e identidade visual.
- **MySQL:** armazenamento e gerenciamento dos dados.
- **XAMPP:** ambiente de desenvolvimento local.

## 🚀 Como executar o projeto

1. Instale o [XAMPP](https://www.apachefriends.org/pt_br/index.html).
2. Coloque a pasta `closet_virtual` dentro do diretório `htdocs` do XAMPP.
3. Inicie os serviços **Apache** e **MySQL**.
4. Acesse `http://localhost/phpmyadmin/`.
5. Importe o arquivo `banco.sql`, que criará o banco de dados e suas tabelas.
6. Verifique as configurações de conexão no arquivo `conexao.php`.
7. Acesse o sistema pelo navegador:

`http://localhost/closet_virtual/login.php`

### 👤 Acesso de demonstração

O banco de dados inclui um usuário de teste:

- **E-mail:** teste@email.com
- **Senha:** 123456

Também é possível criar uma nova conta diretamente pelo sistema.

> **Observação:** este projeto foi desenvolvido para fins acadêmicos e execução local. As credenciais de teste não devem ser utilizadas em produção.

## 📚 Aprendizados

Durante o desenvolvimento deste projeto, pude colocar em prática conhecimentos adquiridos na disciplina de Programação Web, principalmente relacionados a:

- Integração entre PHP e MySQL.
- Desenvolvimento de formulários e validação de dados.
- Manipulação de registros no banco de dados.
- Autenticação e gerenciamento de sessões.
- Consultas SQL preparadas.
- Organização da estrutura de uma aplicação web.
- Criação de interfaces com HTML e CSS.

Além dos aspectos técnicos, o projeto foi uma oportunidade de unir programação e criatividade, desenvolvendo uma aplicação com identidade visual própria.

## 🎓 Sobre o projeto

Projeto acadêmico desenvolvido para a disciplina de **Programação Web**, do curso de **Análise e Desenvolvimento de Sistemas**.

**Desenvolvido por Nathaly Ferraz.** 💕
