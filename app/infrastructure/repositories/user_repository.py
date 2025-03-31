from typing import List, Optional
from sqlalchemy.orm import Session
from app.domain.user import User
from app.application.schemas.user_dto import UserCreateDTO, UserUpdateDTO

class UserRepository:
    def __init__(self, db: Session):
        self.db = db

    def create(self, user_data: UserCreateDTO) -> User:
        # Crée une instance User à partir du DTO
        user = User(**user_data.dict())
        self.db.add(user)
        self.db.commit()
        self.db.refresh(user)
        return user

    def get_by_id(self, user_id: int) -> Optional[User]:
        return self.db.query(User).filter(User.id == user_id).first()

    def get_by_email(self, email: str) -> Optional[User]:
        return self.db.query(User).filter(User.email == email).first()

    def list(self) -> List[User]:
        return self.db.query(User).all()

    def update(self, user_id: int, user_data: UserUpdateDTO) -> Optional[User]:
        user = self.get_by_id(user_id)
        if not user:
            return None
        update_data = user_data.dict(exclude_unset=True)
        for key, value in update_data.items():
            setattr(user, key, value)
        self.db.commit()
        self.db.refresh(user)
        return user

    def delete(self, user_id: int) -> bool:
        user = self.get_by_id(user_id)
        if not user:
            return False
        self.db.delete(user)
        self.db.commit()
        return True
