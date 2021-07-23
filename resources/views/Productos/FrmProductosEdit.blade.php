<form id="FrmModificarProducto"><!--Inicio Form Telefono-->    
            @csrf    
            <input name="IdTipoProducto" id="IdTipoProducto" type="hidden" value="{{$ProductosEdit->IdTipoProducto}}">
            <input name="IdProductoEdit" id="IdProductoEdit" type="hidden" value="{{$ProductosEdit->IdProducto}}">
            
            <div class="row justify-content-center">
            
            <div class="col-md-9 form-group">
                        <div class="input-group{{ $errors->has('Proveedor') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                                </div>
                            </div>                                   
                            <select  name="IdTipoProducto" id="IdTipoProducto" class="form-control{{ $errors->has('Proveedor') ? ' is-invalid' : '' }}" placeholder="{{ __('Proveedor') }}" required>
                                <option class="bg-dark" value="0">Elige un Tipo</option>
                                @foreach($TipoProducto as $TipoPro)
                                <option class="bg-dark text-with" value="{{$TipoPro->IdTipoProducto}} " {{$TipoPro->IdTipoProducto == $ProductosEdit->IdTipoProducto ? 'selected' : ''}} >{{$TipoPro->Descripcion}}</option>
                                @endforeach
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
                            <select  name="IdProveedorT" id="IdProveedorT" class="form-control{{ $errors->has('Proveedor') ? ' is-invalid' : '' }}" placeholder="{{ __('Proveedor') }}" required>
                                <option class="bg-dark" value="0">Elige un Proveedor</option>
                                @foreach($Proveedores as $Pro)
                                <option class="bg-dark text-with" value="{{$Pro->IdProveedor}} " {{$Pro->IdProveedor == $ProductosEdit->IdProveedor ? 'selected' : ''}} >{{$Pro->Nombre}}</option>
                                @endforeach
                            </select>
                            @include('alerts.feedback', ['field' => 'Proveedor'])
                        </div>
                    </div> 
   
            </div>

            <div class="row justify-content-center">
    
            <div class="col-md-10 form-group">
                <div class="row justify-content-center">
                    <div class="col-md-10 form-group" id="Dv_SelectMarca">
                    <div class="input-group{{ $errors->has('Proveedor') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                                </div>
                            </div>                                   
                            <select   name="IdMarcaT" id="IdMarcaAC" class="form-control{{ $errors->has('Marca') ? ' is-invalid' : '' }}" placeholder="{{ __('IdMarca') }}">
                                <option class="bg-dark">Elige una Marca</option>
                                @foreach($Marcas as $Mar)
                                <option class="bg-dark" value="{{$Mar->IdMarca}}" {{$Mar->IdMarca == $DetalleMarcaFind->IdMarca ? 'selected' : ' '}}> {{$Mar->Descripcion}}</option>
                                @endforeach
                                
                            </select>

                        </div>
                    </div> 
               
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
                            <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{$ProductosEdit->NombreProductos}}" required>
                            @include('alerts.feedback', ['field' => 'name'])
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label  for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea  class="form-control text-with" name="DescripcionT" id="DescripcionT"  required>
                        {{$ProductosEdit->Descripcion}}
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
                                @foreach($Colores as $Col)
                                <option class="bg-dark text-with" value="{{$Col->IdColor}} " {{$Col->IdColor == $ProductosEdit->IdColor ? 'selected' : ''}} >{{$Col->Descripcion}}</option>
                                @endforeach
                                
                            </select>
                            @include('alerts.feedback', ['field' => 'Colores'])
                        </div>
                    </div> 
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4 from-grop">
                    <label>Precio Compra</label>
                    <input type="number" onchange="Ganancia()"name="PrecioCompraT"  id="PrecioCompraT" step="any" class="form-control" required value="{{$ProductosEdit->PrecioCompra}}">
                </div>
                <div class="col-md-4 from-grop">
                    <label>Precio Venta</label>
                    <input onchange="Ganancia()" type="number" name="PrecioVentaT" id="PrecioVentaT" step="any" class="form-control" required value="{{$ProductosEdit->PrecioVenta}}">
                </div>
                <div class="col-md-4 from-grop">
                    <label>Ganacia</label>
                    <input type="number" readonly name="GananciaT" id="GananciaT" step="any" class="form-control" required value="{{$ProductosEdit->Ganancia}}">
                </div>
            </div>
            
            </div>   
            </form><!--FIN Form Telefono-->
            <div class="row justify-content-center mt-1">
                <div class="col-sm-5 form-group">
                    <button onclick="EditarProducto()" class="btn btn-info">
                        Modificar Información
                    </button>
                </div>
               </div> 
            <script>
           
                  function Ganancia(){
                    var PrecioVentaT = $("#PrecioVentaT").val();
                    var PrecioCompraT = $("#PrecioCompraT").val();
                    var TotalGanancia = (PrecioVentaT - PrecioCompraT);
                    $("#GananciaT").val(TotalGanancia);
                }

                function EditarProducto(){
                    var Formulario = document.getElementById('FrmModificarProducto');
                    if(Formulario.reportValidity()){
                        var FrmEnviar = $("#FrmModificarProducto").serialize();
                        var Token = "{{ csrf_token() }}";
                        $.ajax({
                        url: '/ModificarChip',
                        type: 'POST',
                        data : FrmEnviar +"&_token="+Token,
                        success:function(response){
                            if(response == 1){
                                    Swal.fire(
                                'MODIFICADO!',
                                'Tu Producto ha sido Modificado.',
                                'success'
                                ).then((res) =>{
                                if(res.isConfirmed){
                                    location.reload();
                                }
                                })
                                
                            }
                        },
                        error: function(error){

                        }
                    })
                    }
                }
            </script>