# Projeto CONTROLE-TAREFAS-LARAVEL

## Projeto construído durante o curso "Desenvolvimento Web Avançado 2022 com PHP, Laravel e Vue.JS" do professor Jorge Sant Ana.

Trata-se da implementação de um sistema de controle de tarefas.

O projeto encontra-se dockerizado para facilitar a implantação. As orientações para execução estão listadas abaixo:

- Criar e carregar a imagem docker super-gestao-laravel conforme passos da pasta image;

- Para iniciar o container utiliza-se o comando "sudo ./startContainers.sh";

- Para instalar as dependências do projeto utiliza-se o comando "sudo ./runComposerInstall.sh";

- Para aplicar as migrations utiliza-se o comando "sudo ./runMigrate.sh";

- Para criar uma massa de dados de teste utiliza-se o comando "sudo ./runSeed.sh";

- Para iniciar o servidor utiliza-se o comando "sudo ./runServer.sh";

- O sistema estará disponível na URL "0.0.0.0:8080";

- O dados para acesso da Área Restrita são:
    - Email: root@email.com
    - Senha: 123456

- Para encerrar a execução utiliza-se o comando "sudo ./stopContainers.sh";

Foram incluídos diversos comentários para facilitar o entendimento do código.


Principais comandos do laravel:

- Para criar um projeto laravel utiliza-se o comando: composer create-project --prefer-dist laravel/laravel nome-do-projeto "versão do laravel"

- Para adicionar o laravel ui utiliza-se o comando: composer require larave/ui:"versão"

- Para criar um controller utiliza-se o comando, na pasta raiz do projeto: php artisan make:controller nome-do-controller-Controller

- Para criar um controller com ações padrões pré-definidas utiliza-se o comando, na pasta raiz do projeto: php artisan make:controller --resource nome-do-controller-Controller

- Para criar um middleware utiliza-se o comando, na pasta raiz do projeto: php artisan make:middleware nome-do-middleware-Middleware

- Para criar uma model e sua migration utiliza-se o comando, na pasta raiz do projeto: php artisan make:model nome-da-model -m

- Para criar um seeder de dados utiliza-se o comando, na pasta raiz do projeto: php artisan make:seeder nome-da-model-Seeder

- Para criar uma factory de objetos utiliza-se o comando, na pasta raiz do projeto: php artisan make:factory nome-da-model-Factory --model=nome-da-model 

- Para aplicar as migrations utiliza-se o comando, na pasta raiz do projeto: php artisan migrate

- Para reverter as migrations utiliza-se o comando, na pasta raiz do projeto: php artisan migrate:rollback --step=número-de-passos-a-serem-revertidos

- Para criar listar as rotas disponíveis utiliza-se o comando, na pasta raiz do projeto: php artisan route:list


