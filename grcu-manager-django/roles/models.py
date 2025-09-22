from django.db import models
from permisos.models import Permiso

class Rol(models.Model):
    nombre = models.CharField(max_length=50, unique=True)
    permisos = models.ManyToManyField(Permiso, related_name="roles", blank=True)
    color = models.CharField(max_length=7, default="#444c8a")  # color del badge en hex
    icono_url = models.URLField(blank=True, null=True)  # url de icono o imagen del rol

    def __str__(self):
        return self.nombre
