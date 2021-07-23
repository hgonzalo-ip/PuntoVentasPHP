@extends('layouts.app', ['page' => __('GenerarVenta'), 'pageSlug' => 'GenerarVenta'])

@section('content')
    @if (session('Message'))
            <div class="row justify-content-center form-group alert alert-success">
                <div class="col-md-6">
                    <h5>{{ session('Message') }}</h5>
                </div>
            </div>
        @endif
	<div class="card" id="CardCompras">
        <div class="card-header" >
            <h3 class="title">Generar Nueva Venta</h3>
       
        </div>
        <div class="card-body all-icons">
    <!-- Hacer el Formulario para generar Venta -->
            
                <div class="row justify-content-center" id="RowCliente">
                    <div class="col-xl-10 form-group">
                        <label>Cliente</label>
                        <select onchange="SeleccionarCliente(this.value)" id="Select" name="IdCliente"  class="selectpicker form-control" data-size="3" data-live-search="true" data-style="btn-dark">
                             <option disabled selected class="text-dark">Elige una Opcion</option>
                             @foreach($Clientes AS $Cliente)
                             <option  class="text-dark"  value="{{$Cliente->IdCliente}}">{{$Cliente->Nombres}} {{$Cliente->NIT}}</option>
                             @endforeach
                        </select>
                    </div>
                </div>
              
                <div class="row justify-content-center">
                    <div class="col-md-6 form-group">
                        <input onkeyup="VentasBuscarProducto(this.value)" type="search" class="form-control bg-white text-dark" style="width:100%; display:none" name="BuscarProducto" id="BuscarProducto" placeholder="Buscar">
                    </div>
                
                </div>
               
                <div id="Row_Listar" style="width:100%; height:300px; overflow: scroll;">  
           
                </div>
          
        </div>
    </div>
    <div class="card" id="CardGenerarCompra" >
    <form id="FrmGenerarVenta" method="POST">
        <div class="card-header" >
       <div class="row justify-content-center" id="DivClienteVenta">
                     
       </div>
        </div>
       
        <div class="card-body all-icons">
       
        @csrf
            <table class="table">  

                <thead>

                    <th class="text-center">Nombre</th>                   
                    <th class="text-center">Precio Venta</th>
                    <th class="text-center">Color</th>
                    <th class="text-center">Cantidad</th>
                    <th class="text-center">Sub Total</th>
                    <th class="text-center"> Eliminar</th>
                   
                </thead>
              
               
                <tbody id="Tbl_BodyCompra">

                </tbody>
                
                <tfoother>
                   
                    <tr class="mt-2">
                        <td colspan="2" class="text-center">
                        <h4><strong>Total Venta</strong></h4>
                        <input class="form-control mr-2" name="TotalFinVenta" id="TotalFinVenta" required>
                       </td>

                      
                        <td colspan="2" class="text-center">
                        <h4><strong>Efectivo</strong></h4>
                        <input class="form-control" onchange="CambioVuelto(this.value)" name="Efectivo" id="Efectivo" required>
                       </td>

                       
                        <td colspan="2" class="text-center">
                        <h4><strong>Cambio</strong></h4>
                        <input class="form-control text-white" name="Cambio" readonly id="Cambio" required>
                       </td>
                    </tr>
                </tfoother>
            </table>
       
            <div class="row justify-content-center" style="display: none;"  id="DivBtnTableVentas">
                <div class="col-xl-3 col-md-5 col-sm-6" >
                    <button onclick="GenerarVenta()" type="button" class="btn btn-info btn-lg text-center" >Generar Venta</button> 

                </div>
                <div class="col-xl-3 col-md-5 col-sm-5">
                     <button onclick="CancelarVenta()" type="button" class="btn btn-danger btn-lg text-center" >Cancelar Venta</button>

                </div>
             </div>
        </div>
        </form>
        </div>
    @endsection
    <!--Modales Agregar Imeis-->
<!-- The Modal -->
<div class="modal" id="MdSeleccionarImeis">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bg-dark">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title text-white"></h4>
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
function CancelarVenta(){
        location.reload();
    }
