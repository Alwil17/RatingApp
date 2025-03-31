# app/application/services/item_service.py

from typing import List, Optional
from sqlalchemy.orm import Session
from app.domain.item import Item
from app.infrastructure.repositories.item_repository import ItemRepository
from app.application.schemas.item_dto import ItemCreateDTO, ItemUpdateDTO

class ItemService:
    def __init__(self, db_session: Session):
        self.repository = ItemRepository(db_session)

    def create_item(self, item_data: ItemCreateDTO) -> Item:
        return self.repository.create(item_data)

    def get_item_by_id(self, item_id: int) -> Optional[Item]:
        return self.repository.get_by_id(item_id)

    def list_items(self) -> List[Item]:
        return self.repository.list()

    def update_item(self, item_id: int, item_data: ItemUpdateDTO) -> Optional[Item]:
        return self.repository.update(item_id, item_data)

    def delete_item(self, item_id: int) -> bool:
        return self.repository.delete(item_id)
