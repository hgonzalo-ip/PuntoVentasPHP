<form action=" {{ route('CrearMarca') }} " method="POST">
@csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 form-group">
                <label for="Descripcion">Nombre Marca</label>
                <input type="text" class="form-control" name="Descripcion" id="Descripcion" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 form-group">
                <button class="btn" type="submit">
                Crear Marca
                </button>
            </div>
        </div>
    </div>

</form>