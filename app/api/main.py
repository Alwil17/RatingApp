# app/api/main.py
from fastapi import FastAPI, HTTPException, Depends
from app.application.schemas.rating_dto import RatingDTO, RatingResponse
from app.application.service import RatingService
from app.infrastructure.repository import RatingRepository
from sqlalchemy.orm import Session
from app.infrastructure.database import SessionLocal

app = FastAPI()

# Dépendance pour obtenir la session de base de données
def get_db():
    db = SessionLocal()
    try:
        yield db
    finally:
        db.close()

# Pour l'instant, on instancie directement le repository et le service
rating_repo = RatingRepository()
rating_service = RatingService(rating_repo)

@app.post("/ratings", response_model=RatingResponse, status_code=201)
def create_rating(rating_dto: RatingDTO):
    rating = rating_service.create_rating(rating_dto)
    return rating

@app.get("/ratings/{rating_id}", response_model=RatingResponse)
def get_rating(rating_id: int):
    rating = rating_service.get_rating(rating_id)
    if not rating:
        raise HTTPException(status_code=404, detail="Rating not found")
    return rating

@app.get("/ratings", response_model=list[RatingResponse])
def list_ratings():
    return rating_repo.list()

# On peut ajouter PUT/PATCH/DELETE de manière similaire.
