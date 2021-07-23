@extends('layouts.app', ['page' => __('Icons'), 'pageSlug' => 'Listado'])

@section('content')
                @if (session('Message'))
                        <div class="row justify-content-center form-group alert alert-success">
                            <div class="col-md-6">
                                <h5>{{ session('Message') }}</h5>
                            </div>
                        </div>
                    @endif
	<div class="card">
        <div class="card-header">
          <h3 class="title">Listado Productos</h3>
          <p class="category">Seleccione una Categoria para listar los productos</p>
        </div>
        <div class="card-body all-icons">
        <div class="row justify-content-center"><!-- Row 2--> 
            <div class="col-md-6 form-group">
                <div class="input-group{{ $errors->has('TipoUsuario') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            
                            <i class="fas fa-warehouse"></i>
                            </div>
                        </div>                                   
                        <select onchange="VerProductos()" id="IdSucursal"  name="IdSucursal" class="form-control{{ $errors->has('TipoUsuario') ? ' is-invalid' : '' }}" placeholder="{{ __('TipoUsuario') }}" required>
                            <option class="bg-dark" value="0">Elige uns sucursal</option>
                            @foreach($Sucursales as $Sucursal)
                            <option class="bg-dark" value="{{$Sucursal->IdSucursal}}">{{$Sucursal->Nombre}}</option>
                            @endforeach
                        
                        </select>
                        @include('alerts.feedback', ['field' => 'TipoUsuario'])
                    </div>
                </div>  
            </div><!--Fin del Row 2-->
        	 <div class="row justify-content-center" id="DivTipoProducto" style="display: none;"><!-- Row 1--> 
            <div class="col-md-6 form-group">
                <div class="input-group{{ $errors->has('TipoUsuario') ? ' has-danger' : '' }}">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            <i class="fas fa-star" id="SeleccionarProducto"></i>
                            </div>
                        </div>                                   
                        <select  onchange="VerProductos()" id="IdTipoProducto"  name="IdTipoProducto" class="form-control{{ $errors->has('TipoUsuario') ? ' is-invalid' : '' }}"  required>
                            <option class="bg-dark" value="4">Elige un Tipo</option>
                            @foreach($TiposProductos as $TipoProducto)
                            <option class="bg-dark" value="{{$TipoProducto->IdTipoProducto}}">{{$TipoProducto->Descripcion}}</option>
                            @endforeach
                            <option class="bg-dark" value="0">Productos Desactivados</option>
                        </select>
                        @include('alerts.feedback', ['field' => 'TipoUsuario'])
                    </div>
                </div>  
           
            </div><!--Fin del Row 1-->
            <br>
            <div class="row justify-content-center">
                    <div class="col-md-8 form-group">
                    <input onkeyup="BuscarProducto(this.value)" type="search" class="form-control bg-white text-dark" style="width:100%; display:none" name="BuscarProducto" id="BuscarProducto" placeholder="Buscar">
                    </div>
                </div>
              <div class="row justify-content-center" id="Row_Listar" style="overflow: scroll; height: 470px">
                
            
            </div>
             
          
        </div><!--fin del car body-->


     </div>

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

@endsection
<script type="text/javascript">

	function VerProductos(){
        var IdTipoProducto = $("#IdTipoProducto").val();
        var IdSucursal     = $("#IdSucursal").val();
		var Token = "{{ csrf_token() }}";
      
        if(IdSucursal == 0){
            alert('Selecciona una sucursal')
            $("#IdSucursal").focus();
        }else{
            $.ajax({
			url: '/ListadoProductos',
			type: 'POST',
			data: {
                "_token": "{{ csrf_token() }}",
                IdTipoProducto : IdTipoProducto,
                IdSucursal     : IdSucursal
                },
			success: function(response){
                $("#Row_Listar").html(response)
                $("#BuscarProducto").show();
                $("#DivTipoProducto").show();
                
			},
			error: function(error){
				alert('ocurrio un error inesperado');
			}
		});
        }

	}
    function BuscarProducto(Info){
        var IdSucursal = $("#IdSucursal").val();
        var IdTipoProducto = $("#IdTipoProducto").val();
     $.ajax({
        url: 'BuscadorProductosPro',
        type: 'POST',
        data:{
            "_token": "{{ csrf_token() }}",
            Info : Info,
            IdSucursal : IdSucursal,
            IdTipoProducto : IdTipoProducto
        },
        success: function(response){
            $("#Row_Listar").html(response);
        },
        error: function(erro){
            alert('Ocurrio un error inesperado');
        }
     });
  }
</script>