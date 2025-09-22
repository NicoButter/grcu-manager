from django.contrib import admin
from django.contrib.auth.admin import UserAdmin
from .models import Usuario

@admin.register(Usuario)
class UsuarioAdmin(UserAdmin):
    model = Usuario

    # Usá email como campo principal
    ordering = ['email']
    list_display = ['email', 'nombre']  # agregá otros campos existentes si querés
    list_filter = ['roles']  # o lo que tenga sentido según tu modelo

    fieldsets = (
        (None, {'fields': ('email', 'nombre', 'password', 'roles')}),
        ('Permissions', {'fields': ('is_staff', 'is_active')}),
    )

    add_fieldsets = (
        (None, {
            'classes': ('wide',),
            'fields': ('email', 'nombre', 'password1', 'password2', 'roles', 'is_staff', 'is_active')}
        ),
    )

    search_fields = ['email', 'nombre']
