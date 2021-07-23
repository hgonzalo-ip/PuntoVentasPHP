<form action=" {{ route('EditarMarca') }} " method="POST">
@csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 form-group">
                <label for="Descripcion">Nombre Marca</label>
                <input type="hidden" name="IdMarca" value="{{$Marca->IdMarca}}">
                <input type="text" class="form-control" name="Descripcion" id="Descripcion" required value="{{$Marca->Descripcion}}"> 
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 form-group">
                <button class="btn" type="submit">
                Editar Marca
                </button>
            </div>
        </div>
    </div>

</form>