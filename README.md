# Vite & Gourmand

Site web pour **Vite & Gourmand**, traiteur événementiel à Bordeaux : 
présentation de l'activité, 
consultation des menus, 
commande en ligne (panier + suivi de commande), 
avis clients, 
prise de contact et consultation des horaires. 
Le site dispose aussi d'un espace client (profil, authentification) et d'un back-office administrateur.

## Stack technique

- **Langage** :
- PHP 8.2.12 (VS16 X86 64bit thread safe) + PEAR

- **Bases de données** : 
- MariaDB (via PDO) pour les données relationnelles, MongoDB pour une partie des données (avis)
- MariaDB 10.4.32

- **Emails** : 
- PHPMailer 7.1.1

- **Front-end** : 
- PHP + CSS + JS natif

- **Outillage** : 
- Composer pour les dépendances PHP

- **Déploiement local** : 
- Docker Compose pour le déploiement local (PHP, MariaDB, PHPMyAdmin)

## Architecture du projet

```
(racine)
    Dockerfile              Image PHP 8.2 + Apache
    docker-compose.yml      Site + MariaDB + phpMyAdmin
    docker-entrypoint.sh    Crée le .env au démarrage du conteneur
    composer.json           Dépendances et autoload PSR-4
    phpunit.xml             Configuration des tests
    .env.example            Modèle des variables (sans secrets)
    .gitignore              Exclut .env, vendor/, notes
    Docs/                   Diagrammes, maquettes, BDD (si tu le gardes dans le dépôt)

src/
    Config/          Configuration (connexion MySQL, MongoDB, session, chemin racine (root_path), bootstrap, scripts SQL (tables, données de test))
    Controllers/     Logique de traitement des requêtes
    Entities/        objets métier (Utilisateur, Menu, Commandes…) sans SQL
    Interfaces/      Contrats/interfaces PHP
    Repositories/    Accès aux données (requêtes MySQL / MongoDB), la seule couche qui parle à la base de données
    Security/        Éléments liés à la sécurité (csrf)
    Services/        Logique métier réutilisable (calculs de prix (réduction, livraison) et distance (Haversine))
    Views/           Partials affichés (header, footer)
    .htaccess        (Require all denied) pour interdire l’accès direct aux fichiers du dossier src/ (Elle s’applique aux sous-dossiers (Controllers/, Repositories/…))

public/              Point d'entrée web (index.php) et pages par fonctionnalité
    admin/ 
    assets/        CSS, JS et images statiques
        css/
        js/
        images/
    auth/  
    avis/  
    commandes/  
    contact/  
    horaires/  
    legal/  
    menus/  
    panier/  
    profil/

tests/               Emplacement pour divers tests
    Controllers/     tests du contrôleur utilisateur
    Repositories/    tests d’accès aux données (nécessitent la base Docker)
    Services/        tests des calculs de tarification
    dev/             utiliser pour des tests lors du developpement
    .phpunit.cache/  Cache pour PHPUnit
    bootstrap.php    Bootstrap pour les tests (charge autoload et ROOT_PATH)

Docs/                    Dossiers regroupant les documents relatifs au projet
    Projet../
        BDD/
        Diagramme/      Emplacement des diagrammes de classes, de séquence, MCD et MLD
        Maquettes/      WIREFRAME et MOCKUP
```

## Tests

- **Tests** : 
- Les dossiers `/tests/Controllers`, `/tests/Repositories` et `/tests/Services` pour les tests PHPUnit.
- Les tests sont enregistrés dans `/tests/.phpunit.cache` .

- **Commandes de tests** : 
**Controllers**
```bash
vendor/bin/phpunit tests/Controllers/UtilisateurControllerTest.php
```

**Repositories**
```bash
vendor/bin/phpunit tests/Repositories/UtilisateurRepositoryMysqlTest.php
vendor/bin/phpunit tests/Repositories/CommandesRepositoryMysqlTest.php
```

**Tarification & distance**
```bash
vendor/bin/phpunit tests/Services/TarificationServiceTest.php
```

## Docker, images & lancement local

**Images** :
```bash
- PHP :
docker pull php:8.2-apache
- MariaDB :
docker pull mariadb:10.4.32-focal
- PHPMyAdmin :
docker pull phpmyadmin:5.2-apache
- Composer :
docker pull composer:2.10
```

Variables d'environnement à renseigner dans le fichier `.env` :
- `MYSQL_DSN`
- `MYSQL_USER`
- `MYSQL_PASS`
- `LOCATIONIQ_KEY`
- `MONGO_DSN`

Penser à faire une clé gratuite sur [LocationIQ](https://locationiq.com/) pour la géolocalisation.
Clé MONGODB gratuite sur [MongoDB Atlas](https://www.mongodb.com/fr-fr/cloud/atlas/register).

**Lancement local** :
```bash
git clone https://github.com/clippervofr-dotcom/vite-gourmand.git
cd vite-gourmand
cp .env.example .env ---> Renseigner les valeurs dans `.env`
docker compose up --build
```

## Railway 

- Création d'un token GitHub (Token Classic)
- Association Docker-GitHub 
```bash
`docker login ghcr.io --username <username> --password <git_hub_token>`
```
- Import de l'image vers GitHub
```bash
docker tag vite-gourmand-php ghcr.io/<username>/<nom_de_l\'image> (Modification du nom pour correspondre à GitHub)
docker push ghcr.io/<username>/<nom_de_l\'image>
```
- Création d'un projet Railway et Database MySQL native de Railway
- Import de l'image Docker depuis GitHub (`ghcr.io/<username>/<nom_de_l\'image>>`)
- Ajout des variables d'environnement dans le service PHP dans Railway (MONGO_DSN, MYSQL_DSN, MYSQL_USER, MYSQL_PASS, LOCATIONIQ_KEY)
- Déploiement du service PHP sur Railway

## Informations supplémentaires

J'ai utilisé XAMPP pour le développement local, et utilisé Docker vers la fin du développement, 
notamment pour la simplicité lors du déploiement. 
Le projet est déployé via une image Docker sur Railway, avec une base de données MySQL native de Railway et une base de données MongoDB hébergée sur MongoDB Atlas.

Une version de démonstration est disponible sur Railway (offre gratuite, arrêt automatique à partir du 25/09/2026) :
https://v-g-5-production.up.railway.app/

Une image Docker est également disponible sur GitHub :
https://github.com/clippervofr-dotcom/vite-gourmand/pkgs/container/v-g-5


## Licence

Projet à usage propriétaire (`license: proprietary`) réalisé dans le cadre d'un projet scolaire.

## Auteur

Djo
