 <!--Frm Crear Chip-->
 <form action="{{ route('GuardarChip') }}" method="POST">
 @csrf
 <div class="row justify-content-center">
            <input name="IdTipoProducto" id="IdTipoProducto" type="hidden" value="2">
            <div class="col-md-10 form-group">
                        <div class="input-group{{ $errors->has('Proveedor') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                                </div>
                            </div>                                   
                            <select   name="IdProveedorT" id="IdProveedorCH" class="form-control{{ $errors->has('Proveedor') ? ' is-invalid' : '' }}" placeholder="{{ __('Proveedor') }}" required>
                                <option class="bg-dark" value="0">Elige un Proveedor</option>
                                @foreach($ProveedoresChip as $Proveedor)
                                <option class="bg-dark" value="{{$Proveedor->IdProveedor}}">{{$Proveedor->Nombre}}</option>
                                @endforeach<!--Cunado la el proveedor sea una persona si se mostraran las marcas -->
                            </select>
                            @include('alerts.feedback', ['field' => 'Proveedor'])
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
               <div class="row justify-content-center">
               <div class="col-md-6">
                        <lable class="text-white">Nombre</lable>
                        <input type="text" name="name" class="form-control" placeholder="Nombre Del Chip">
                </div>
                <div class="col-md-6">
                <lable class="text-white">Descripciòn / Promoción</lable>
                        <textarea  class="form-control" name="DescripcionT" id="DescripcionCH" required>
                        </textarea >
                </div>
               </div>
              <br>
                <div class="row justify-content-center">
                <div class="col-md-4 from-grop">
                    <label>Precio Compra</label>
                    <input type="number" name="PrecioCompraT" id="PrecioVentaCH" step="any" class="form-control" required value="0.00">
                </div>
                <div class="col-md-4 from-grop">
                    <label>Precio Venta</label>
                    <input onchange="GananciaCHI()" type="number" name="PrecioVentaT" id="PrecioCompraCH" step="any" class="form-control" required value="0.00">
                </div>
                <div class="col-md-4 from-grop">
                    <label>Ganacia</label>
                    <input type="number" name="GananciaT" id="GananciaCH" step="any" class="form-control" required value="0.00">
                </div>
            </div>
              
               </div>   
               <div class="row justify-content-center">
                    <div class="col-md-5">
                        <button type="subtmit" class="btn ">
                            Crear Chip
                        </button>
                    </div>
                </div>
            </form><!--Frin del Frm Crear Chip-->
           
          
           