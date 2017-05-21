##Projeto simples com Laravel 5.4 , Zizaco/entrust para autorização e Vuetable2

##Projeto de início de estudos no Laravel 

*Erro na ultima importação
##Permissão projeto dentro do apache

sudo chmod 777 -R /var/www/html/admin

sudo chgrp -R www-data /var/www/html/admin

##Rodar a aplicação com live reload

npm run watch

##Correção erro Error: watch app ENOSPC

echo fs.inotify.max_user_watches=524288 | sudo tee -a /etc/sysctl.conf && sudo sysctl -p

##Importado o projeto Entrust https://github.com/Zizaco/entrust para autorização

##Limpar o cache deu uma view

php artisan view:clear


##Comandos para atualizar o repositório

git add *

git commit -m "Ainda apanhando"

git push origin master

##production.ERROR: RuntimeException: The only supported ciphers are AES-128-CBC and AES-256-CBC with the  correct key lengths.

php artisan key:generate

php artisan config:clear

##
chromium-browser --disable-web-security --user-data-dir

// Don't enforce the same-origin policy. (Used by people testing their sites.)
const wchar_t kDisableWebSecurity[] = L"disable-web-security";

chromium-browser --disable-web-security