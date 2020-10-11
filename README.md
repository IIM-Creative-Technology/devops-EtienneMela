# Projet Symfony pour Devops
  - Ci-dessous une liste des actions utilisées ainsi que les problèmes encontrées et ce qui est prévu pour la suite
## CI

  - Ajout de deux fichiers yaml, un pour le develop (preprod) l'autre pour main (prod). Les deux déclenchent les jobs lorsqu'il y'a une PR ou un push.
  - Ajout de divers test et controles :

  | Nom | Action | Utilisation | Ajout de fichiers de configuration |
| ------ | ------ | ------ | ----- |
|Php Linter| ``` michaelw90/PHP-Lint@master ``` | Déployer sur Heroku avec les secrets présents sur Github | Non |
|Security Checker | ``` symfonycorp/security-checker-action@v2``` | Vérification des déprécations des dépendances Symfony | Non |
|PhpStan| ```docker://oskarstark/phpstan-ga``` | Utlisé pour vérifier la cohérence et les erreurs du code après une installation composer --no-dev | Oui : ```phpstan.neon```|
|Yaml Lint| ```ibiqlik/action-yamllint@v1v``` | Linter Yaml pour les fichiers de config symfony | Oui : ```.yamllint.yml```|
|Heroku deploy| ```akhileshns/heroku-deploy@v3.5.6``` | Déployer sur Heroku avec les secrets présents sur Github | Oui : ```Procfile```|
| Remove File (n'est plus utilisé) | ```JesseTG/rm@v1.0.2``` | Supprimer un fichier pendant le fonctionnement des jobs (utilisé pour supprimer DataFixtures et empècher de lever l'erreur mais c'etait une mauvaise idée | / |

## Les problèmes encontrés

  - Problèmes avec Heroku et conflit entre le composer —no-dev et Symfony qui se met en environnement dev par défaut. Corrigé en ajoutant la variable APP_ENV = prod dans Heroku.
  - Problèmes lors de la création des fixtures avec PHPStan, qui lève une erreur avec l'existence d'un fichier Fixtures dont les dépendances ne sont pas installées -> problème résolu en ajoutant un fichier Neon ne prenant pas en compte les AppFixtures.php
  - Problèmes avec le PhPLinter, des fois beaucoup trop strict

## Todos

  - Corriger les bugs administrateurs
  - Rajouter du contenu
  - Modifier et ajouter plus de fixtures et des tests en découlant