var Contador = 0;
var TotalesId = [];
function AgregarFilaTabalVentasG(IdProducto,NombreProductos,Color,PrecioVenta, IdTipoProducto,Stok){
      
       
        var IdJsonVenta = TotalesId.indexOf(IdProducto);
        
        if(IdJsonVenta == -1){
        TotalesId.push(IdProducto);
        var Estilos = "background-color: #02394A; Color: white; text-align:center;   font-size:18px; padding:10px 1px 10px 5px;margin:0px auto;display:block;width:50%;border:none;border-bottom:1px solid #757575;";
        Contador++;
        var Fila = "<tr id='fila"+IdProducto+"'>"+
                    
                   
                    "<input type='hidden' style='"+Estilos+"'  name='IdProducto[]' readonly value="+IdProducto+">"+
                    "<td>"+NombreProductos+"</td>"+
                    "<td class='text-center d-none'>"+Contador+"</td>"+
                    "<td>"+"<input type='number' style='"+Estilos+"'   name='PrecioVenta[]' id='PrecioVenta"+IdProducto+"' readonly value="+PrecioVenta+">"+"</td>"+
                    "<td>"+Color+"</td>"+
                    "<td>"+"<input type='number' style='"+Estilos+"'  onchange='TotalPagarUnidadVenta(this.value,"+IdProducto+","+IdTipoProducto+","+Stok+")' id='TxtCantidad'  name='Cantidad[]'>"+"</td>"+
                    "<td>"+"<input type='number' style='"+Estilos+"'  readonly  name='TotalUnidad[]' id='TotalUnit"+IdProducto+"' >"+"</td>"+
                    "<td>"+"<button onclick='EliminarFilaVenta("+IdProducto+")' class='form-control btn btn-danger'>"+ "<i class='fas fa-trash-alt'>"+"</i>"+"</button>" +"</td>"+
                    +"</tr>"
        $("#Tbl_BodyCompra").append(Fila);
        $("#DivBtnTableVentas").show();
        }else{
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Este Producto ya existe en la tabla!'
            })
        }
    } 
    var Cambio = 0;
    function CambioVuelto(Efectivo){
        var TotalVenta = parseInt($("#TotalFinVenta").val());
      
        console.log('Efectivo'+Efectivo)
        console.log('TotalVenta'+TotalVenta)
        if(Efectivo < TotalVenta){
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El Efectivo es menor que el Total de la Venta!'
            })
            $("#Cambio").val(0);
        }else if(Efectivo >= TotalVenta){
            Cambio = Efectivo - TotalVenta;
            $("#Cambio").val(Cambio);
        }
    }
    function TotalPagarUnidadVenta(Cantidad,IdProducto,IdTipoProducto,Stok){
        if(Stok >= Cantidad){
            if(IdTipoProducto == 1 || IdTipoProducto == 2){
            $.ajax({
                url: '/ModalSeleccionarImeisVenta',
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    IdProducto     : IdProducto,
                    Cantidad        : Cantidad                   
                },
                success: function(response){
                    $("#MdSeleccionarImeis").modal({backdrop: 'static', keyboard: false});
                    $("#MdBodyAgregarImeis").html(response);
                },
                error : function(error){
                    alert('Ocurrio un erro inesperado');
                }
            });
                    var PrecioVenta = $("#PrecioVenta"+IdProducto).val();
                    var TotalPagar = PrecioVenta * Cantidad;
    
                    $("#TotalUnit"+IdProducto).val(TotalPagar);
                    FuncTotalFinalVenta(IdProducto);
        }else{
                    var PrecioVenta = $("#PrecioVenta"+IdProducto).val();
                    var TotalPagar = PrecioVenta * Cantidad;
    
                    $("#TotalUnit"+IdProducto).val(TotalPagar);
                    FuncTotalFinalVenta(IdProducto);
        }
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Tu Canitdad es mayor que tu Stok actula!'
            })
        }
    

    } 
    var TotalFinalVenta = 0;
    function FuncTotalFinalVenta(IdProducto){
        
        var TotalUnit = $("#TotalUnit"+IdProducto).val();
        TotalFinalVenta += parseInt(TotalUnit);
        $("#TotalFinVenta").val(TotalFinalVenta);

    }
    var IdexOf = 0;
    function EliminarFilaVenta(IdProducto){
        
        IdexOf = TotalesId.indexOf(IdProducto) 
        console.log('IdexOf'+IdexOf);
        console.log('IdProducto'+IdProducto);
        if(IdexOf != -1){
            TotalesId.splice(IdexOf); 
         
        }

        Contador--;
            var TotalUnidad = parseInt($("#TotalUnit"+IdProducto).val());
            $("#fila" + IdProducto).remove();
            var TotalCompra = parseInt( $("#TotalFinVenta").val());
        
        if(Contador == 0){
                TotalFinalVenta = 0;
                $("#TotalFinVenta").val(TotalFinalVenta);
            }else if(Contador !=0 ){
                TotalFinalVenta = TotalCompra - TotalUnidad;
                console.log(TotalesId);
                $("#TotalFinVenta").val(TotalFinalVenta);
            }
        
    }
 
    function VerProductos(){
        var IdCliente     = $("#Select").val();

        if(IdCliente == 0){
            alert('Selecciona una sucursal')
            $("#IdSucursal").focus();
        }else{
            $.ajax({
			url: '/ListadoProductosVenta',
			type: 'POST',
			data: {
                "_token": "{{ csrf_token() }}"
                },
			success: function(response){
                $("#Row_Listar").html(response);
                $("#BuscarProducto").show();
                
               
			},
			error: function(error){
				alert('ocurrio un error inesperado');
			}
		});
        }

	}
    function SeleccionarCliente(IdCliente){
        $.ajax({
            url: '/SeleccionarCliente',
            type: 'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                IdCliente: IdCliente
            },
            success: function(response){
                $("#DivClienteVenta").html(response);
                $("#RowCliente").hide();
                VerProductos();
            },
            error: function(){
                alert('No se encontro la direccion');
            }
        });
    }
    function VentasBuscarProducto(Info){
     $.ajax({
        url: '/BuscadorProductosVenta',
        type: 'POST',
        data:{
            "_token": "{{ csrf_token() }}",
            Info : Info
           
        },
        success: function(response){
            $("#Row_Listar").html(response);
        },
        error: function(erro){
            alert('Ocurrio un error inesperado');
        }
     });
  }
// Generar Venta

    function GenerarVenta(){
        var Formulario = document.getElementById('FrmGenerarVenta');
        if(Formulario.reportValidity()){
            var FrmEnviar = $("#FrmGenerarVenta").serialize();
            var Token = "{{ csrf_token() }}";
            $.ajax({
                url: '/GenerarVenta',
                type: 'POST',
                data: FrmEnviar + "&_token="+Token,
                datatype: 'json',
                success: function(response){
                    if(response == 1){
                            Swal.fire(
                            'Venta',
                            'Venta Generada con exito',
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
                error: function(error){
                    alert('No se encontro la direccion');
                }

            });
        }
    }

    </script>
 