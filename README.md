# API de Rating avec FastAPI

Ce projet est une API REST minimaliste développée avec **FastAPI**. Elle permet de gérer un système de notation (rating) pour noter des éléments (produits, services, etc.). L’architecture est inspirée de la Clean Architecture et se divise en plusieurs couches afin de séparer clairement les responsabilités.

## Table des matières

- [Architecture du Projet](#architecture-du-projet)
- [Structure du Projet](#structure-du-projet)
- [Installation et Configuration](#installation-et-configuration)
- [Exécution de l'Application](#exécution-de-lapplication)
- [Endpoints Disponibles](#endpoints-disponibles)
- [Tests et Développement](#tests-et-développement)
- [Contributions](#contributions)
- [Licence](#licence)

## Architecture du Projet

Le projet s'organise en plusieurs couches afin d'assurer une bonne séparation des préoccupations :

1. **Domaine (Modèle Métier)**
    - **Rating** : entité principale qui contient les propriétés essentielles d'un rating :
        - `id` : identifiant unique
        - `value` : la note (ex. : nombre entre 0 et 5)
        - `comment` : un commentaire optionnel
        - `user_id` : identifiant de l’utilisateur qui a soumis la note
        - `item_id` : identifiant de l’élément noté
        - `created_at` et `updated_at` : pour le suivi temporel

2. **Application (Services et DTOs)**
    - **RatingDTO** : schéma Pydantic pour la validation des données d'entrée/sortie.
    - **RatingService** : contient la logique métier, par exemple pour créer, récupérer, mettre à jour et supprimer un rating. Il orchestre la conversion entre le DTO et l'entité et appelle le repository pour l'accès aux données.

3. **Infrastructure (Accès aux Données)**
    - **RatingRepository** : interface définissant les opérations (save, get_by_id, update, delete, list).
    - **SQLAlchemyRatingRepository** : implémentation concrète utilisant SQLAlchemy pour interagir avec une base de données SQLite (ou autre).

4. **API (Couche de Présentation)**
    - Les endpoints FastAPI exposent les routes REST (POST, GET, PUT, DELETE) et appellent le service pour exécuter la logique métier.
    - Les routes sont regroupées (par exemple dans un module `ratings.py`) afin de garder le fichier principal (`main.py`) propre.

---

## Structure du Projet

La structure du projet est organisée comme suit :

