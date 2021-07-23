<form action="{{ route('ModificarTypeUser')  }}" method="POST">
@csrf
<div class="container"> 
    <div class="row justify-content-center">
        <div class="col-md-5 form-gorup">
            <label for="Descripcion">Nombre del Tipo</label>
            <input type="text" class="form-control" name="Descripcion" id="Descripcion" required value="{{$TypeUser->Descripcion}}">
            <input type="hidden" value="{{$TypeUser->IdTipoUsuario}}" name="Txt_IdTypeUser">
        </div>
    </div>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-3">
            <button type="submit" class="btn">
                Modificar
            </button>
        </div>
    </div>
</div>
</form>