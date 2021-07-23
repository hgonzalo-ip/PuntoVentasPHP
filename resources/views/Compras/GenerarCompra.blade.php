@extends('layouts.app', ['page' => __('GenerarCompra'), 'pageSlug' => 'GenerarCompra'])

@section('content')
                @if (session('Message'))
                        <div class="row justify-content-center form-group alert alert-success">
                            <div class="col-md-6">
                                <h5>{{ session('Message') }}</h5>
                            </div>
                        </div>
                    @endif
	<div class="card" >
        <div class="card-header" >
         
         
            
            <h3 class="title">Generar Compra</h3>
             <p class="category">Seleccione una sucursal para listar los productos</p>
        
         
        </div>
        <div class="card-body all-icons">
        <div class="row justify-content-center"><!-- Row 2--> 
            <div class="col-md-5 form-group">
                <div class="input-group{{ $errors->has('TipoUsuario') ? ' has-danger' : '' }}" id="DivSucursal">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            
                            <i class="fas fa-warehouse"></i>
                            </div>
                        </div>                                   
                        <select onchange="VerProveedores()" id="IdSucursal"  name="IdSucursal" class="form-control{{ $errors->has('TipoUsuario') ? ' is-invalid' : '' }}"  required>
                            <option class="bg-dark" value="0">Elige uns sucursal</option>
                            @foreach($Sucursales as $Sucursal)
                            <option class="bg-dark" value="{{$Sucursal->IdSucursal}}">{{$Sucursal->Nombre}}</option>
                            @endforeach
                        
                        </select>
                        @include('alerts.feedback', ['field' => 'TipoUsuario'])
                    </div>
                </div>  
          
               
            </div><!--Fin del Row 2-->
            <div class="row justify-content-center" id="DivProveedor" style="display: none;"><!-- Row 1--> 
            <div class="col-md-5 form-group">
                <div class="input-group{{ $errors->has('TipoUsuario') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <i class="fas fa-star" id="SeleccionarProducto"></i>
                            </div>
                        </div>                                   
                        <select  onchange="VerProductos()" id="IdProveedor"  name="IdProveedor" class="form-control{{ $errors->has('TipoUsuario') ? ' is-invalid' : '' }}"  required>
                            <option class="bg-dark" value="0">Elige un Tipo</option>
                            @foreach($Proveedores as $Provee)
                            <option class="bg-dark" value="{{$Provee->IdProveedor}}">{{$Provee->Nombre}}</option>
                            @endforeach
                           
                        </select>
                        @include('alerts.feedback', ['field' => 'TipoUsuario'])
                    </div>
                </div>  
           
            </div><!--Fin del Row 1-->
          
                        
                
                <div class="row justify-content-center">
                    <div class="col-md-6 form-group">
                        <input onkeyup="BuscarProducto(this.value)" type="search" class="form-control bg-white text-dark" style="width:100%; display:none" name="BuscarProducto" id="BuscarProducto" placeholder="Buscar">
                    </div>
                
                </div>
                <br>
                <div id="Row_Listar" style="width:100%; height:300px; overflow: scroll;">  
                </div>
          
        </div><!--fin del car body-->


     </div>
    <br>
    <div class="card" id="CardGenerarCompra" style="display: none;">
        <div class="card-header" >
       <div class="row justify-content-center">
          
            @php
            $Fecha = date("Y-m-d");
        
            @endphp
            <div class="col-md-3">
               <h4>Fecha Compra</h4> <input class="form-control" style="font-size: 1.4em;color:white ; margin-top:-1%;" type="date" value="{{$Fecha}}" readonly>
            </div>
            <div class="col-md-3">
               <h4>Sucursal</h4> <h4 id="NombreSucursal" style="font-size: 1.4em;color:white;"></h4>
            </div>
            <div class="col-md-3">
               <h4>Proveedor</h4> <h4 id="NombreProveedor" style="font-size: 1.4em;color:white;"></h4>
            </div>
           
       </div>
        </div>
        <form id="FrmGenerarCompra">
        <div class="card-body all-icons">
       
        @csrf
            <table class="table">  

                <thead>
                   
                    <th class="text-center"> Eliminar</th>
                   
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Precio Compra</th>                    
                    <th class="text-center">Precio Venta</th>
                    <th class="text-center">Color</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Total a Pagar</th>
                   
                </thead>
              
               
                <tbody id="Tbl_BodyCompra">

                </tbody>
               
                <tfoother>
                    <tr>
                   
                  
                        <td colspan="7" class="text-right">Total</td>
                        <td colspan="1" class="text-center">
                        <input class="form-control" name="TotalFinCompra" id="TotalFinCompra" require>
                       </td>
                    </tr>
                </tfoother>
            </table>
       
            <div class="row justify-content-center" style="display: none;"  id="DivBtnTableCompras">
                <div class="col-xl-3 col-md-5 col-sm-6" >
                    <button onclick="GenerarCompra()" type="button" class="btn btn-info btn-lg text-center" >Generar Compra</button>

                </div>
                <div class="col-xl-3 col-md-5 col-sm-5">
                    <button onclick="CancelarCompra()" type="button" class="btn btn-info btn-lg text-center" >Cancelar Compra</button>

                </div>
             </div>
        </div>
        </form>
    </div>
