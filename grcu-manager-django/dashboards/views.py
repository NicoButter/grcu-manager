from django.shortcuts import render
from accounts.models import Usuario
from roles.models import Rol
from permisos.models import Permiso
from django.contrib.auth.decorators import login_required
# Ojo: si todavía no tenés la app proyectos, podés comentar esa línea
# from proyectos.models import Proyecto  

@login_required
def admin_dashboard(request):
    total_usuarios = Usuario.objects.count()
    # Si aún no tenés proyectos, dejalo fijo en 0
    total_proyectos = 0  # Proyecto.objects.count()
    total_roles = Rol.objects.count()
    total_permisos = Permiso.objects.count()

    # ⚡ Acciones simuladas
    ultimas_acciones = [
        {"fecha": "2025-09-20 12:30", "usuario": "admin", "descripcion": "Creó un usuario"},
        {"fecha": "2025-09-19 18:45", "usuario": "nicolas", "descripcion": "Actualizó un proyecto"},
        {"fecha": "2025-09-18 09:10", "usuario": "soledad", "descripcion": "Asignó un rol"},
        {"fecha": "2025-09-18 08:30", "usuario": "martin", "descripcion": "Eliminó un permiso"},
        {"fecha": "2025-09-17 14:00", "usuario": "carla", "descripcion": "Inició sesión"},
    ]

    return render(request, "dashboards/admin_dashboard.html", {
        "total_usuarios": total_usuarios,
        "total_proyectos": total_proyectos,
        "total_roles": total_roles,
        "total_permisos": total_permisos,
        "ultimas_acciones": ultimas_acciones[:10],
    })
