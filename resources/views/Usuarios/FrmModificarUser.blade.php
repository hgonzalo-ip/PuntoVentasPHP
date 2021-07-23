<form action="{{ route('EditUser') }}" method="POST" >
@csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 form-group">
                <label>Tipo Usuario</label>
                <input type="hidden" name="IdUsuer" value="{{$User->IdUsuario}}">
                <select name="Slt_IdTypeUser" class="form-control" required>
                    <option class="bg-dark">Elige un Tipo</option>
                    @foreach($TypeUser as $Type)
                    <option class="bg-dark" value="{{$Type->IdTipoUsuario}}" {{$Type->IdTipoUsuario == $User->IdTipoUsuario ? 'selected': '' }} >{{$Type->Descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 form-group">
            <label>Sucursal</label>
                <select name="Slt_IdTypeStore" class="form-control" required>
                    <option class="bg-dark">Elige un Tipo</option>
                    @foreach($TypeStore as $Type)
                    <option class="bg-dark" value="{{$Type->IdSucursal}}" {{$Type->IdSucursal == $User->IdSucursal ? 'selected' : ''}}>{{$Type->Nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3 form-group">
                <label for="NameUser">Nombres</label>
                <input type="text" class="form-control" name="NameUser" id="NameUser" required value="{{$User->Nombres}}">
            </div>
            <div class="col-md-3 form-group">
                <label for="LastName">Apellidos</label>
                <input type="text" class="form-control" name="LastName" id="LastName" required value="{{$User->Apellidos}}">
            </div>
            <div class="col-md-3 form-group">
                <label for="Tel">Telefono</label>
                <input type="number" class="form-control" name="Tel" id="Tel" required value="{{$User->Telefono}}">
            </div>
            <div class="col-md-3 form-group">  
                <label for="DPI">DPI</label>
                <input type="number" class="form-control" name="DPI" id="DPI" required value="{{$User->DPI}}">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 form-group">  
                <label for="Email">Correo Electronico</label>
                <input type="email" class="form-control" name="Email" id="Email" required value="{{$User->email}}">
            </div>
           
           
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-2">
            <button class="btn">
                Modificar Usuario
            </button>
        </div>
    </div>
</form>
    
