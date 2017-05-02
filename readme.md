##Projeto de início de estudos no Laravel 

##Permissão projeto dentro do apache

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