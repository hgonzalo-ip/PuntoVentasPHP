<form class="was-validated" action="{{ route('EditarSucursal') }}" method="POST">
 @csrf
    <div class="row justify-content-center">
        <div class="col-xl-3 col-md-5 col-sm-4 form-group">
            <label>Nombre Sucursal </label>
            <input type="hidden" name="Txt_EditIdSucursal" value="{{$Sucursales->IdSucursal}}">
            <input type="text" class="form-control" name="Txt_EditNombre" id="Txt_EditNombre" value="{{$Sucursales->Nombre}}" required>
            <div class="valid-feedback">Muy bien</div>
            <div class="invalid-feedback">Rellenar este campo.</div>
        </div>
        <div class="col-xl-3 col-md-5 col-sm-4 form-group">
            <label>Direccion Sucursal </label>
            <input type="text" class="form-control" name="Txt_EditDireccion" id="Txt_EditDireccion" value="{{$Sucursales->Direccion}}" required>
            <div class="valid-feedback">Muy bien</div>
            <div class="invalid-feedback">Rellenar este campo.</div>
        </div>
        <div class="col-xl-3 col-md-5 col-sm-4 form-group">
            <label>Telefono Sucursal </label>
            <input type="text" maxlength="8" class="form-control" name="Txt_EditTelfono" id="Txt_EditTelfono" value="{{$Sucursales->Telefono}}" required>
            <div class="valid-feedback">Muy bien</div>
            <div class="invalid-feedback">Rellenar este campo.</div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-xl-3 col-md-4 col-sm-3">
            <button type="submit" class="form-control btn btn-info">Modificar Sucursal</button>
        </div>
    </div>
</form>