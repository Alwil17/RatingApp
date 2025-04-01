from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from app.application.schemas.item_dto import ItemCreateDTO, ItemUpdateDTO, ItemResponse
from app.application.services.item_service import ItemService
from app.infrastructure.database import get_db
from app.api.security import oauth2_scheme, verify_token

router = APIRouter(prefix="/items", tags=["Items"])


@router.post("", response_model=ItemResponse, status_code=201)
def create_item(item_data: ItemCreateDTO, token: str = Depends(oauth2_scheme), db: Session = Depends(get_db)):
    # Vérifie le token ; renvoie le nom d'utilisateur ou lève une exception
    verify_token(token)
    item_service = ItemService(db)
    item = item_service.create_item(item_data)
    return item

@router.get("/{item_id}", response_model=ItemResponse)
def get_item(item_id: int, db: Session = Depends(get_db)):
    item_service = ItemService(db)
    item = item_service.get_item_by_id(item_id)
    if not item:
        raise HTTPException(status_code=404, detail="Item not found")
    return item

@router.get("", response_model=list[ItemResponse])
def list_items(token: str = Depends(oauth2_scheme), db: Session = Depends(get_db)):
    verify_token(token)
    item_service = ItemService(db)
    return item_service.list_items()

@router.put("/{item_id}", response_model=ItemResponse)
def update_item(item_id: int, item_data: ItemUpdateDTO, db: Session = Depends(get_db)):
    item_service = ItemService(db)
    updated_item = item_service.update_item(item_id, item_data)
    if not updated_item:
        raise HTTPException(status_code=404, detail="Item not found")
    return updated_item

@router.delete("/{item_id}", status_code=204)
def delete_item(item_id: int, db: Session = Depends(get_db)):
    item_service = ItemService(db)
    success = item_service.delete_item(item_id)
    if not success:
        raise HTTPException(status_code=404, detail="Item not found")
    return None
