# app/infrastructure/database.py

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker

# Chaîne de connexion pour SQLite : le fichier 'ratings.db' sera créé dans le dossier courant.
DATABASE_URL = "sqlite:///./ratings.db"

# Création de l'engine SQLAlchemy
engine = create_engine(
    DATABASE_URL, 
    connect_args={"check_same_thread": False}  # nécessaire pour SQLite en multithreading
)

# Création de la session locale
SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

# Dépendance pour obtenir une session de base de données dans FastAPI
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()
