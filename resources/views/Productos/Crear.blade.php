@extends('layouts.app', ['page' => __('Icons'), 'pageSlug' => 'CrearProducto'])

@section('content')
@if (session('info'))
                        <div class="alert alert-success" role="alert">
                            {{ session('info') }}
                        </div>
                    @endif 
<div class="row">

    
      <div class="card">
        <div class="card-header">
          <h3 class="title">Crear Productos</h3>
          <p class="category">Seleccione una Categoria para crear un producto</p>
        </div>
        <div class="card-body all-icons">
          <div class="row justify-content-center"><!-- Row 1--> 
            <div class="col-md-6 form-group">
                <div class="input-group{{ $errors->has('TipoUsuario') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <i class="fas fa-star" id="SeleccionarProducto"></i>
                            </div>
                        </div>                                   
                        <select onchange="ElegirFormulario(this.value)" id="IdTipoProducto"  name="IdTipoProducto" class="form-control{{ $errors->has('TipoUsuario') ? ' is-invalid' : '' }}" placeholder="{{ __('TipoUsuario') }}" required>
                            <option class="bg-dark" value="0">Elige un Tipo</option>
                            @foreach($TipoProductos as $TipoProducto)
                            <option class="bg-dark" value="{{$TipoProducto->IdTipoProducto}}">{{$TipoProducto->Descripcion}}</option>
                            @endforeach
                        </select>
                        @include('alerts.feedback', ['field' => 'TipoUsuario'])
                    </div>
                </div>  
            </div>
        </div><!--Fin del Row 1-->
                    <br>
        <div class="row justify-content-center" id="BodyFrm"><!-- Row 2--> 

        </div>

        </div><!--Fin De Card-->
    </div>
