from django.shortcuts import redirect, render
from django.contrib.auth.decorators import login_required
from django.contrib.auth import login, logout
from google.oauth2 import id_token
from google.auth.transport import requests as grequests
from urllib.parse import urlencode
from django.conf import settings
from .models import Usuario
import requests
from django.contrib import messages
from roles.models import Rol
from django.core.validators import validate_email
from django.core.exceptions import ValidationError

def setup_admin(request):
    # Si ya hay un admin, redirige al login
    if Usuario.objects.filter(roles__nombre__iexact="admin").exists():
        return redirect("accounts:login")

    if request.method == "POST":
        email = request.POST.get("email")
        email_confirm = request.POST.get("email_confirm")

        if email != email_confirm:
            messages.error(request, "Los correos no coinciden.")
            return render(request, "accounts/setup_admin.html")

        try:
            validate_email(email)
        except ValidationError:
            messages.error(request, "Debés ingresar un email válido.")
            return render(request, "accounts/setup_admin.html")

        user, created = Usuario.objects.get_or_create(
            email=email,
            defaults={"is_active": True, "nombre": "Administrador"}
        )

        rol_admin, _ = Rol.objects.get_or_create(nombre="admin")
        user.roles.add(rol_admin)
        user.save()

        # Renderizar una vista de éxito con un botón "Aceptar"
        return render(request, "accounts/setup_admin_success.html", {"email": email})

    return render(request, "accounts/setup_admin.html")


def login_view(request):
    # Verificar si hay usuarios en la base de datos
    if not Usuario.objects.exists():
        return redirect("accounts:setup_admin")
    
    return render(request, "accounts/login.html")

@login_required
def logout_view(request):
    logout(request)
    return redirect("accounts:login")


def google_login_redirect(request):
    params = {
        "client_id": settings.GOOGLE_CLIENT_ID,
        "redirect_uri": request.build_absolute_uri("/accounts/google/callback/"),
        "response_type": "code",
        "scope": "openid email profile",
        "access_type": "offline",
        "prompt": "consent"
    }
    url = "https://accounts.google.com/o/oauth2/v2/auth"
    return redirect(f"{url}?{urlencode(params)}")

# def google_login_callback(request):
#     code = request.GET.get("code")
#     if not code:
#         return redirect("accounts:login")

#     # Solicitud del token
#     token_url = "https://oauth2.googleapis.com/token"
#     redirect_uri = request.build_absolute_uri("/accounts/google/callback/")
#     data = {
#         "code": code,
#         "client_id": settings.GOOGLE_CLIENT_ID,
#         "client_secret": settings.GOOGLE_CLIENT_SECRET,
#         "redirect_uri": redirect_uri,
#         "grant_type": "authorization_code"
#     }
#     token_resp = requests.post(token_url, data=data).json()
#     id_token_str = token_resp.get("id_token")
#     if not id_token_str:
#         return redirect("accounts:login")

#     # Verificación del id_token
#     idinfo = id_token.verify_oauth2_token(
#         id_token_str, grequests.Request(), settings.GOOGLE_CLIENT_ID
#     )

#     email = idinfo.get("email")
#     full_name = idinfo.get("name", "")
#     avatar_url = idinfo.get("picture", "")

#     # Separar nombre y apellido si querés
#     nombre_parts = full_name.strip().split(" ", 1)
#     nombre = nombre_parts[0]
#     apellido = nombre_parts[1] if len(nombre_parts) > 1 else ""

#     # Crear o actualizar usuario
#     user, created = Usuario.objects.get_or_create(
#         email=email,
#         defaults={
#             "nombre": full_name,   # Guardamos el nombre completo
#             "avatar": avatar_url,
#             "is_active": True,
#         }
#     )

#     if not created:
#         # Actualizar datos si ya existe
#         user.nombre = full_name
#         if avatar_url:
#             user.avatar = avatar_url
#         user.save(update_fields=["nombre", "avatar"])

#     # Loguear usuario
#     login(request, user)
#     return redirect("dashboards:admin_dashboard")

def google_login_callback(request):
    code = request.GET.get("code")
    if not code:
        return redirect("accounts:login")

    # Solicitud del token
    token_url = "https://oauth2.googleapis.com/token"
    redirect_uri = request.build_absolute_uri("/accounts/google/callback/")
    data = {
        "code": code,
        "client_id": settings.GOOGLE_CLIENT_ID,
        "client_secret": settings.GOOGLE_CLIENT_SECRET,
        "redirect_uri": redirect_uri,
        "grant_type": "authorization_code"
    }
    token_resp = requests.post(token_url, data=data).json()
    id_token_str = token_resp.get("id_token")
    if not id_token_str:
        return redirect("accounts:login")

    # Verificación del id_token
    idinfo = id_token.verify_oauth2_token(
        id_token_str, grequests.Request(), settings.GOOGLE_CLIENT_ID
    )

    email = idinfo.get("email")
    full_name = idinfo.get("name", "")
    avatar_url = idinfo.get("picture", "")

    # Buscar usuario por email (no lo creamos)
    user = Usuario.objects.filter(email=email).first()

    if not user:
        # No existe -> no se deja loguear
        return redirect("accounts:login")

    # Si existe -> actualizamos datos
    user.nombre = full_name
    if avatar_url:
        user.avatar = avatar_url
    user.save(update_fields=["nombre", "avatar"])

    # Loguear usuario
    login(request, user)
    return redirect("dashboards:admin_dashboard")
