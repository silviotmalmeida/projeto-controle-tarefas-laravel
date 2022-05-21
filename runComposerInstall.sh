#!/bin/bash

echo "Definindo permissoes da pasta de código-fonte..."
docker container exec controle-tarefas-laravel chmod 777 -R /root
sleep 1

echo "Atualizando as dependências do projeto..."
docker container exec -it controle-tarefas-laravel bash -c "cd /root/app/app_controle_tarefas; composer install;"
