from fastapi.testclient import TestClient
import pytest
from httpx import AsyncClient
from app.api.main import app

client = TestClient(app)

# Test user creation, then authenticate to get token
def test_create_user_and_authenticate():
    # 1. Crate user
    create_user_payload = {
        "name": "Test User",
        "email": "testuser@example.com",
        "password": "testpassword"
    }
    response = client.post("/users/", json=create_user_payload)
    assert response.status_code == 201, response.text
    user_data = response.json()
    assert "id" in user_data

    # 2. Authenticate user to get token
    # /token endpoint is waiting for formdata
    form_data = {
        "username": create_user_payload["email"],
        "password": create_user_payload["password"]
    }
    response = client.post("/token", data=form_data)
    assert response.status_code == 200, response.text
    token_data = response.json()
    assert "access_token" in token_data
    token = token_data["access_token"]

    # 3. user token to access secured path (GET /users/{user_id})
    headers = {"Authorization": f"Bearer {token}"}
    response = client.get(f"/users/{user_data['id']}", headers=headers)
    assert response.status_code == 200, response.text
    fetched_user = response.json()
    assert fetched_user["email"] == create_user_payload["email"]


# Test item and rating creation
def test_create_item_and_rating():
    # 1. Créer un utilisateur et obtenir un token
    create_user_payload = {
        "name": "Item Tester",
        "email": "itemtester@example.com",
        "password": "testpassword"
    }
    response = client.post("/users/", json=create_user_payload)
    assert response.status_code == 201, response.text
    user_data = response.json()

    form_data = {
        "username": create_user_payload["email"],
        "password": create_user_payload["password"]
    }
    response = client.post("/token", data=form_data)
    assert response.status_code == 200, response.text
    token = response.json()["access_token"]
    headers = {"Authorization": f"Bearer {token}"}

    # 2. Créer un item
    create_item_payload = {
        "name": "Test Item",
        "description": "Ceci est un item de test."
    }
    response = client.post("/items/", json=create_item_payload, headers=headers)
    assert response.status_code == 201, response.text
    item_data = response.json()
    assert "id" in item_data

    # 3. Créer un rating pour cet item par l'utilisateur créé
    create_rating_payload = {
        "value": 4.5,
        "comment": "Very good !",
        "user_id": user_data["id"],
        "item_id": item_data["id"]
    }
    response = client.post("/ratings/", json=create_rating_payload, headers=headers)
    assert response.status_code == 201, response.text
    rating_data = response.json()
    assert rating_data["value"] == 4.5

    # 4. Lister les ratings et vérifier que le rating créé est présent
    response = client.get("/ratings/", headers=headers)
    assert response.status_code == 200, response.text
    ratings_list = response.json()
    assert any(r["id"] == rating_data["id"] for r in ratings_list)
