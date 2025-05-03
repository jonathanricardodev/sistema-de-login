Sistema de Login - Projeto Web Completo

Este projeto é um sistema web completo para gerenciamento de usuários, desenvolvido com HTML, CSS, JavaScript, PHP e MySQL. Ele oferece funcionalidades de login, cadastro, recuperação de senha e administração de usuários, com suporte para usuários administradores.

Funcionalidades:

- Login: Autenticação de usuários com verificação de credenciais no banco de dados.
- Cadastro: Criação de novas contas com validação de dados e armazenamento seguro de senhas com hash.
- Recuperação de Senha: Envio de link por e-mail com token e expiração (1 hora).
- Gerenciamento de Usuários (admin): Listagem, edição (nome/email), redefinição de senha e exclusão de usuários via painel visual.
- Controle de Acesso: Usuários comuns e administradores têm páginas diferentes.
- Botão de acesso ao painel admin: exibido somente se o usuário for administrador, na página de boas-vindas.
- Alertas e Feedback: Mensagens de erro, sucesso e confirmação visual via alert().
- Efeito de Tremor: Campo de senha treme quando incorreto.
- Persistência de dados: O campo de e-mail permanece preenchido após erro de login.

Tecnologias Utilizadas:

- HTML: Estrutura das páginas
- CSS: Estilização moderna responsiva (botões, inputs, layout)
- JavaScript: Interatividade, fetch, controle dinâmico do DOM
- PHP: Backend, sessão, autenticação, envio de e-mail (PHPMailer)
- MySQL: Banco de dados com tabela de usuários

Estrutura do Projeto:

projeto-login/
├── css/
│   ├── style.css
│   └── admin.css
├── js/
│   ├── script.js
│   └── admin.js
├── php/
│   ├── cadastro.php
│   ├── login.php
│   ├── logout.php
│   ├── solicitar_reset.php
│   ├── processar_reset.php
│   ├── editar_usuario.php
│   ├── remover_usuario.php
│   ├── listar_usuarios.php
│   └── conexao.php
├── composer.json
├── composer.lock
├── vendor/phpmailer files
├── index.php
├── cadastro.html
├── recuperar_senha.html
├── redefinir_senha.php
├── welcome.php
├── admin.php
└── sql/
    └── banco.sql

Requisitos e Versões usadas:

- Apache: 2.4.62.1
- PHP: 8.3.14
- MySQL: 9.1.0 (MariaDB ou compatível)
- Composer para gerenciar dependências do PHPMailer

Instalação:

1. Clone ou extraia o projeto para a pasta `www` do WAMP/XAMPP.
2. Crie um banco de dados MySQL chamado `usuarios`.
3. Importe o arquivo `sql/banco.sql` no seu banco de dados.
4. Configure `php/conexao.php` com os dados do seu banco.
5. Configure `php/solicitar_reset.php` com as credenciais do seu e-mail (para envio do link de redefinição).
6. Acesse `http://localhost/index.php` no navegador.

Como Usar:

- Faça login ou cadastre um novo usuário.
- Para tornar um usuário administrador, altere o campo `is_admin` para `1` diretamente no banco de dados.
- Após login:
  - Usuários comuns são redirecionados para `welcome.php`.
  - Usuários admin também vão para `welcome.php`, com acesso a um botão que redireciona para `admin.php`.
- Em `admin.php`, é possível gerenciar usuários com ações como editar, resetar senha e excluir usuários.

Observações:

- Este projeto é educativo e pode ser expandido com mais recursos (validação backend, tokens, logs e etc).
- Segurança básica foi aplicada (hash de senha, proteção de sessão, token de recuperação).
- Recomendo a adição de tokens, reCAPTCHA e validação avançada em produção.

Desenvolvido por Jonathan Ricardo
https://www.linkedin.com/in/jonathan-ricardo/
