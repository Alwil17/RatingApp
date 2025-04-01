# app/infrastructure/database.py

from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
from app.domain.base import Base  # Importer Base depuis le fichier commun
import app.domain  # Ceci charge les modules user, item, rating via __init__.py

DATABASE_URL = "sqlite:///./ratings.db"

engine = create_engine(
    DATABASE_URL, 
    connect_args={"check_same_thread": False}  # Spécifique à SQLite
)

SessionLocal = sessionmaker(autocommit=False, autoflush=False, bind=engine)

def init_db():
    #Base.metadata.drop_all(bind=engine) # only in dev
    Base.metadata.create_all(bind=engine)

def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

# Créer les tables au démarrage
init_db()