@endsection
<!--Modales Agregar Imeis-->
<!-- The Modal -->
<div class="modal" id="MdAgregarImeis">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bg-dark">

      <!-- Modal Header -->
      <div class="modal-header">
 
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="MdBodyAgregarImeis">
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
            <div class="container-fluid">   
            <div class="row justify-content-center">
        
        <div class="col-xl-2 col-md-4 col-sm-6 form-group">
            <button type="button" class=" btn btn-danger btn-block d-none" data-dismiss="modal" id="CancelarImes">Cancelar</button>
            
        </div>
        <div class="col-xl-2 col-md-4 col-sm-6 form-group">
        <button type="button" class=" btn btn-dark btn-block d-none" onclick="AgregarImeis()" id="AguardarImesi">Aguardar Imeis</button>
            
        </div>
        

   </div>   
    
            </div>
      </div>

    </div>
  </div>
</div>
<script>
    function CancelarCompra(){
        location.reload();
    }
    var Contador = 0;
    
    var TotalesId = [];
    function AgregarFilaTabalCompras(PrecioCompra,IdProducto,NombreProductos,Color,PrecioVenta, IdTipoProducto){

    var IdJson = TotalesId.indexOf(IdProducto);

    if(IdJson == -1){
        TotalesId.push(IdProducto);

            var Estilos = "background-color: #02394A; Color: white; text-align:center;   font-size:18px; padding:10px 1px 10px 5px;margin:0px auto;display:block;width:50%;border:none;border-bottom:1px solid #757575;";
            Contador++;
            var Fila = "<tr id='fila"+IdProducto+"'>"+
                        "<td>"+"<button onclick='EliminarFila("+IdProducto+")' class='form-control btn btn-danger'>"+ "<i class='fas fa-trash-alt'>"+"</i>"+"</button>" +"</td>"+
                        "<td class='text-center d-none'>"+Contador+"</td>"+
                        "<input type='hidden' style='"+Estilos+"'  name='IdProducto[]' readonly value="+IdProducto+">"+
                        "<td>"+NombreProductos+"</td>"+
                        "<td>"+"<input type='number' style='"+Estilos+"'   name='PrecioCompra[]' id='PrecioCompra"+IdProducto+"' readonly value="+PrecioCompra+">"+"</td>"+
                        "<td>"+"<input type='number' style='"+Estilos+"'   name='PrecioVenta[]' readonly value="+PrecioVenta+">"+"</td>"+
                        "<td>"+Color+"</td>"+
                        "<td>"+"<input type='number' style='"+Estilos+"'  onchange='TotalPagarUnidad(this.value,"+IdProducto+","+IdTipoProducto+")' id='TxtCantidad'  name='Cantidad[]'>"+"</td>"+
                        "<td>"+"<input type='number' style='"+Estilos+"'  readonly  name='TotalUnidad[]"+IdProducto+"' id='TotalUnit"+IdProducto+"' >"+"</td>"+
                        
                        +"</tr>"
     
                        $("#Tbl_BodyCompra").append(Fila);
                        $("#DivSucursal").hide();
                        $("#DivProveedor").hide();
                    
                        $("#CardGenerarCompra").show();
                        $("#DivBtnTableCompras").show();
    }else{
        Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Este Producto ya existe en la tabla!'
            })
    }

    }
    function TotalPagarUnidad(Cantidad,IdProducto,IdTipoProducto){
        if(IdTipoProducto == 1 || IdTipoProducto == 2){
            $.ajax({
                url: '/ModalAgregarImeis',
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    IdTipoPorducto: IdTipoProducto,
                    IdProducto     : IdProducto,
                    Cantidad       : Cantidad
                },
                success: function(response){
                    $("#MdAgregarImeis").modal('show');
                    $("#MdBodyAgregarImeis").html(response);
                },
                error : function(error){
                    alert('Ocurrio un erro inesperado');
                }
            });
                    var PrecioCompra = $("#PrecioCompra"+IdProducto).val();
                    var TotalPagar = PrecioCompra * Cantidad;
    
                    $("#TotalUnit"+IdProducto).val(TotalPagar);
                    FuncTotalFinalCompra(IdProducto);
        }else{
                    var PrecioCompra = $("#PrecioCompra"+IdProducto).val();
                    var TotalPagar = PrecioCompra * Cantidad;
    
                    $("#TotalUnit"+IdProducto).val(TotalPagar);
                    FuncTotalFinalCompra(IdProducto);
        }
    

    }
   
        var TotalFinalCompra = 0;
      
    function FuncTotalFinalCompra(IdProducto){
        var TotalUnit = $("#TotalUnit"+IdProducto).val();
        TotalFinalCompra += parseInt(TotalUnit);
        $("#TotalFinCompra").val(TotalFinalCompra);
     

    }
    

    function VerProveedores(){
        $("#DivProveedor").show();
        var NombreSucursal = $( "#IdSucursal option:selected" ).text();
        $("#NombreSucursal").html(NombreSucursal);
    }
	function VerProductos(){
        var IdSucursal     = $("#IdSucursal").val();
		
        var IdProveedor    = $("#IdProveedor").val();
        var NombreProveedor = $( "#IdProveedor option:selected" ).text();
      
        
        if(IdSucursal == 0){
            alert('Selecciona una sucursal')
            $("#IdSucursal").focus();
        }else{
            $.ajax({
			url: '/ListadoProductosCompra',
			type: 'POST',
			data: {
                "_token": "{{ csrf_token() }}",
                IdSucursal     : IdSucursal,
                IdProveedor    : IdProveedor
                },
			success: function(response){
                $("#Row_Listar").html(response)
                $("#BuscarProducto").show();
            
                $("#NombreProveedor").html(NombreProveedor);
			},
			error: function(error){
				alert('ocurrio un error inesperado');
			}
		});
        }

	}
    var IdexOf;
    function EliminarFila(IdProducto){
   
        IdexOf = TotalesId.indexOf(IdProducto) 
        console.log('IdexOf'+IdexOf);
        console.log('IdProducto'+IdProducto);
        if(IdexOf != -1 ){
            TotalesId.splice(IdexOf); 
            Contador--;
        }

        
            var TotalUnidad = $("#TotalUnit"+IdProducto).val();
            $("#fila" + IdProducto).remove();
            var TotalCompra =  $("#TotalFinCompra").val();
        
        if(Contador == 0){
                TotalFinalCompra = 0;
                $("#TotalFinCompra").val(TotalFinalCompra);
            }else if(Contador != 0 ){
                TotalFinalCompra = TotalCompra - TotalUnidad;
                console.log(TotalesId);
                $("#TotalFinCompra").val(TotalFinalCompra);
            }

    }
    function BuscarProducto(Info){
        var IdSucursal = $("#IdSucursal").val();
        var IdProveedor    = $("#IdProveedor").val();
     $.ajax({
        url: 'BuscadorProductosCompra',
        type: 'POST',
        data:{
            "_token": "{{ csrf_token() }}",
            Info : Info,
            IdSucursal : IdSucursal,
            IdProveedor    : IdProveedor
        },
        success: function(response){
            $("#Row_Listar").html(response);
        },
        error: function(erro){
            alert('Ocurrio un error inesperado');
        }
     });
  }
  function AgregarImeis(){
    
      var Formulario = document.getElementById('FrmAggImeis');
      if(Formulario.reportValidity()){
          var Data = $("#FrmAggImeis").serialize();
          var Token = "{{ csrf_token() }}";
          $.ajax({
            url: '/AgregarImeis',
            type: 'POST',
            typedata: 'json',
            data: Data + "&_token="+Token,
            success: function(response){
                if(response == 1){
                    Swal.fire(
                    'Exito',
                    'Imeis Agregados Correctamente',
                    'success'
                    )
                    $("#MdAgregarImeis").modal('hide');
                    $("#TxtCantidad").attr('readonly','readonly');
                }
            },
            error: function(error){
                alert('No se encontro la direccion');
            }
          });
      }
  }

  function GenerarCompra(){
     var Formulario = document.getElementById('FrmGenerarCompra');
     if(Formulario.reportValidity()){
         var Datos = $("#FrmGenerarCompra").serialize();
         var Token = "{{ csrf_token() }}";
         $.ajax({
            url: '/GenerarCompra',
            type: 'POST',
            data : Datos + "&_token="+Token,
            datatype: 'json',
            success: function (response){
                if(response == 1){
                    Swal.fire(
                    'Compra',
                    'Compra Generada con exito',
                    'success'
                    ).then((result) => {
                        if(result.isConfirmed){
                            location.reload();
                        }
                    });
                }else{
                    alert('Ocurrio un erro en la respuesta');
                }
            },
            error : function(error){
                alert('No se encuentra la direccion');
            }
         });
     }
  }
</script>