from fastapi import APIRouter, Depends, HTTPException
from sqlalchemy.orm import Session
from app.application.schemas.user_dto import UserCreateDTO, UserUpdateDTO, UserResponse
from app.application.services.user_service import UserService
from app.infrastructure.database import get_db

router = APIRouter(prefix="/users", tags=["Users"])


@router.post("", response_model=UserResponse, status_code=201)
def create_user(user_data: UserCreateDTO, db: Session = Depends(get_db)):
    user_service = UserService(db)
    try:
        user = user_service.create_user(user_data)
    except ValueError as e:
        raise HTTPException(status_code=400, detail=str(e))
    return user

@router.get("/{user_id}", response_model=UserResponse)
def get_user(user_id: int, db: Session = Depends(get_db)):
    user_service = UserService(db)
    user = user_service.get_user_by_id(user_id)
    if not user:
        raise HTTPException(status_code=404, detail="User not found")
    return user

@router.get("", response_model=list[UserResponse])
def list_users(db: Session = Depends(get_db)):
    user_service = UserService(db)
    return user_service.list_users()

@router.put("/{user_id}", response_model=UserResponse)
def update_user(user_id: int, user_data: UserUpdateDTO, db: Session = Depends(get_db)):
    user_service = UserService(db)
    updated_user = user_service.update_user(user_id, user_data)
    if not updated_user:
        raise HTTPException(status_code=404, detail="User not found")
    return updated_user

@router.delete("/{user_id}", status_code=204)
def delete_user(user_id: int, db: Session = Depends(get_db)):
    user_service = UserService(db)
    success = user_service.delete_user(user_id)
    if not success:
        raise HTTPException(status_code=404, detail="User not found")
    return None
