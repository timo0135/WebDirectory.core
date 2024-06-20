# Documentation API :

## Les routes :

### /api/services 
  - Renvoie une collection de departements avec leur id, nom, etage et description
  #### GET :
    optionnelle :
      sort=[nom de la colonne]-[ordre de trie (asc ou desc)]

### /api/entrees
  - Renvoie une collection d'entrées avec leur nom, prenom et la liste des départements dans lequel il appartient.
  #### GET :
    optionnelle :
      sort=[nom de la colonne]-[ordre de trie (asc ou desc)]

### /api/services/{id}
  - Renvoie une ressource avec toutes les informations du département concerné. (id, nom, etage et description)

### /api/entrees/search
  - Renvoie une collection d'entrées dont le nom ou le prenom contient la chaine de caractère passé dans le paramètre avec leur nom, prenom et la liste des départements dans lequel il appartient.
  #### GET :
    obligatoire :
      q=[chaine de caratère]
    optionnelle :
      sort=[nom de la colonne]-[ordre de trie (asc ou desc)]

### /api/entrees/{id}
  - Renvoie une ressource avec toutes les informations de l'entrée concerné. (id, nom, prenom, fonction, numeroBureau, numeroTel1, numeroTel2, email, statut, departement (liste de ces départements))

### /api/services/{id}/entrees
  - Renvoie une collection d'entrées appartenant au département concerné. (nom, prenom et la liste des départements dans lequel il appartient)
  #### GET :
      optionnelle :
        sort=[nom de la colonne]-[ordre de trie (asc ou desc)]

### /api/services/{departement_id}/entrees/search
  - Renvoie une collection d'entrées dont le nom ou le prenom contient la chaine de caractère passé dans le paramètre appartenant au département concerné. (nom, prenom et la liste des départements dans lequel il appartient)
  #### GET :
    obligatoire :
      q=[chaine de caratère]
    optionnelle :
      sort=[nom de la colonne]-[ordre de trie (asc ou desc)]

### /img/{image}
  - Renvoie l'image concerné
