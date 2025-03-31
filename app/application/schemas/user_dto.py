from pydantic import BaseModel, EmailStr, Field
from typing import Optional
from datetime import datetime

# ------------------------------
# User DTOs et Réponses
# ------------------------------

class UserCreateDTO(BaseModel):
    name: str = Field(..., max_length=100)
    email: EmailStr

class UserUpdateDTO(BaseModel):
    name: Optional[str] = Field(None, max_length=100)
    email: Optional[EmailStr] = None

class UserResponse(BaseModel):
    id: int
    name: str
    email: EmailStr
    created_at: datetime
    updated_at: datetime

    class Config:
        orm_mode = True
