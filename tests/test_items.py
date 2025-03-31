from fastapi.testclient import TestClient
import pytest
from httpx import AsyncClient
from app.api.main import app 

client = TestClient(app)


def test_create_item():
    response = client.post("/items/", json={
        "name": "Avatar movie",
        "description": "Rate the avatar movie"
    })
    assert response.status_code == 201
    assert response.json()["name"] == "Avatar movie"
