from typing import List, Optional
from sqlalchemy.orm import Session
from app.domain.models import Rating
from app.application.schemas import RatingCreateDTO, RatingUpdateDTO

class RatingRepository:
    def __init__(self, db: Session):
        self.db = db

    def create(self, rating_data: RatingCreateDTO) -> Rating:
        # Crée une instance Rating à partir du DTO
        rating = Rating(**rating_data.dict())
        self.db.add(rating)
        self.db.commit()
        self.db.refresh(rating)
        return rating

    def get_by_id(self, rating_id: int) -> Optional[Rating]:
        return self.db.query(Rating).filter(Rating.id == rating_id).first()

    def list(self) -> List[Rating]:
        return self.db.query(Rating).all()

    def update(self, rating_id: int, rating_data: RatingUpdateDTO) -> Optional[Rating]:
        rating = self.get_by_id(rating_id)
        if not rating:
            return None
        update_data = rating_data.dict(exclude_unset=True)
        for key, value in update_data.items():
            setattr(rating, key, value)
        self.db.commit()
        self.db.refresh(rating)
        return rating

    def delete(self, rating_id: int) -> bool:
        rating = self.get_by_id(rating_id)
        if not rating:
            return False
        self.db.delete(rating)
        self.db.commit()
        return True
