# app/application/schemas.py
from pydantic import BaseModel
from datetime import datetime
from typing import Optional

class RatingDTO(BaseModel):
    value: float
    comment: Optional[str] = None
    user_id: int
    item_id: int

class RatingResponse(RatingDTO):
    id: int
    created_at: datetime
    updated_at: datetime

    class Config:
        orm_mode = True
