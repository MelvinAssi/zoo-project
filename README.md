# Cahier des charges — Application Web “Zoo Manager”

## 1. Présentation du projet
### 1.1 Contexte
Le projet "Zoo Manager" est une application web éducative développée dans le cadre de la validation des compétences du parcours Développeur Web / Web Mobile. Réalisée entre le 6 et le 26 mai 2025, elle vise à simuler la gestion d’un zoo au travers d’une interface web moderne, intuitive et sécurisée.

Cette application permet d’administrer différentes entités telles que les animaux, les enclos et le personnel, tout en offrant une expérience utilisateur responsive, accessible sur ordinateur comme sur mobile.

### 1.2 Objectifs du projet
L’objectif principal de ce projet est de concevoir une application fonctionnelle, sécurisée, responsive et bien structurée, répondant aux standards actuels du développement web.

Le projet intègre les 8 compétences du référentiel développeur web, incluant notamment :

    . Le développement front-end et back-end,

    . La gestion de base de données,

    . La sécurité,

    . Le déploiement et la documentation.

L’application repose sur les technologies suivantes : Symfony, PostgreSQL, Docker, et Firebase (Firestore).

### 1.3 Cibles utilisateur
L’application distingue trois types d’utilisateurs :

    . Administrateurs : accès complet à toutes les fonctionnalités, dont la gestion des utilisateurs.

    . Employés : accès restreint à certaines fonctionnalités, sans droit de modification sur les comptes utilisateurs.

    . Visiteurs : accès libre aux pages publiques, sans authentification.

### 1.5 Périmètre du projet
    - Langue de l’interface : Français

    - Interface responsive (compatible desktop & mobile)

    - Environnement d’exécution : Docker local uniquement

## 2. Description graphique et ergonomique
### 2.1  Charte graphique 
La charte graphique définit les bases visuelles de l'application : couleurs principales, typographie, icônes et style général. L’objectif est de maintenir une cohérence visuelle sur l’ensemble des pages.

[<img src="docs/maquette/Charte%20graphique.png" alt="Charte graphique" height="400"/>](docs/maquette/Charte%20graphique.png)

### 2.3 Maquettes UI/UX 
La conception de l’interface utilisateur a suivi une méthode en deux temps :

🔹Wireframes

Les wireframes représentent l’ossature des différentes pages de l’application. Ils permettent de structurer les contenus et de valider la navigation avant la mise en forme visuelle.

https://www.figma.com/design/68Mon4jNhTuk1XMLstBUO9/zoo_project?node-id=0-1&p=f&t=ygc2lOJP1346gG0H-0

Les images des wireframes sont également disponibles dans le dossier : docs/maquette/wireframe.


🔹Mockups

Les mockups représentent l’apparence visuelle finale de l’application. Ils intègrent la charte graphique et donnent une vision claire du produit fini.

https://www.figma.com/design/68Mon4jNhTuk1XMLstBUO9/zoo_project?node-id=1-2&p=f&t=ygc2lOJP1346gG0H-0


[<img src="docs/maquette/Mockups/Desktop/HomePage.png" alt="HomePage" height="800"/>](docs/maquette/Mockups/Desktop/HomePage.png)

Le reste de le la maquette est a retrouver dans le dossier docs/maquette/Mockups/Desktop

Voici le responsive de la page Home:

[<img src="docs/maquette/Mockups/Responsive/HomePage_resposive.png" alt="HomePage" height="800"/>](docs/maquette/Mockups/Responsive/HomePage_resposive.png)

Le reste de le la maquette Responsive est a retrouver dans le dossier docs/maquette/Mockups/Responsive

Outils utilisés : Figma


## 3. Description fonctionnelle et technique
### 3.1 Arborescence du site
Accueil
Animaux
Connexion / Inscription
Contact
Gestion


### 3.2 Fonctionnalités
Authentification (admin/employé)

CRUD complet (animaux, enclos, utilisateurs)

API REST sécurisée (GET, POST, PUT, DELETE)

EasyAdmin pour la gestion

Firebase pour documents/logs

 Moteur de recherche, pagination, filtre : à confirmer si inclus

### 3.3 Types de contenus (à lister)
Textes : fiches, profils, messages

Médias : photos animaux/enclos

Documents : logs PDF Firebase 

### 3.4 Contraintes techniques
 - Symfony, Twig, Doctrine ORM

 - PostgreSQL, pgAdmin

 - Docker & Docker Compose

 - Front Twig + CSS 

 - Tests Postman, Regex de validation

 - Sécurité : JWT, CAPTCHA, Headers

## 4. Sécurité & RGPD

Afin de respecter les bonnes pratiques de sécurité et les exigences du RGPD :

 - Chiffrement sécurisé des mots de passe avec Argon2id

 - Authentification via JWT (JSON Web Token)

 - CAPTCHA sur les formulaires de connexion

 - Validation des champs via Regex

 - Gestion des cookies



## 5. Accessibilité & SEO
L'application intègre des efforts pour favoriser l’accessibilité et le référencement naturel (SEO) :

 - Navigation clavier possible

 - Contraste de couleurs conforme aux recommandations WCAG

 - Titres hiérarchisés de façon logique (H1 → H6)

 - Métadonnées HTML complètes : balises title, description

 - Audit via Lighthouse 

## 6. Méthodologie & Organisation

Le projet suit une méthode agile, structurée autour de sprints hebdomadaires et gérée via GitHub Projects en mode Kanban.

 - Branches Git utilisées : dev, test, main

 - Sprints de 7 jours

 - Documentation et communication :

    - Français pour les présentations (slides, soutenance)

    - Anglais pour le code et la documentation technique

## 7. Déploiement & documentation
Fichiers :

Dockerfile

docker-compose.yml

il y a 3 containers :

    - Symfony et Twig (front et back)
    - Server Nginx 
    - Database Postgres

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
8. Déploiement documenté	Docker 