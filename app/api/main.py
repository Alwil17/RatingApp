from fastapi import FastAPI
import sentry_sdk
import uvicorn
from prometheus_fastapi_instrumentator import Instrumentator
from sentry_sdk.integrations.asgi import SentryAsgiMiddleware

# Importer la dépendance de la base de données
from app.api.endpoints import item_endpoints, rating_endpoints, user_endpoints
import app.api.auth as auth

# Initialise Sentry avec ton DSN (à stocker dans une variable d'environnement)
sentry_sdk.init(
    dsn="https://ebde5582bcacfec6cf360fa9d99c44d2@o4509075475398656.ingest.us.sentry.io/4509075477626880",
    # Add data like request headers and IP for users,
    # see https://docs.sentry.io/platforms/python/data-management/data-collected/ for more info
    send_default_pii=True,
    traces_sample_rate=1.0  # Ajuste en fonction de tes besoins
)

app = FastAPI(
    title="API de Rating",
    description="Une API REST pour gérer des ratings (notes) sur divers items.",
    version="1.0.0"
)

app.include_router(rating_endpoints.router)
app.include_router(user_endpoints.router)
app.include_router(item_endpoints.router)
app.include_router(auth.router)

# Instrumentation pour Prometheus
Instrumentator().instrument(app).expose(app)

app.add_middleware(SentryAsgiMiddleware)

# Lancer l'application si le fichier est exécuté directement
if __name__ == "__main__":
    uvicorn.run("app.api.main:app", host="127.0.0.1", port=8000, reload=True)