</div>
@endsection
<script>

    function ViewListMarcas(IdProveedor){
        
        $.ajax({
            url: '/ListarMarca',
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                IdProveedor: IdProveedor
            },
           success: function(response){
            $("#Dv_SelectMarca").show();
            $("#Dv_SelectMarca").html(response);
           },
           error: function(){

           }
        });
    }

    function ElegirFormulario(IdTipo){
     if(IdTipo == 1 || IdTipo  == 3){
         
        $.ajax({
            url: '/FrmCrearProducto',
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                IdTipo: IdTipo
            },
           success: function(response){
            
            $("#BodyFrm").html(response);
           },
           error: function(){

           }
        });
     }else if(IdTipo == 2){
        
        $.ajax({
            url: '/FrmCrearChip',
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                IdTipo: IdTipo
            },
           success: function(response){
            
            $("#BodyFrm").html(response);
           },
           error: function(){

           }
        });
     }
    }
 

    function GuardarProducto(){
        var IdSucursalT = $("#IdSucursal").val();
        var IdProveedorT = $("#IdProveedorT").val();
        var IdMarcaT = $("#IdMarcaT").val();
        var DescripcionT = $("#DescripcionT").val();
        var PrecioVentaT = $("#PrecioVentaT").val();
        var PrecioCompraT = $("#PrecioCompraT").val();
        var GananciaT = $("#GananciaT").val();
        var IdColorT = $("#IdColorT").val();
        if(IdSucursalT == 0){
                alert('Seleccione una sucursal');
                $("#IdSucursal").focus();
            }else if(IdProveedorT = 0){
                alert('Selecciones un proveedor');
                $("#IdProveedorT").focus();
            }else if(IdMarcaT == 0){
                alert('Selecciones una Marca');
                $("#IdProveedorT").focus();
            }else if(DescripcionT == ""){
                alert('Rellene el campo Descripción');
                $("#DescripcionT").focus();
            }else if(PrecioVentaT == 0.00){
                alert('Ingrese una cantidad superior');
                $("#PrecioVentaP").focus();
            }else if(PrecioCompraT == 0.00){
                alert('Ingrese una cantidad superior');
                $("#PrecioCompraP").focus();
            }else if(GananciaT == 0.00){
                alert('Ingrese una cantidad superior');
                $("#GananciaP").focus();
            }else if(IdColorT == 0){
                alert('Selecciones un Color');
                $("#IdColorT").focus();
            }else{
                var Formulario = document.getElementById('FrmCrearTelefono');
               if(Formulario.reportValidity()){
                var FrmEnviar = $("#FrmCrearTelefono").serialize();
                var Token = "{{ csrf_token() }}";
               
                $.ajax({
                    url : '/GuardarProducto',
                    type : 'POST',
                    data : FrmEnviar +"&_token="+Token+IdProveedorT,
                    success : function (response){
                        location.reload();   
                    },
                    error: function(error){
                        alert('Ocurrio un error inesperado');
                    }
                })
               }
            }
      
    }


    function GuardarAccesorio(){
    
        var IdProveedorT = $("#IdProveedorAC").val();
        var IdMarcaT = $("#IdMarcaAC").val();
        var DescripcionT = $("#DescripcionAC").val();
        var PrecioVentaT = $("#PrecioVentaAC").val();
        var PrecioCompraT = $("#PrecioCompraAC").val();
        var GananciaT = $("#GananciaAC").val();
        var IdColorT = $("#IdColorAC").val();
        if(IdProveedorT == 0){
            alert('Selecciones un proveedor');
                $("#IdProveedorAC").focus();
            }else if(IdProveedorT = 0){
                alert('Selecciones un proveedor');
                $("#IdProveedorAC").focus();
            }else if(IdMarcaT == 0){
                alert('Selecciones una Marca');
                $("#IdMarcaAC").focus();
            }else if(DescripcionT == ""){
                alert('Rellene el campo Descripción');
                $("#DescripcionAC").focus();
            }else if(PrecioVentaT == 0.00){
                alert('Ingrese una cantidad superior');
                $("#PrecioVentaAC").focus();
            }else if(PrecioCompraT == 0.00){
                alert('Ingrese una cantidad superior');
                $("#PrecioCompraAC").focus();
            }else if(GananciaT == 0.00){
                alert('Ingrese una cantidad superior');
                $("#GananciaAC").focus();
            }else if(IdColorT == 0){
                alert('Selecciones un Color');
                $("#IdColorAC").focus();
            }else{
                var Formulario = document.getElementById('FrmCrearAccesorio');
               if(Formulario.reportValidity()){
                var FrmEnviar = $("#FrmCrearAccesorio").serialize();
                var Token = "{{ csrf_token() }}";
               
                $.ajax({
                    url : '/GuardarProducto',
                    type : 'POST',
                    data : FrmEnviar +"&_token="+Token+IdProveedorT,

                    success : function (response){
                        location.reload();   
                    },
                    error: function(error){
                        alert('Ocurrio un error inesperado');
                    }
                })
               }
            }
      
    }


    function GuardarChip(){
    
    var IdProveedorT = $("#IdProveedorCH").val();
    
    var DescripcionT = $("#DescripcionCH").val();
    var PrecioVentaT = $("#PrecioVentaCH").val();
    var PrecioCompraT = $("#PrecioCompraCH").val();
    var GananciaT = $("#GananciaCH").val();
   
    if(IdProveedorT == 0){
        alert('Selecciones un proveedor');
            $("#IdProveedorAC").focus();
        }else if(IdProveedorT = 0){
            alert('Selecciones un proveedor');
            $("#IdProveedorAC").focus();
        }else if(DescripcionT == ""){
            alert('Rellene el campo Descripción');
            $("#DescripcionAC").focus();
        }else if(PrecioVentaT == 0.00){
            alert('Ingrese una cantidad superior');
            $("#PrecioVentaAC").focus();
        }else if(PrecioCompraT == 0.00){
            alert('Ingrese una cantidad superior');
            $("#PrecioCompraAC").focus();
        }else if(GananciaT == 0.00){
            alert('Ingrese una cantidad superior');
            $("#GananciaAC").focus();
        }else{
            var Formulario = document.getElementById('FrmCrearChip');
           if(Formulario.reportValidity()){
            var FrmEnviar = $("#FrmCrearChip").serialize();
            var Token = "{{ csrf_token() }}";
           
            $.ajax({
                url : '/GuardarChip',
                type : 'POST',
                data : FrmEnviar +"&_token="+Token+IdProveedorT,
                success : function (response){
                    location.reload();   
                },
                error: function(error){
                    alert('Ocurrio un error inesperado');
                }
            })
           }
        }
  
}

    function Ganancia(){
        var PrecioVentaT = $("#PrecioVentaT").val();
        var PrecioCompraT = $("#PrecioCompraT").val();
        var TotalGanancia = (PrecioVentaT - PrecioCompraT);
        $("#GananciaT").val(TotalGanancia);
    }

    function GananciaAC(){
        var PrecioVentaTA = $("#PrecioVentaAC").val();
        var PrecioCompraTA = $("#PrecioCompraAC").val();
        var TotalGananciaTA = (PrecioCompraTA - PrecioVentaTA);
        $("#GananciaACC").val(TotalGananciaTA);
    }
    

    function GananciaCHI(){
        var PrecioVentaCH = $("#PrecioVentaCH").val();
        var PrecioCompraCH = $("#PrecioCompraCH").val();
        var TotalGananciaCH = (PrecioCompraCH - PrecioVentaCH);
        $("#GananciaCH").val(TotalGananciaCH);
    }
</script>