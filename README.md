#📌 FastAPI Rating System

Ce projet est une API REST développée avec **FastAPI** permettant la gestion des utilisateurs, des items et des évaluations (ratings). Il suit une architecture modulaire et repose sur SQLAlchemy pour la gestion des données.

## 📂 Structure du projet
```
📁 app/
├── 📁 api/                 # Contient les routeurs FastAPI
│   ├── 📁 endpoints/       # Contients tous les endpoints 
│       ├── user_endpoints.py   # Endpoints liés aux utilisateurs
│       ├── item_endpoints.py   # Endpoints liés aux items
│       ├── rating_endpoints.py # Endpoints liés aux évaluations
│   └── main.py             # Point d'entrée principal de l'API
│
├── 📁 application/
│   ├── 📁 schemas/         # Définition des DTO et Response Models
│   ├── 📁 services/        # Contient la logique métier
│
├── 📁 domain/
│   ├── user.py             # Modèle SQLAlchemy pour les utilisateurs
│   ├── item.py             # Modèle SQLAlchemy pour les items
│   ├── rating.py           # Modèle SQLAlchemy pour les évaluations
│
├── 📁 infrastructure/
│   ├── database.py         # Configuration de la base de données
│   ├── repositories/       # Contient les classes d'accès aux données (repositories)
│
📁 resources/           # Contient les diagrammes UML
│   ├── schema.puml         # Schéma de la base de données (PlantUML)
│   ├── schema.png          # Version image du schéma de la BD
│   ├── sequence.puml       # Diagramme de séquence (PlantUML)
│   ├── sequence.png        # Version image du diagramme de séquence
│
├── requirements.txt        # Dépendances du projet
├── README.md               # Documentation du projet
```

##🛠️ Installation et Exécution
###1️⃣ Installation des dépendances

Assurez-vous d'avoir Python 3.8+ installé. Ensuite, créez un environnement virtuel et installez les dépendances :
```
python -m venv venv
source venv/bin/activate  # Sur Mac/Linux
venv\Scripts\activate     # Sur Windows

pip install -r requirements.txt
```
###2️⃣ Lancer l'application

Exécutez la commande suivante pour démarrer l'API :

`uvicorn app.api.main:app --reload`

L'API sera accessible sur : http://127.0.0.1:8000

## 📖 Documentation Swagger

Une documentation interactive est disponible sur :

- Swagger UI
- ReDoc

Les endpoints sont organisés en groupes :

- Users → `/users/...`
- Items → `/items/...`
- Ratings → `/ratings/...`

## 📊 Diagrammes UML

Des diagrammes UML ont été générés pour mieux comprendre l'architecture du projet :

### 🏗 Schéma de la base de données

- 📁 `resources/schema.puml` (PlantUML)
![DB Schema!](/resources/schema.png "DB Schema")

### 🔄 Diagramme de séquence

- 📁 `resources/sequence.puml` (PlantUML)
![Diagramme de séquence!](/resources/sequence.png "Diagramme de séquence")

### 🛠 Technologies utilisées

- FastAPI : Framework web rapide pour Python
- SQLAlchemy : ORM pour la gestion des bases de données
- PostgreSQL : Base de données relationnelle
- Uvicorn : Serveur ASGI performant
- PlantUML : Génération de diagrammes UML

## 🚀 Améliorations futures

* 🔹 Ajout d'une authentification via OAuth2
* 🔹 Mise en place de WebSockets pour les mises à jour en temps réel
* 🔹 Intégration d'un système de permissions avancé

## 📩 Contact

Si vous avez des questions, n'hésitez pas à me contacter ou à contribuer au projet ! 😃
