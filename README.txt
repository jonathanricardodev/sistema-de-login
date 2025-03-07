Este projeto é um sistema web completo para gerenciamento de usuários, desenvolvido com HTML, CSS, JavaScript, PHP e MySQL. Ele oferece funcionalidades de login, cadastro, recuperação de senha e gerenciamento de usuários, incluindo suporte para usuários administradores.

Funcionalidades:

Login: Autenticação de usuários com verificação de credenciais no banco de dados.
Cadastro: Criação de novas contas de usuário com validação de dados e armazenamento seguro de senhas (hash).
Recuperação de Senha: Envio de links de recuperação de senha para o email dos usuários.
Gerenciamento de Usuários: Listagem e gerenciamento de usuários existentes (exclusivo para administradores).
Controle de Acesso: Separação de usuários normais e administradores, com páginas de boas-vindas e administração específicas.
Alertas e Feedback: Exibição de alertas e mensagens de erro para melhorar a experiência do usuário.
Efeito de Tremor: efeito de tremor no campo de senha quando o usuário erra a senha.
Persistencia de dados: o campo de email continua preenchido caso o usuário erre a senha.
Tecnologias Utilizadas:

HTML: Estrutura das páginas web.
CSS: Estilização das páginas web.
JavaScript: Interatividade e funcionalidades no lado do cliente.
PHP: Lógica do lado do servidor e comunicação com o banco de dados.
MySQL: Armazenamento dos dados dos usuários.
Estrutura do Projeto:

projeto-login/
├── css/
│   └── style.css
├── js/
│   └── script.js
├── php/
│   ├── cadastro.php
│   ├── login.php
│   ├── recuperar_senha.php
│   └── gerenciamento_usuarios.php
├── index.html
├── cadastro.html
├── recuperar_senha.html
├── gerenciamento_usuarios.html
├── welcome.html
├── logout.php
└── sql
     └── banco.sql

Instalação:

Clone o repositório para o seu ambiente local.
Crie um banco de dados MySQL chamado usuarios.
Importe o arquibo banco.sql usuarios.
Configure as credenciais do banco de dados nos arquivos PHP (pasta php, nos arquivos login.php e cadastro.php).
Inicie um servidor web (como o WAMP ou XAMPP) e acesse a página index.html no seu navegador.
Como Usar:

Acesse a página de login (index.html).
Faça login com uma conta existente ou crie uma nova conta na página de cadastro.
Você pode dar permissões de administrador para um usuário alterando o valor de is_admin no banco de dados de 0 para 1.
Se você for um administrador, será redirecionado para a página de administração (admin_page.html). Caso contrário, será redirecionado para a página de boas-vindas (welcome.html).
Use as funcionalidades disponíveis para gerenciar usuários e realizar outras ações.
Observações:

Este projeto é um exemplo básico e pode ser aprimorado com mais funcionalidades e segurança.
Lembre-se de implementar práticas de segurança, como validação de entrada e proteção contra injeção de SQL.
Personalize o código e o design para atender às suas necessidades.