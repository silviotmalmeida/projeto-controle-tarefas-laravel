#!/bin/bash

echo "Definindo permissoes da pasta de código-fonte..."
docker container exec controle-tarefas-laravel chmod 777 -R /root
sleep 1

echo "Ativando o mailhog..."
docker container exec -it controle-tarefas-laravel bash -c "mailhog"
