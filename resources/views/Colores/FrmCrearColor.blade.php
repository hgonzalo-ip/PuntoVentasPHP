<form action=" {{ route('CrearColor') }} " method="POST">
@csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 form-group">
                <label for="Descripcion">Nombre del Color</label>
                <input type="text" class="form-control" name="Descripcion" id="Descripcion" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 form-group">
                <button class="btn" type="submit">
                Crear Color
                </button>
            </div>
        </div>
    </div>

</form>