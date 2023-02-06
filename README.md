# Hello World Api
Api de base avec le framework slim et une connexion MySQL.
Source : https://odan.github.io/2019/11/05/slim4-tutorial.html

## Installation
> composer update

### Setup de la BD
- Créez une base de données
- Modifier les informations de connexion dans le fichier config/settings.php
- Rouler le script ressource/createUserTable.sql dans la base de données crée pour tester la création d'un usager.

## Routes disponibles
| Méthodes | Route  | Description                      |
| -------- | ------ | -------------------------------- |
| GET      | /      | Message de bienvenue             |
| GET      | /greetings?langue=[fr,en,es,de]  | Affichage d'un message de bienvenue aléatoire           |

On peut ajouter le paramêtre langue à la route /greetings pour spécifier dans quelle langue on veut avoir notre message. Les valeurs possibles sont : 

- fr : Français
- en : Anglais
- es : Espagnol
- de : Allemand

```
/greetings?langue=fr
```

## Format des résultats : 

### /
```
{
    "success":true,
    "message":"Bienvenue à mon premier API!!"
}
```


### /greetings
```
{
    "codeLangue":"fr",
    "message":"Bonjour le monde"
}
```
