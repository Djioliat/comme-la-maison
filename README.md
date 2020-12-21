Description :

“Comme à la maison” est un projet solidaire en cette période difficile de covid19 lancé par la Wild Code school de Tours, pour développer  une application web pour le restaurant (Comme à la maison) situé à Tours.


Le but :


Donner de la visibilité au restaurant, réserver,  commander ses plats favoris.

Contributeur :

Magali Guignard (Campus manager WCS de Tours)
Vincent Duguet (Développeur junior)
Yves Piquet (Développeur junior)
Louis Marquenet (Développeur junior)
Alexandre Verbreugh (Développeur junior)


Installation du projet :


git clone https://github.com/Djioliat/comme-la-maison.git

composer install 

Base de donnée connection :

1 : Dupliquer .env et renommer .en.local avec autentification avec mysql (DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name?serverVersion=5.7")
2 : php bin/console doctrine:database:create
3 : php bin/console make:migration
