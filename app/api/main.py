from fastapi import FastAPI
import uvicorn

# Importer la dépendance de la base de données
from app.api.endpoints import item_endpoints, rating_endpoints, user_endpoints
import app.api.auth as auth


app = FastAPI(
    title="API de Rating",
    description="Une API REST pour gérer des ratings (notes) sur divers items.",
    version="1.0.0"
)

app.include_router(rating_endpoints.router)
app.include_router(user_endpoints.router)
app.include_router(item_endpoints.router)
app.include_router(auth.router)

# Lancer l'application si le fichier est exécuté directement
if __name__ == "__main__":
    uvicorn.run("app.api.main:app", host="127.0.0.1", port=8000, reload=True)
