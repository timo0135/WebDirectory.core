# WebDirectory.core

## Membres du groupe :
BENCHERGUI Timothée BIECHY Maxime DESPAQUIS Liam DIRAND Félicien

Toutes les taches ont été faite avec succès ! (y compris les tâches étendues)

## Installation du projet : 
- Récupérer le projet via le dépot git (git clone git@github.com:timo0135/WebDirectory.core.git)
- À la racine du projet créer un fichier ".env" et remplissez la avec les informations que l'on vous a donné.
- Au niveau du fichier docker_compose.yml, créez et lancez les containeurs avec la commande "docker compose up"
  
- Se rendre dans le dossier "admin/src" et exécutez la commande "composer install"
- Se rendre dans le dossier api/src" et exécutez la commande "composer install"

- Dans "admin/src/conf" créer un fichier "gift.db.conf.ini", remplissez ce fichier avec les informations que l'on vous a donné.
- Dans "api/src/conf" créer un fichier "gift.db.conf.ini", remplissez ce fichier avec les informations que l'on vous a donné.
- Ouvrir phpmyadmin en se rendant sur l'URL "localhost:54001" dans un navigateur
- Dans phpmyadmin, se rendre dans la base webDirectory puis importer le fichier sql/webDirectory-structures.sql puis le fichier sql/webDirectory-donnees.sql



L'application d'aministration et l'API sont prêt à l'emploi ! 

Vous pouvez trouver le site de l'administration à cette URL : http://docketu.iutnc.univ-lorraine.fr:54000 <br>
Vous pouvez trouver l'API à cette URL : http://docketu.iutnc.univ-lorraine.fr:54002/api/entrees
