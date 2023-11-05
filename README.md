## Wakiki

Wakiki est une application Web utilisant le framework Laravel afin d'avoir un affichage poussé de vos combats sur Wakfu.<br>
L'application fonctionne grâce à vos logs chat ce qui les rends majoritairement inutilisables pour Ankama en cas de debug de leur part.
Wakiki permet de suivre :<br>
    - Dégats infligés<br>
    - Soins reçus<br>
    - Armures reçus<br>
    - Sorts lancés<br>

## Pré-requis

Une version de php récente (avec .ini personnalisable) : https://www.php.net/downloads.php
Un serveur mariadb : https://mariadb.org/download/
Un logiciel de gestion de base de donnée (DBeaver) : https://dbeaver.io/download/
Composer : https://mariadb.org/download/
Un IDE (Visual Studio Code) : https://code.visualstudio.com/download/

## Mise en place / Installation

1) Télécharger Wakiki
2) Créé une base de donnée nommé "wakiki"
3) Restauré la base de donnée grâce au dump situé dans "database\dumps"
4) Configurer le .env :<br>
    DB_CONNECTION=mysql<br>
    DB_HOST=127.0.0.1<br>
    DB_PORT=3306<br>
    DB_DATABASE=wakiki<br>
    DB_USERNAME=VotreUser<br>
    DB_PASSWORD=VotreMotDePasse<br>
    
5) lancer le serveur avec la commande "php artisan serv"

## CGU Wakfu

Pour rappel :

    TRICHE
    Il est interdit d'abuser d'un bug du jeu. Toute anomalie doit être reportée au Support dans la section correspondante.
    L'utilisation de programme tiers (type " bot ") est interdite.
    La modification du client WAKFU est interdite. Ceci englobe tous les fichiers présents dans le répertoire d'installation de WAKFU.

Wakiki n'étant pas un bot, ne procurant pas d'avantage en jeu et ne modifiant aucun fichier ce trouvant dans le répertoire d'installation de Wakfu est totalement légal et ne peut entrainer de sanction.
(Les logs ne font pas partie des fichiers présents dans le répertoire d'installation)
