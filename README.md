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
src/
├── Config/         Configuration (connexion MySQL, MongoDB, session, chemin racine, bootstrap)
├── Controllers/     Logique de traitement des requêtes
├── Entities/        Objets métier (représentation des données)
├── Interfaces/       Contrats/interfaces PHP
├── Repositories/     Accès aux données (requêtes MySQL / MongoDB)
├── Security/         Éléments liés à la sécurité (auth, protections)
├── Services/         Logique métier réutilisable
└── Views/           Templates et partials affichés (header, footer, etc.)

public/              Point d'entrée web (index.php) et pages par fonctionnalité
├── admin/ auth/  avis/  commandes/  contact/  horaires/  legal/  menus/  panier/  profil/
└── assets/          CSS, JS et images statiques

tests/               Emplacement pour les tests (Controllers, Repositories, Services)
```

## Tests

- **Tests** : 
- les dossiers `/tests/Controllers`, `/tests/Repositories` et `/tests/Services` pour les tests PHPUnit.
- les tests sont enregistrés dans `/tests/.phpunit.cache` .

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
`docker login ghcr.io --username <username> --password <token>`
```
- Import de l'image vers GitHub
```bash
docker tag vite-gourmand-php ghcr.io/<username>/vite-gourmand-php:latest (Modification du nom pour correspondre à GitHub)
docker push ghcr.io/<username>/vite-gourmand-php:latest 
```
- Création d'un projet Railway et Database MySQL native de Railway
- Import de l'image Docker depuis GitHub (`ghcr.io/<username>/vite-gourmand-php:latest`)
- Ajout des variables d'environnement dans le service PHP dans Railway (MONGO_DSN, MYSQL_DSN, MYSQL_USER, MYSQL_PASS)
- Déploiement du service PHP sur Railway

## Licence

Projet à usage propriétaire (`license: proprietary`) réalisé dans le cadre d'un projet scolaire.

## Auteur

Djo
