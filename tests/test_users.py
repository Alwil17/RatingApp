import pytest
from fastapi.testclient import TestClient
from httpx import AsyncClient
from app.api.main import app 

client = TestClient(app)

def test_create_user():
    response = client.post("/items/", json={
        "name": "test user",
        "email": "test@example.com"
    })
    assert response.status_code == 201
    assert response.json()["name"] == "test user"
