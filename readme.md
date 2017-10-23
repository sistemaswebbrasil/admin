## Projeto simples com Laravel 5.4 e AdminLte

## Permissão projeto dentro do apache

sudo chmod 777 -R /var/www/html/admin

sudo chgrp -R www-data /var/www/html/admin

## Rodar a aplicação com live reload

npm run watch

## Correção erro Error: watch app ENOSPC

echo fs.inotify.max_user_watches=524288 | sudo tee -a /etc/sysctl.conf && sudo sysctl -p


## Limpar o cache de uma view

php artisan view:clear


## Comandos para atualizar o repositório

git add *

git commit -m "Ainda apanhando"

git push origin master

git add * && git commit -m "Ajustes" && git push origin master

## Atualiza o repositorio local com as atualizações dos externos
git pull

## git pull error: The following untracked working tree files would be overwritten by merge:

git clean  -d  -fx ""

## quando o pull falha por ter arquivos locais não atualizados
git stash save --keep-index
git stash drop


## Solução erro production.ERROR: RuntimeException: The only supported ciphers are AES-128-CBC and AES-256-CBC with the  correct key lengths.

php artisan key:generate

php artisan config:clear


## Exemplo Virtual Host
<VirtualHost *:80>
    ServerAdmin admin@sistemaswebbrasil.com
    ServerName admin.com
    ServerAlias www.admin.com   

    ServerAdmin adriano.faria@gmail.com
    DocumentRoot  /var/www/html/laravel/admin/public

    <Directory /var/www/html/admin/public>
         Options Indexes FollowSymLinks
         AllowOverride All
         Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/error.log
    ErrorLog /var/www/html/admin/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>

## Exemplo debugar sql:
    $debug = DB::table('menuacesso')            
    ->where('parent', 0,'')            
    ->orWhere('parent', 0,'')            
    ->toSql();      
    Log::info($debug);      

## Exemplo Log:
Log::info('Quantidade de Itens encontrados: '.count($subItems));
Log::info('Menu Final: '.print_r( $arrayMenu,true));---> Exibe formatado como array pulando linhas

## Sublime show/hide sidebar
Ctrl+K, Ctrl+B
