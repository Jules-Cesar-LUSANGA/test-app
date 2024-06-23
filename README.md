# SoftDay Project

Ce projet a été créé pour le concours SoftDay. Il s'agit d'une application web qui permet la gestion CRUD (Création, Lecture, Mise à jour, Suppression) des evaluations.

## Fonctionnalités

- **Gestion des evaluations** : Les utilisateurs peuvent créer, lire, mettre à jour et supprimer des evaluations.
    - **Ajouts des questions** : Les utilisateurs peuvent créer, lire, mettre à jour et supprimer des questions.
        - **Ajouts des assertions** : Une question à choix multiple peux avoir plusieurs assertions.
- **Les étudiants peuvent présenter les évaluations et attendre la correction**
- **Les étudiants peuvent également refaire une évaluation avec l'autorisation de l'enseignant**
- **L'étudiant peut voir toutes les évaluations qu'il a passées et ses côtes**

## Installation

1. Clonez ce dépôt sur votre machine locale.
2. Exécutez `composer install` et `npm install` pour installer les dépendances du projet.
3. Copiez le fichier `.env.example` en `.env` et configurez vos variables d'environnement.
4. Exécutez `php artisan key:generate` pour générer une clé d'application.
5. Exécutez `php artisan migrate` pour créer les tables de la base de données.
6. Exécutez `php artisan serve` et `npm run dev` pour démarrer les serveurs de développement.

## Utilisation

Pour utiliser l'application, ouvrez `http://127.0.0.1:8000`.

## Contribution

Les contributions sont les bienvenues. Veuillez ouvrir une issue ou une pull request pour toute contribution.
