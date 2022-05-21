#!/bin/bash

echo "Definindo permissoes da pasta de código-fonte..."
docker container exec controle-tarefas-laravel chmod 777 -R /root
sleep 1

echo "Executando o seed de dados de teste..."
docker container exec -it controle-tarefas-laravel bash -c "cd /root/app/app_controle_tarefas; php artisan db:seed;"
