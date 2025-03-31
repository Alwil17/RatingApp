# app/api/main.py

from fastapi import FastAPI, Depends, HTTPException
from sqlalchemy.orm import Session
import uvicorn

# Importer la dépendance de la base de données
from app.infrastructure.database import get_db

# Importer les schémas (DTOs et Response)
import app.application.schemas.item_dto
from app.application.schemas.rating_dto import RatingResponse, RatingUpdateDTO, RatingCreateDTO
import app.application.schemas.user_dto

# Importer le service
from app.application.services.rating_service import RatingService

app = FastAPI(
    title="API de Rating",
    description="Une API REST pour gérer des ratings (notes) sur divers items.",
    version="1.0.0"
)

# Endpoint pour créer un nouveau rating
@app.post("/ratings", response_model=RatingResponse, status_code=201)
def create_rating(rating_dto: RatingCreateDTO, db: Session = Depends(get_db)):
    rating_service = RatingService(db)
    try:
        rating = rating_service.create_rating(rating_dto)
    except ValueError as e:
        raise HTTPException(status_code=400, detail=str(e))
    return rating

# Endpoint pour récupérer un rating par ID
@app.get("/ratings/{rating_id}", response_model=RatingResponse)
def get_rating(rating_id: int, db: Session = Depends(get_db)):
    rating_service = RatingService(db)
    rating = rating_service.get_rating_by_id(rating_id)
    if not rating:
        raise HTTPException(status_code=404, detail="Rating not found")
    return rating

# Endpoint pour lister tous les ratings
@app.get("/ratings", response_model=list[RatingResponse])
def list_ratings(db: Session = Depends(get_db)):
    rating_service = RatingService(db)
    return rating_service.list_ratings()

# Endpoint pour mettre à jour un rating existant
@app.put("/ratings/{rating_id}", response_model=RatingResponse)
def update_rating(rating_id: int, rating_dto: RatingUpdateDTO, db: Session = Depends(get_db)):
    rating_service = RatingService(db)
    rating = rating_service.update_rating(rating_id, rating_dto)
    if not rating:
        raise HTTPException(status_code=404, detail="Rating not found")
    return rating

# Endpoint pour supprimer un rating
@app.delete("/ratings/{rating_id}", status_code=204)
def delete_rating(rating_id: int, db: Session = Depends(get_db)):
    rating_service = RatingService(db)
    success = rating_service.delete_rating(rating_id)
    if not success:
        raise HTTPException(status_code=404, detail="Rating not found")
    return None

# Lancer l'application si le fichier est exécuté directement
if __name__ == "__main__":
    uvicorn.run("app.api.main:app", host="127.0.0.1", port=8000, reload=True)
