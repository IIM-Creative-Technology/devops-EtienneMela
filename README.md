# Projet Symfony pour Devops
##### Ci-dessous une liste des actions utilisées ainsi que les problèmes encontrées et ce qui est prévu pour la suite
## CI

* Ajout de deux fichiers yaml, un pour le develop (preprod) l'autre pour main (prod). Les deux déclenchent les jobs lorsqu'il y'a une PR ou un push. 
  * Preprod est en APP_ENV=dev
  * Prod en APP_ENV=prod
* Ajout de divers test et controles :

 Nom | Action | Utilisation | Ajout de fichiers de configuration 
 ------ | ------ | ------ | -----
Php Linter| ``` michaelw90/PHP-Lint@master ``` | Déployer sur Heroku avec les secrets présents sur Github | Non 
Security Checker | ``` symfonycorp/security-checker-action@v2``` | Vérification des déprécations des dépendances Symfony | Non 
PhpStan| ```docker://oskarstark/phpstan-ga``` | Utlisé pour vérifier la cohérence et les erreurs du code après une installation composer --no-dev | Oui : ```phpstan.neon```
Yaml Lint| ```ibiqlik/action-yamllint@v1v``` | Linter Yaml pour les fichiers de config symfony | Oui : ```.yamllint.yml```
Heroku deploy| ```akhileshns/heroku-deploy@v3.5.6``` | Déployer sur Heroku avec les secrets présents sur Github | Oui : ```Procfile```
 ~~Remove File~~ | ```JesseTG/rm@v1.0.2``` | Supprimer un fichier pendant le fonctionnement des jobs (utilisé pour supprimer DataFixtures et empècher de lever l'erreur mais c'etait une mauvaise idée | - |


## Heroku

#### Les liens des Apps Heroku :

* [**Prod**](https://symfony-actions-main.herokuapp.com/)
* [**Preprod**](https://symfony-cicd-develop.herokuapp.com/) 

## Les problèmes encontrés

* Problèmes avec Heroku et conflit entre le composer —no-dev et Symfony qui se met en environnement dev par défaut. 
  * Corrigé en ajoutant la variable APP_ENV=prod sur l'app Heroku prod
  
* Problèmes lors de la création des fixtures avec PHPStan, qui lève une erreur avec l'existence d'un fichier Fixtures dont les dépendances ne sont pas installées 
  * Corrigé en ajoutant le fichier ```phpstan.neon``` ne prenant pas en compte les AppFixtures.php
  
* Problèmes avec le PhPLinter, des fois beaucoup trop strict 
  * Corrigé en rajoutant un fichier de configuration ```.yamllint.yml``` et en passant les erreurs bloquantes en warnings

* Erreur avec Heroku et WebProfiler bundle sur l'environnement preprod
  * Impossible de se mettre en dev sur heroku, mise de la variable APP_ENV=prod sur le Heroku Preprod.
  
* Erreur Symfony lors du lancement de l'application : Attempted to load class "WebProfilerBundle" from namespace "Symfony\Bundle\WebProfilerBundle"
  * En cours de correction

## Todos

* Corriger les bugs administrateurs
* Rajouter du contenu et compléter les entités
* Modifier et ajouter plus de fixtures et des tests pour celles-ci
