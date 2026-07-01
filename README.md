# Social Media PHP

Projeto de uma rede social desenvolvido em PHP Orientado a Objetos, com foco em boas práticas de arquitetura, separação de responsabilidades e evolução contínua do código.

O projeto foi criado com o objetivo de aprofundar conhecimentos em desenvolvimento backend utilizando PHP puro, implementando conceitos que normalmente são abstraídos por frameworks modernos, como Laravel.

## Funcionalidades

* Cadastro de usuários
* Login e logout
* Sistema de sessões
* Criação de publicações
* Upload de imagens
* Feed de publicações
* Sistema de curtidas
* Comentários em posts
* Sistema de seguidores
* Perfil de usuário
* Messenger privado entre usuários
* Atualização de mensagens utilizando AJAX
* Exibição da última mensagem nas conversas

## Tecnologias Utilizadas

* PHP
* MySQL / MariaDB
* PDO
* JavaScript
* AJAX
* HTML5
* CSS3

## Arquitetura

O projeto segue uma arquitetura inspirada no padrão MVC, com camadas adicionais para melhor organização e manutenção do código.

### Controllers

Responsáveis por receber as requisições, validar entradas e coordenar o fluxo da aplicação.

### Services

Contêm as regras de negócio da aplicação, reduzindo a responsabilidade dos controllers.

### Repositories

Responsáveis pela persistência e acesso aos dados utilizando PDO.

### Models

Representam as entidades da aplicação.

### Views

Responsáveis pela interface do usuário.

### Container de Dependências

Implementação de um container para gerenciamento e resolução de dependências, reduzindo acoplamento entre as camadas da aplicação.

## Principais Conceitos Praticados

* Programação Orientada a Objetos (POO)
* Arquitetura em camadas
* Separação de responsabilidades
* Injeção de dependência
* Container de serviços
* Repository Pattern
* Autenticação de usuários
* Manipulação de arquivos
* AJAX e atualização assíncrona de dados
* Relacionamentos em banco de dados
* Organização e refatoração de código

## Instalação

1. Clone o repositório:

```bash
git clone https://github.com/Jhnsk/social-media-php.git
```

2. Crie um banco de dados MySQL/MariaDB.

3. Copie o arquivo `Database.example.php` para `Database.php`.

4. Configure as credenciais de acesso ao banco.

5. Importe a estrutura das tabelas.

6. Execute o projeto utilizando XAMPP ou outro servidor PHP compatível.

## Objetivo do Projeto

Mais do que construir uma rede social funcional, este projeto tem como objetivo servir como laboratório de aprendizado para conceitos de desenvolvimento backend, arquitetura de software e boas práticas utilizando PHP puro.

Ao longo do desenvolvimento, o código vem sendo constantemente refatorado para aplicar padrões e princípios que tornam a aplicação mais organizada, escalável e de fácil manutenção.

## Contribuições e Feedback

Sugestões, críticas construtivas e feedbacks são sempre bem-vindos.

Se você tiver interesse em analisar a arquitetura ou apontar possíveis melhorias, fique à vontade para abrir uma issue ou entrar em contato.

## Autor

Jonathan Santos
