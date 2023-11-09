     ██▀███   ▄▄▄      ▄▄▄██▀▀▀▄▄▄       ██▀███  ▓█████ 
    ▓██ ▒ ██▒▒████▄      ▒██  ▒████▄    ▓██ ▒ ██▒▓█   ▀ 
    ▓██ ░▄█ ▒▒██  ▀█▄    ░██  ▒██  ▀█▄  ▓██ ░▄█ ▒▒███   
    ▒██▀▀█▄  ░██▄▄▄▄██▓██▄██▓ ░██▄▄▄▄██ ▒██▀▀█▄  ▒▓█  ▄ 
    ░██▓ ▒██▒ ▓█   ▓██▒▓███▒   ▓█   ▓██▒░██▓ ▒██▒░▒████▒
    ░ ▒▓ ░▒▓░ ▒▒   ▓▒█░▒▓▒▒░   ▒▒   ▓▒█░░ ▒▓ ░▒▓░░░ ▒░ ░
      ░▒ ░ ▒░  ▒   ▒▒ ░▒ ░▒░    ▒   ▒▒ ░  ░▒ ░ ▒░ ░ ░  ░
      ░░   ░   ░   ▒   ░ ░ ░    ░   ▒     ░░   ░    ░   
       ░           ░  ░░   ░        ░  ░   ░        ░  ░

## Wakiki

⚠Veuillez noter que Wakiki n'est en aucun cas affiliée au studio Ankama ni à son jeu Wakfu.⚠

Wakiki est une application Web utilisant le framework Laravel afin d'avoir un affichage poussé de vos combats sur Wakfu.<br>
L'application fonctionne grâce à vos logs chats ce qui les rend majoritairement inutilisables pour Ankama en cas de debug de leur part.
Wakiki permet de suivre :<br>
    - Dégats infligés<br>
    - Soins reçus<br>
    - Armures reçus<br>
    - Sorts lancés<br>

## Avertissement sur l'utilisation des logs chats de Wakfu

Wakiki utilise exclusivement les logs chats du jeu Wakfu à des fins d'affichage dans l'application. Aucune altération des fichiers originaux du jeu n'est effectuée. Les utilisateurs sont informés que l'utilisation de Wakiki peut rendre leurs logs chats inutilisables pour Ankama en cas de débogage de leur part.

## Clause de non-responsabilité

Wakiki décline toute responsabilité quant à tout impact sur l'expérience de jeu des utilisateurs de Wakfu. Les utilisateurs de Wakiki assument l'entière responsabilité de l'utilisation de l'application et comprennent que Wakiki n'est pas affiliée à Ankama.

## Pré-requis

Une version de php récente (avec .ini personnalisable) : https://www.php.net/downloads.php<br>
Un serveur mariadb : https://mariadb.org/download/<br>
Un logiciel de gestion de base de donnée (DBeaver) : https://dbeaver.io/download/<br>
Composer : https://mariadb.org/download/<br>
Un IDE (Visual Studio Code) : https://code.visualstudio.com/download/<br>

## Mise en place / Installation

1) Télécharger Wakiki
2) Créer une base de donnée nommé "wakiki"
3) Restaurer la base de donnée grâce au dump situé dans "database\dumps"
4) Configurer le .env :<br>
    DB_CONNECTION=mysql<br>
    DB_HOST=127.0.0.1<br>
    DB_PORT=3306<br>
    DB_DATABASE=wakiki<br>
    DB_USERNAME=VotreUser<br>
    DB_PASSWORD=VotreMotDePasse<br>
    
5) lancer le serveur avec la commande "php artisan serv"

## CGU Wakfu

https://www.wakfu.com/fr/cgu<br>
https://www.wakfu.com/fr/mmorpg/communaute/regles-jeu<br>

Pour rappel :

    TRICHE
    Il est interdit d'abuser d'un bug du jeu. Toute anomalie doit être reportée au Support dans la section correspondante.
    L'utilisation de programme tiers (type " bot ") est interdite.
    La modification du client WAKFU est interdite. Ceci englobe tous les fichiers présents dans le répertoire d'installation de WAKFU.

Wakiki n'étant pas un bot, ne procurant pas d'avantage en jeu et ne modifiant aucun fichier ce trouvant dans le répertoire d'installation de Wakfu est totalement légal et ne peut entrainer de sanction.
(Les logs ne font pas partie des fichiers présents dans le répertoire d'installation)

## Cher Ankama

Je tiens à vous informer que Wakiki, mon application web, est développée de manière indépendante. Si, par quelque raison que ce soit, l'existence de Wakiki suscitait des préoccupations ou du mécontentement de votre part, je tiens à souligner que je suis ouvert à la discussion et prêt à retirer le projet immédiatement. Mon objectif est de respecter les droits et les préoccupations de la communauté Wakfu ainsi que celles de Ankama. N'hésitez pas à me contacter pour discuter de toute question ou préoccupation que vous pourriez avoir.

Cordialement,
Rajare

