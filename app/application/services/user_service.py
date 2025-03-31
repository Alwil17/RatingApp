# app/application/services/user_service.py

from typing import List, Optional
from sqlalchemy.orm import Session
from app.domain.user import User
from app.infrastructure.repositories.user_repository import UserRepository
from app.application.schemas import UserCreateDTO, UserUpdateDTO

class UserService:
    def __init__(self, db_session: Session):
        self.repository = UserRepository(db_session)

    def create_user(self, user_data: UserCreateDTO) -> User:
        # Vérifier si l'email existe déjà
        existing_user = self.repository.get_by_email(user_data.email)
        if existing_user:
            raise ValueError("Un utilisateur avec cet email existe déjà.")
        return self.repository.create(user_data)

    def get_user_by_id(self, user_id: int) -> Optional[User]:
        return self.repository.get_by_id(user_id)

    def list_users(self) -> List[User]:
        return self.repository.list()

    def update_user(self, user_id: int, user_data: UserUpdateDTO) -> Optional[User]:
        return self.repository.update(user_id, user_data)

    def delete_user(self, user_id: int) -> bool:
        return self.repository.delete(user_id)
