
# Conception de la Base de Données avec Merise

## Règles de Gestion
### 🔐 Utilisateurs et sécurité

1. Un utilisateur est identifié de manière unique par un identifiant (id).

2. Chaque utilisateur possède un nom d’utilisateur (username) unique et non vide.

3. Chaque utilisateur possède une adresse e-mail unique, valide, et obligatoire.

4. Le mot de passe est obligatoire, non vide et stocké de manière sécurisée (haché avec bcrypt).

5. La date de création du compte est enregistrée automatiquement.

6. À la création, un mot de passe temporaire est généré par l’administrateur.

7. Lors de la première connexion, l’utilisateur doit obligatoirement changer ce mot de passe temporaire.
8. L’authentification nécessite un e-mail et un mot de passe valides.

9. Seul un administrateur peut créer ou désactiver un compte utilisateur.

10. Le rôle d’un utilisateur (VISITEUR, EMPLOYE, ADMIN) est défini dans la base et utilisé pour filtrer l’accès aux ressources.

11. Les opérations de lecture, modification ou suppression sont sécurisées par JWT (JSON Web Tokens).

12. Les mots de passe ne sont jamais renvoyés dans les réponses de l’API.

13. Les données sont persistées dans une base PostgreSQL.

### ⚙️ Droits et rôles

14. Les visiteurs ne peuvent pas se connecter ; ils accèdent uniquement à des routes publiques (liste des animaux, nous contacter).

15. Seuls les employés et administrateurs peuvent se connecter via /login.

16. L’accès aux routes sensibles (ex. : /admin, /gestion-animaux, /utilisateurs) est réservé selon le rôle :

- ADMIN : accès total.

- EMPLOYE : accès aux animaux, messages, modification de son mot de passe.

17. L’interface d’administration est accessible uniquement aux administrateurs (/admin).

### 🐾 Gestion des animaux

18. Un animal est identifié de manière unique par un id.

19. Chaque animal possède un nom, une espèce, un âge, une description, une photo (optionnelle), et un statut (adopté, disponible, etc.).

20. Les animaux peuvent être consultés publiquement (même par des visiteurs).

21. Seuls les employés ou administrateurs peuvent créer, modifier ou supprimer les fiches des animaux.

22. Chaque fiche d’animal enregistre la date de création et la dernière mise à jour.

23. Chaque fiche est liée à l’employé qui l’a créée ou modifiée (traçabilité).

### 📩 Formulaire de contact

24. Le formulaire "Nous contacter" est accessible publiquement (par les visiteurs non connectés).

25. Un message contient : un nom, un e-mail valide, un sujet et un contenu.

26. Les messages sont stockés dans la base avec leur date d’envoi.

27. Seuls les employés et administrateurs peuvent lire et répondre aux messages.