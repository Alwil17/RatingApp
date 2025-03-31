from pydantic import BaseModel, EmailStr, Field
from typing import Optional
from datetime import datetime

# ------------------------------
# Item DTOs et Réponses
# ------------------------------

class ItemCreateDTO(BaseModel):
    name: str = Field(..., max_length=200)
    description: Optional[str] = None

class ItemUpdateDTO(BaseModel):
    name: Optional[str] = Field(None, max_length=200)
    description: Optional[str] = None

class ItemResponse(BaseModel):
    id: int
    name: str
    description: Optional[str]
    created_at: datetime
    updated_at: datetime

    class Config:
        orm_mode = True
