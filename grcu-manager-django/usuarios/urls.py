# usuarios/urls.py
from django.urls import path
from .views import lista_usuarios, crear_usuario, editar_usuario, eliminar_usuario

app_name = "usuarios"

urlpatterns = [
    path("", lista_usuarios, name="lista"),
    path("crear/", crear_usuario, name="crear"),
    path("editar/<int:pk>/", editar_usuario, name="editar"),
    path("eliminar/<int:pk>/", eliminar_usuario, name="eliminar"),
]
