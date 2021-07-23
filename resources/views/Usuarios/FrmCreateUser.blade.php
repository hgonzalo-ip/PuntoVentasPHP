<form action="{{ route('CreateUser') }}" method="POST" >
@csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 form-group">
                <label>Tipo Usuario</label>
                <select name="Slt_IdTypeUser" class="form-control" required>
                    <option class="bg-dark">Elige un Tipo</option>
                    @foreach($TypeUser as $Type)
                    <option class="bg-dark" value="{{$Type->IdTipoUsuario}}">{{$Type->Descripcion}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 form-group">
            <label>Sucursal</label>
                <select name="Slt_IdTypeStore" class="form-control" required>
                    <option class="bg-dark">Elige un Tipo</option>
                    @foreach($TypeStore as $Type)
                    <option class="bg-dark" value="{{$Type->IdSucursal}}">{{$Type->Nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3 form-group">
                <label for="NameUser">Nombres</label>
                <input type="text" class="form-control" name="NameUser" id="NameUser" required>
            </div>
            <div class="col-md-3 form-group">
                <label for="LastName">Apellidos</label>
                <input type="text" class="form-control" name="LastName" id="LastName" required>
            </div>
            <div class="col-md-3 form-group">
                <label for="Tel">Telefono</label>
                <input type="number" class="form-control" name="Tel" id="Tel" required>
            </div>
            <div class="col-md-3 form-group">  
                <label for="DPI">DPI</label>
                <input type="number" class="form-control" name="DPI" id="DPI" required>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4 form-group">  
                <label for="Email">Correo Electronico</label>
                <input type="email" class="form-control" name="Email" id="Email" required>
            </div>
            <div class="col-md-4 form-group">  
                <label for="Password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-2">
            <button class="btn">
                Crear Usuario
            </button>
        </div>
    </div>
</form>
    
