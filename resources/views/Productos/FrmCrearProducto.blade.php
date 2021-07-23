<form action="{{ route('GuardarProducto') }}" method="POST"><!--Inicio Form Telefono-->    
            @csrf    
            <input name="IdTipoProducto" id="IdTipoProducto" type="hidden" value="{{$IdTipoProducto}}">

           
            <div class="row justify-content-center">
            
            <div class="col-md-9 form-group">
                        <div class="input-group{{ $errors->has('Proveedor') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                                </div>
                            </div>                                   
                            <select onchange="ViewListMarcas(this.value)"   name="IdProveedorT" id="IdProveedorT" class="form-control{{ $errors->has('Proveedor') ? ' is-invalid' : '' }}" placeholder="{{ __('Proveedor') }}" required>
                                <option class="bg-dark" value="0">Elige un Proveedor</option>
                                @foreach($Proveedores as $Proveedor)
                                <option class="bg-dark" value="{{$Proveedor->IdProveedor}}">{{$Proveedor->Nombre}}</option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'Proveedor'])
                        </div>
                    </div> 
                 
            </div>

            <div class="row justify-content-center">
            
                 
            <div class="col-md-10 form-group">
                <div class="row justify-content-center">
        
                
                    <div class="col-md-10 form-group" style="display:none;" id="Dv_SelectMarca">
                    
                    </div> 
               
                </div>
            </div>
            </div>
            <div class="row justify-content-center">
          
            <div class="col-md-9 form-group">
                        <div class="input-group{{ $errors->has('Proveedor') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                                </div>
                            </div>                                   
                            <select   name="IdSucursalT" id="IdSucursalT" class="form-control{{ $errors->has('IdSucursalT') ? ' is-invalid' : '' }}" placeholder="{{ __('IdSucursalT') }}" required>
                                <option class="bg-dark" value="0">Elige una Sucursal</option>
                                @foreach($Sucursales as $Sucur)
                                <option class="bg-dark" value="{{$Sucur->IdSucursal}}">{{$Sucur->Nombre}}</option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'IdMarca'])
                        </div>
                    </div> 
                   
            </div>

            <div class="row justify-conten-center">
                    <div class="col-md-6 form-group">
                        <div class="input-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tim-icons icon-mobile"></i>
                                </div>
                            </div>
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre del Telefono') }}" required>
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label  for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea  class="form-control" name="DescripcionT" id="DescripcionT" required>
                        </textarea >
                    </div>
            </div>
            <div class="row justify-content-center">
          
            <div class="col-md-9 form-group">
                        <div class="input-group{{ $errors->has('Proveedor') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                                </div>
                            </div>                                   
                            <select   name="IdColorT" id="IdColorT" class="form-control{{ $errors->has('Marca') ? ' is-invalid' : '' }}" placeholder="{{ __('IdMarca') }}" required>
                                <option class="bg-dark" value="0">Elige un color</option>
                                @foreach($Colores as $Color)
                                <option class="bg-dark" value="{{$Color->IdColor}}">{{$Color->Descripcion}}</option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'IdMarca'])
                        </div>
                    </div> 
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 from-grop">
                    <label>Precio Compra</label>
                    <input type="number" name="PrecioCompraT" id="PrecioCompraT" step="any" class="form-control" required value="0.00">
                </div>
                <div class="col-md-4 from-grop">
                    <label>Precio Venta</label>
                    <input onchange="Ganancia()" type="number" name="PrecioVentaT" id="PrecioVentaT" step="any" class="form-control" required value="0.00">
                </div>
                <div class="col-md-4 from-grop">
                    <label>Ganacia</label>
                    <input type="number" name="GananciaT" id="GananciaT" step="any" class="form-control" required value="0.00">
                </div>
            </div>
           
            </div>   
            <div class="row justify-content-center" id="BtnCrearProducto">
                    <div class="col-md-5 form-group">
                        <button class="form-control btn "><h4 class="text-wite"> Crear Producto.</h4></button> 
                    </div>
            </div>
            </form><!--FIN Form Telefono-->