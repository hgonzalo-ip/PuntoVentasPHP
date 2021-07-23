<form id="FrmEditChip"><!--Frm Crear Chip-->
@csrf
            <div class="row justify-content-center">
            <input name="IdTipoProducto" id="IdTipoProducto" type="hidden" value="2">
            <input name="IdProductoEdit" id="IdProductoEdit" type="hidden" value="{{$ProductosEdit->IdProducto}}">
            <div class="col-md-10 form-group">
                        <div class="input-group{{ $errors->has('Proveedor') ? ' has-danger' : '' }}">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                <i class="fas fa-truck"></i>
                                </div>
                            </div>                                   
                            <select   name="IdProveedorT" id="IdProveedorCH" class="form-control{{ $errors->has('Proveedor') ? ' is-invalid' : '' }}" placeholder="{{ __('Proveedor') }}" required>
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
               <div class="col-md-6">
                        <lable class="text-white">Nombre</lable>
                        <input type="text" name="name" class="form-control" value="{{$ProductosEdit->NombreProductos}}">
                </div>
                <div class="col-md-6">
                <lable class="text-white">Descripciòn / Promoción</lable>
                        <textarea  class="form-control text-white" name="DescripcionT" id="DescripcionCH" required>
                        {{$ProductosEdit->Descripcion}}
                        </textarea >
                </div>
               </div>
              <br>
                <div class="row justify-content-center">
                <div class="col-md-4 from-grop">
                    <label>Precio Compra</label>
                    <input type="number" name="PrecioCompraT" id="PrecioCompraT" step="any" class="form-control" required value="{{$ProductosEdit->PrecioCompra}}">
                </div>
                <div class="col-md-4 from-grop">
                    <label>Precio Venta</label>
                    <input onchange="GananciaCHI()" type="number" name="PrecioVentaT" id="PrecioVentaT" step="any" class="form-control" required value="{{$ProductosEdit->PrecioVenta}}">
                </div>
                <div class="col-md-4 from-grop">
                    <label>Ganacia</label>
                    <input type="number" readonly name="GananciaT" id="GananciaCH" step="any" class="form-control" required value="{{$ProductosEdit->Ganancia}}">
                </div>
            </div>
               </div>    
                
            </form><!--Frin del Frm Crear Chip-->
            <div class="row justify-content-center mt-4">
                <div class="col-sm-5 form-group">
                    <button onclick="EditarChip({{$ProductosEdit->IdProducto}})"  class="btn btn-info">
                        Modificar Información
                    </button>
                </div>
               </div>  
            <script>
                function GananciaCHI(){
                    var PrecioVentaT = $("#PrecioVentaT").val();
                    var PrecioCompraT = $("#PrecioCompraT").val();
                    var TotalGanancia = (PrecioVentaT - PrecioCompraT);
                    $("#GananciaCH").val(TotalGanancia);
                }
                function EditarChip(){
                    var Formulario = document.getElementById('FrmEditChip');
                    if(Formulario.reportValidity()){
                        var FrmEnviar = $("#FrmEditChip").serialize();
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