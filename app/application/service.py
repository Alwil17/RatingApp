# app/application/service.py
from app.application.schemas import RatingDTO
from app.domain.models import Rating
from app.infrastructure.repository import RatingRepository

class RatingService:
    def __init__(self, repo: RatingRepository):
        self.repo = repo

    def create_rating(self, rating_dto: RatingDTO) -> Rating:
        rating = Rating(
            value=rating_dto.value,
            comment=rating_dto.comment,
            user_id=rating_dto.user_id,
            item_id=rating_dto.item_id
        )
        return self.repo.save(rating)

    def get_rating(self, rating_id: int) -> Rating:
        return self.repo.get_by_id(rating_id)

    # Méthodes update et delete à implémenter de façon similaire
