from django.apps import AppConfig
from django.db.models.signals import post_migrate

def crear_roles_iniciales(sender, **kwargs):
    from .models import Rol
    roles = [
        {"nombre": "Admin", "color": "#e74c3c", "icono_url": "/static/roles/icons/admin.png"},
        {"nombre": "Developer", "color": "#3498db", "icono_url": "/static/roles/icons/developer.png"},
        {"nombre": "Lider", "color": "#f39c12", "icono_url": "/static/roles/icons/lider.png"},
        {"nombre": "Stakeholder", "color": "#2ecc71", "icono_url": "/static/roles/icons/stakeholder.png"},
        {"nombre": "Visitante", "color": "#95a5a6", "icono_url": "/static/roles/icons/visitante.png"},
    ]
    for r in roles:
        Rol.objects.get_or_create(nombre=r["nombre"], defaults={"color": r["color"], "icono_url": r["icono_url"]})

class RolesConfig(AppConfig):
    default_auto_field = "django.db.models.BigAutoField"
    name = "roles"

    def ready(self):
        post_migrate.connect(crear_roles_iniciales, sender=self)
