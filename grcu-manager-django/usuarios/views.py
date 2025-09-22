from django.shortcuts import render, get_object_or_404, redirect
from accounts.models import Usuario
from .forms import UsuarioEditarForm 
from django.contrib.auth.decorators import login_required
from django.core.paginator import Paginator
from usuarios.models import Usuario   # tu modelo de usuario
from roles.models import Rol  

@login_required
def lista_usuarios(request):
    usuarios_list = Usuario.objects.all().order_by("id")  # ordenados por ID
    paginator = Paginator(usuarios_list, 10)  # 10 por página

    page_number = request.GET.get("page")
    usuarios = paginator.get_page(page_number)

    return render(request, "usuarios/usuario_list.html", {"usuarios": usuarios})

@login_required
def crear_usuario(request):
    if request.method == "POST":
        form = UsuarioEditarForm(request.POST)
        if form.is_valid():
            user = form.save(commit=False)
            # Opcional: generar password temporal o enviarlo por email
            user.set_password(form.cleaned_data.get("password"))
            user.save()
            form.save_m2m()  # si hay campos many-to-many (roles)
            return redirect("usuarios:lista")
    else:
        form = UsuarioEditarForm()

    return render(request, "usuarios/usuario_form.html", {"form": form})

@login_required
def editar_usuario(request, pk):
    usuario = get_object_or_404(Usuario, id=pk)

    if request.method == "POST":
        roles_ids = request.POST.get("roles", "").split(",")
        usuario.roles.set(Rol.objects.filter(id__in=roles_ids))
        usuario.is_active = 'is_active' in request.POST
        usuario.save()
        return redirect("usuarios:lista")

    form = UsuarioEditarForm(instance=usuario)  # solo para los campos que quieras mostrar (proyectos, activo, etc.)
    return render(request, "usuarios/usuario_form.html", {"form": form, "usuario": usuario, "editar": True})

# def editar_usuario(request, pk):
#     usuario = get_object_or_404(Usuario, pk=pk)
#     if request.method == "POST":
#         form = UsuarioEditarForm(request.POST, instance=usuario)
#         if form.is_valid():
#             form.save()
#             return redirect("usuarios:lista")
#     else:
#         form = UsuarioEditarForm(instance=usuario)
#     return render(request, "usuarios/usuario_form.html", {"form": form, "editar": True, "usuario": usuario})


@login_required
def eliminar_usuario(request, pk):
    user = get_object_or_404(Usuario, pk=pk)

    if request.method == "POST":
        user.delete()
        return redirect("usuarios:lista")  # volver a la lista de usuarios

    return render(request, "usuarios/confirmacion_eliminar_usuario.html", {"user": user})





