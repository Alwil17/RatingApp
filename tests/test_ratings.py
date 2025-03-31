import pytest
from fastapi.testclient import TestClient
from httpx import AsyncClient
from app.api.main import app 

client = TestClient(app)


def test_create_rating():
    response = client.post("/ratings/", json={
        "value": "3",
        "user_id": "1",
        "item_id": "1",
        "comment": "It wasn't like in trailer."
    })
    assert response.status_code == 201
    assert response.json()["comment"] == "It wasn't like in trailer."


def test_get_ratings():
    response = client.get("/ratings")
    assert response.status_code == 200
