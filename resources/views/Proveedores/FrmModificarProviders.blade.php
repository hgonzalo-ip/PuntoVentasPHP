<form action="{{ route('ModificarProveedores') }}" method="POST"> 
@csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 form-group">
                <label for="Slt_IdTipoProveedor">Tipo Proveedor</label>
                <select class="form-control" required name="Slt_IdTipoProveedor" id="Slt_IdTipoProveedor">
                    <option disable class="bg-dark">Elige un Tipo</option>
                    @foreach($TiposDeProveedores as $Tipos)
                    <option class="bg-dark" value="{{$Tipos->IdTipoProveedor}}"  {{$Tipos->IdTipoProveedor == $Proveedores->IdTipoProveedor ? 'selected': ' '}}> {{$Tipos->Descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 form-group">
                <label for="Nombre">Nombre Proveedor</label>
                <input type="hidden" name="IdProveedor" value="{{$Proveedores->IdProveedor}}">
                <input type="text" class="form-control" name="Nombre" id="Nombre" required value="{{$Proveedores->Nombre}}">
            </div>
        </div>
        <div class="row justify-content-center">
           
            <div class="col-md-3 form-group">
                <label for="Direccion">Direccion</label>
                <input type="text" class="form-control" name="Direccion" id="Direccion" required value="{{$Proveedores->Direccion}}">
            </div>
            <div class="col-md-3 form-group">
                <label for="Telefono">Telefono</label>
                <input type="number" class="form-control" name="Telefono" id="Telefono" required value="{{$Proveedores->Telefono}}">
            </div>
            <div class="col-md-3 form-group">
                <label for="NIT">NIT</label>
                <input type="text" class="form-control" name="NIT" id="NIT" required value="{{$Proveedores->Nit}}">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-1">
                <button class="btn" type="submit">
                    Modificar Proveedor
                </button>
            </div>
        </div>
    </div>
</form>