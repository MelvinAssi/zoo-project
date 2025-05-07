# Cahier des charges — Application Web “Zoo Manager”

## 1. Présentation du projet
### 1.1 Présentation du contexte
Application web éducative réalisée entre le 6 et le 26 mai 2025 dans le cadre d’un projet de validation des compétences développeur web / web mobile.
Objectif : gestion d’un zoo (animaux, enclos, personnel) via une interface web sécurisée.

### 1.2 Objectifs du projet
Créer une application fonctionnelle, sécurisée et responsive

Intégrer les 8 compétences du référentiel (front, back, BDD, sécurité, déploiement…)

Utiliser Symfony, PostgreSQL, Docker, Firebase

### 1.3 Cibles utilisateur
Administrateurs : accès complet

Employés : accès restreint

⚠️ Segmenter les rôles si besoin (soigneur, vétérinaire, etc.)

### 1.4 Objectifs quantitatifs
⚠️ Préciser si tu fixes un nombre d'utilisateurs simulés, objectifs API, etc.

### 1.5 Périmètre du projet
Langue : Français ,Anglais

Responsive design mobile & desktop

⚠️ Éventuel déploiement (Docker local uniquement ou aussi sur serveur distant ?)

### 1.6 Description de l’existant
Aucun site existant

⚠️ Nom de domaine : à indiquer si fictif ou localhost uniquement

⚠️ Ressources disponibles (logos, images, textes) à préciser

## 2. Description graphique et ergonomique
### 2.1 ⚠️ Charte graphique (à compléter)
Palette de couleurs (dominante, secondaire, accent)

Typographies utilisées

Logo principal  

Exemple d'autres sites dont tu t'inspires

### 2.2 ⚠️ Design général (à compléter)
Style souhaité (sobre, flat, coloré, etc.)

Effets visuels envisagés (parallaxe, animations, transitions, etc.)

### 2.3 ⚠️ Maquettes UI/UX (à livrer plus tard)
Zoning

Wireframes

Mockups

Outils utilisés : Figma, Canva…

## 3. Description fonctionnelle et technique
### 3.1 Arborescence du site
Accueil

Connexion / Inscription

Tableau de bord

Pages de gestion (animaux, enclos, utilisateurs)

API REST routes

### 3.2 Fonctionnalités
Authentification (admin/employé)

CRUD complet (animaux, enclos, utilisateurs)

API REST sécurisée (GET, POST, PUT, DELETE)

EasyAdmin pour la gestion

Firebase pour documents/logs

⚠️ Moteur de recherche, pagination, filtre : à confirmer si inclus

### 3.3 ⚠️ Types de contenus (à lister)
Textes : fiches, profils, messages

Médias : photos animaux/enclos

Documents : logs PDF Firebase ?

### 3.4 Contraintes techniques
Symfony 6+, Twig, Doctrine ORM

PostgreSQL, pgAdmin

Docker & Docker Compose

Front Twig + CSS (ou Tailwind/Bootstrap si utilisé)

Tests Postman, Regex de validation

Sécurité : CSRF, JWT, CAPTCHA, Headers

## 4. Sécurité & RGPD
CSRF Token dans les formulaires

Authentification sécurisée : bcrypt, JWT

CAPTCHA sur formulaire de connexion/inscription

Validation : Regex front et back

Bandeau cookie RGPD (via JS)

⚠️ Mention CNIL dans la présentation finale

## 5. Accessibilité & SEO
Navigation clavier

Contraste suffisant

Titres bien hiérarchisés

Métadonnées (title, description)

⚠️ Test d’accessibilité manuel ou avec outil comme Lighthouse à prévoir

## 6. Méthodologie & Organisation
Méthode agile (Kanban avec GitHub Projects)

Gestion via branches Git (dev, test, main)

Découpage en sprints de 7 jours

Communication en français (slides, pitch) et anglais (code, doc)

## 7. Déploiement & documentation
Fichiers :

Dockerfile

docker-compose.yml

INSTALL.md (explication claire et pas à pas)

⚠️ Rappeler comment accéder à l’API, à l’interface admin, aux tests…

## 8. Planning prévisionnel

| Date | Tâche principale |
|:-----:  |:-:      |
|6-9 mai	|Cahier des charges, maquettes, BDD (MERISE + UML)|
|10-15 mai	|Authentification, pages admin, Docker|
|16-20 mai	|CRUD API REST, Firebase, sécurité|
|21-25 mai	|Tests, responsive, SEO, accessibilité, présentation|
|26 mai	|Soutenance orale & rendu final|


## 9. Compétences visées du référentiel
Compétence	Intégration dans le projet
1. Env. de travail	Docker, Symfony, GitHub
2. Maquettage	Zoning, Wireframes, Mockups
3. UI statique	HTML, Twig, CSS responsive
4. UI dynamique	Twig + JavaScript (validation)
5. BDD relationnelle	PostgreSQL + Doctrine
6. SQL / NoSQL	PostgreSQL + Firebase
7. Composants métier	API REST Symfony
8. Déploiement documenté	Docker + INSTALL.md