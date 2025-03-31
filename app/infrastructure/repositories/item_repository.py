from typing import List, Optional
from sqlalchemy.orm import Session
from app.domain.models import Item
from app.application.schemas import ItemCreateDTO, ItemUpdateDTO

class ItemRepository:
    def __init__(self, db: Session):
        self.db = db

    def create(self, item_data: ItemCreateDTO) -> Item:
        item = Item(**item_data.dict())
        self.db.add(item)
        self.db.commit()
        self.db.refresh(item)
        return item

    def get_by_id(self, item_id: int) -> Optional[Item]:
        return self.db.query(Item).filter(Item.id == item_id).first()

    def list(self) -> List[Item]:
        return self.db.query(Item).all()

    def update(self, item_id: int, item_data: ItemUpdateDTO) -> Optional[Item]:
        item = self.get_by_id(item_id)
        if not item:
            return None
        update_data = item_data.dict(exclude_unset=True)
        for key, value in update_data.items():
            setattr(item, key, value)
        self.db.commit()
        self.db.refresh(item)
        return item

    def delete(self, item_id: int) -> bool:
        item = self.get_by_id(item_id)
        if not item:
            return False
        self.db.delete(item)
        self.db.commit()
        return True
