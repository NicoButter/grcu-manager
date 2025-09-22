from django import forms
from .models import Usuario
from roles.models import Rol

class UsuarioEditarForm(forms.ModelForm):
    roles = forms.ModelMultipleChoiceField(
        queryset=Rol.objects.all(),
        widget=forms.CheckboxSelectMultiple,
        required=False
    )

    class Meta:
        model = Usuario
        fields = ["roles", "is_active"]
