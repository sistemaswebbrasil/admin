##Projeto de início de estudos no Laravel 

##Permissão projeto dentro do apache
sudo chgrp -R www-data /var/www/html/admin

##Rodar a aplicação com live reload
npm run watch

##Correção erro Error: watch app ENOSPC
echo fs.inotify.max_user_watches=524288 | sudo tee -a /etc/sysctl.conf && sudo sysctl -p