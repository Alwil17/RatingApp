# app/infrastructure/repository.py
from typing import List, Optional
from app.domain.models.rating import Rating, Base
from app.infrastructure.database import engine, SessionLocal

# Créer les tables si elles n'existent pas
Base.metadata.create_all(bind=engine)

class RatingRepository:
    def __init__(self):
        self.db = SessionLocal()

    def save(self, rating: Rating) -> Rating:
        self.db.add(rating)
        self.db.commit()
        self.db.refresh(rating)
        return rating

    def get_by_id(self, rating_id: int) -> Optional[Rating]:
        return self.db.query(Rating).filter(Rating.id == rating_id).first()

    def list(self) -> List[Rating]:
        return self.db.query(Rating).all()

    def delete(self, rating_id: int) -> None:
        rating = self.get_by_id(rating_id)
        if rating:
            self.db.delete(rating)
            self.db.commit()
