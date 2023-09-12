#INSTALLATION 

=> Composer

composer install

=>Node Package Manager

npm install

#BASE DE DONNEES

php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate

ou 

symfony console doctrine:database:create
symfony console doctrine:migrations:migrate

#COMPILATION

yarn encore dev

# FIXTURES

Exécuter: 
php bin/console doctrine:fixtures:load
ou
symfony console doctrine:fixtures:load

Si faker non chargé : 
composer require fakerphp/faker
composer require pelmered/fake-car --dev



#SERVER

php bin/console server:start

ou

symfony server:start
