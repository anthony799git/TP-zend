# TP-Zend


## Using docker-compose

Pour lancer et faire fonctionner le site, voici les commandes à effectuer :

```bash

$ composer install
$ docker-compose up -d --build
$ sudo chown -Rv www-data:www-data data/*
$ docker-compose run --rm zf php vendor/bin/doctrine-module orm:schema-tool:update --force --dump-sql

```

Pour accéder au site : http://localhost:8180 .

Pour accéder à PhpMyAdmin du site  : http://localhost:8181 .
Les accès :
            - User: root
            - Password : demo
            
database : demo

Il faudra rajouter des organisateurs via phpmyadmin pour le liée à une Meetup si on veut.

