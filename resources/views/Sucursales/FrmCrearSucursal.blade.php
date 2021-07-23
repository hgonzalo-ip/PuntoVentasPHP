<form class="was-validated" action="{{ route('CrearSucursal') }}" method="POST">
 @csrf
    <div class="row justify-content-center">
        <div class="col-xl-3 col-md-5 col-sm-4 form-group">
            <label>Nombre Sucursal </label>
            <input type="text" class=" form-control @error('Txt_Nombre') is-invalid @enderror" name="Txt_Nombre" id="Txt_Nombre" required>
            <div class="valid-feedback">Muy bien</div>
            <div class="invalid-feedback">Rellenar este campo.</div>
         
        </div>
        <div class="col-xl-3 col-md-5 col-sm-4 form-group">
            <label>Direccion Sucursal </label>
            <input type="text" class="form-control" name="Txt_Direccion" id="Txt_Direccion" required>
            <div class="valid-feedback">Muy bien</div>
            <div class="invalid-feedback">Rellenar este campo.</div>
        </div>
        <div class="col-xl-3 col-md-5 col-sm-4 form-group">
            <label>Telefono Sucursal </label>
            <input type="number" class="form-control" name="Txt_Telfono" id="Txt_Telfono" required>
            <div class="valid-feedback">Muy bien</div>
            <div class="invalid-feedback">Rellenar este campo.</div>
            @error('Txt_Telfono')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-xl-3 col-md-4 col-sm-3">
            <button type="submit" class="form-control btn btn-info">Crear Sucursal</button>
        </div>
    </div>
</form>