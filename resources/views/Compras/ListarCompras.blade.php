@extends('layouts.app', ['page' => __('ListarCompras'), 'pageSlug' => 'ListarCompras'])

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
         
         
            
            <h3 class="title">Listado Compras</h3>
             <p class="category">Seleccione una sucursal para listar los productos</p>
        
         
        </div>
        <div class="card-body all-icons">
        <div class="row justify-content-center"> 
            <div class="col-md-6 form-group">
                <select onchange="ActivarFiltros()" class="form-control class="bg-dark"" name="IdSucursal" id="IdSucursal">
                <option selected disabled class="bg-dark">Elige una Opcion</option>
                @foreach($Sucursales as $ListadoSucursales)
                    <option value="{{$ListadoSucursales->IdSucursal}} "class="bg-dark">{{$ListadoSucursales->Nombre}}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="row justify-content-center d-none" id="RowFiltrado"><!-- Row 2--> 
            <div class="col-md-5 form-group">
                <div class="input-group{{ $errors->has('TipoUsuario') ? ' has-danger' : '' }}" id="DivSucursal">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                            
                            <i class="fas fa-warehouse"></i>
                            </div>
                        </div>                                   
                            <select onchange="VerFiltrado(this.value)" name="FiltroListado" id="FiltroListado" class="form-control">
                                <option selected disabled class="bg-dark">Elige una Opcion</option>
                                <option value="1" class="bg-dark">Fecha Especifica</option>
                                <option value="2" class="bg-dark">Entre Fechas</option>
                                <option value="3" class="bg-dark">Por Mes</option>
                                <option value="4" class="bg-dark">Por Año</option>
                            </select>
                    </div>
                </div>  
           
               
            </div><!--Fin del Row 2-->
        <!-- Divs Filtros -->
            <div class="row justify-content-center d-none" id="DvFechaEspecifica">
                    <div class="col-md-6 form-group">
                        <label>Ingresa Una Fecha</label>
                        <input onchange="BuscarFiltroFecha()" type="date" class="form-control"  name="FechaEspecifica" id="FechaEspecifica" required>
                    </div>
            </div>

            <div class="row justify-content-center d-none" id="EntreFechas">                  
                    <div class="col-md-5 form-group">
                        <label>Feha Inicio</label>
                        <input   type="date" class="form-control"  name="FechaInicial" id="FechaInicial" required>
                    </div>
                    
                    <div class="col-md-5 form-group">
                        <label>Feha Fin</label>
                        <input onchange="FiltroEntreFecha()" type="date" class="form-control"  name="FechaFin" id="FechaFin" required>
                    </div>
            </div>
            <div class="row justify-content-center d-none" id="PorMes">
                    <div class="col-md-5 form-group">
                        <label>Mes</label>
                        <input type="month" onchange="FiltroPorMes()" class="form-control"  name="Mes" id="Mes" required>
                    </div>
                    
                  
            </div>
            <div class="row justify-content-center d-none" id="PorYear">
                    <div class="col-md-5 form-group">
                        <label>Por Año</label>
                        <input type="number"  onchange="FechaYear(this.value)" class="form-control"  name="year" id="year" required>
                    </div>
            </div>
          <!--FIn divs Filtros  -->
       <!--Row para la Tabla  --><br>
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha Compra</th>
                            <th> Usario </th>
                          
                            <th>Toal De Compra</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="TblBody">
                        @php
                            $Contador=1;
                        @endphp
                        @foreach($ListadoCompras as $Listado)
                        <tr>
                            <td>{{$Contador++}}</td>
                            <td>{{$Listado->FechaCompra}}</td>
                            <td>{{$Listado->User->Nombres}} {{$Listado->User->Apellidos}}</td>
                            
                            <td>{{$Listado->Total}}</td>
                            <td>    
                            <a href="{{ route('PdfCompras', $Listado->IdCompra) }}">
                                <button  class="btn btn-info btn-sm">
                                    Imprimir
                                </button>
                                </a> 
                          
                                <button onclick="VerDetalle({{$Listado->IdCompra}})" class="btn btn-warning btn-sm">
                                    Ver Detalles
                                </button>
                                <button onclick="VerImeisComprados({{$Listado->DetalleCompra[0]->IdProducto}})" class="btn btn-success btn-sm text-center">
                                    Ver Imeis
                                </button>
                            </td>
                     
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
       </div>

        </div><!--fin del car body-->


     </div>

       <!-- Modal de cargando -->
    <div id="MdDetalleCompra" class="modal fade"  role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content bg-dark">
                <div class="modal-body" id="BodyDetalleCompra">
                    <h3>alñsdjfk</h3>
                </div>
            </div>
        </div>
    </div>
     <!-- Modal de cargando Fin-->
@endsection

<script>
 function VerImeisComprados(IdProducto){
        $.ajax({
            url: '/VerImeisComprados',
            type: 'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                IdProducto: IdProducto
            },
            beforeSend: function(){
                // {backdrop: 'static', keyboard: false} Bloquear Modal
                $("#MdCargando").modal({backdrop: 'static', keyboard: false});
            },
            success: function(response){
                $("#MdDetalleCompra").modal('show');
                $("#BodyDetalleCompra").html(response);
            },
            error: function(error){
                alert('No se ecnotro la direccioón');
            }
            
        });
    }
    function ActivarFiltros(){
        $("#RowFiltrado").removeClass('d-none')
    }
    function VerFiltrado(Filtro){
        if(Filtro == 1){
            $("#PorYear").addClass('d-none');
            $("#DvFechaEspecifica").removeClass('d-none');
            $("#EntreFechas").addClass('d-none');
            $("#PorMes").addClass('d-none');
           
        }else if(Filtro == 2){
            $("#PorYear").addClass('d-none');
            $("#PorMes").addClass('d-none');
            $("#DvFechaEspecifica").addClass('d-none');
            $("#EntreFechas").removeClass('d-none');
            
        }else if(Filtro == 3){
            $("#PorYear").addClass('d-none');
            $("#DvFechaEspecifica").addClass('d-none');
            $("#EntreFechas").addClass('d-none');
            $("#PorMes").removeClass('d-none');
            
        }else if(Filtro == 4){
            $("#DvFechaEspecifica").addClass('d-none');
            $("#EntreFechas").addClass('d-none');
            $("#PorMes").addClass('d-none');
            $("#PorYear").removeClass('d-none');
            
        }
    }
    function BuscarFiltroFecha(){
        var Sucursal = $("#IdSucursal").val();
        var Fecha = $("#FechaEspecifica").val();
        $.ajax({
            url: '/FiltroFecha',
            type: 'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                Fecha: Fecha,
                Sucursal:Sucursal
            },
         
            success: function(response){
              
                 
                    $("#TblBody").html(response);
                    // La Respuesta que debuelve la peticion solo sera TR 

         
            },
            error: function(error){
                alert('No se ecnotro la direccioón');
            }
            
        });
    }
    function FiltroEntreFecha(){
        var Sucursal = $("#IdSucursal").val();
        var FechaInicio = $("#FechaInicial").val();
        var FechaFin = $("#FechaFin").val();
        if(FechaInicio == ""){
            alert('Ingresa la Fecha De Inicio')
            $("#FechaInicial").focus();
        }else{
            $.ajax({
                url: '/FiltroEntreFecha',
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    FechaInicio: FechaInicio,
                    FechaFin    : FechaFin,
                    Sucursal:Sucursal
                },

                success: function(response){
                
                      
                        $("#TblBody").html(response);
                        // La Respuesta que debuelve la peticion solo sera TR 

            
                },
                error: function(error){
                    alert('No se ecnotro la direccioón');
                }
                
            });
        }
    }
    function FiltroPorMes(){
        var Sucursal = $("#IdSucursal").val();
        var Mes = $("#Mes").val();
        $.ajax({
                url: '/FiltroMes',
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    Mes: Mes,
                    Sucursal:Sucursal
                    
                },
                beforeSend: function(){
                    // {backdrop: 'static', keyboard: false} Bloquear Modal
                    $("#MdCargando").modal({backdrop: 'static', keyboard: false});
                },
                success: function(response){
                
                        $("#MdCargando").modal('hide');
                        $("#TblBody").html(response);
                        // La Respuesta que debuelve la peticion solo sera TR 

            
                },
                error: function(error){
                    alert('No se ecnotro la direccioón');
                }
                
            });
    }

    function FechaYear(Year){
        var Sucursal = $("#IdSucursal").val();
        $.ajax({
                url: '/FiltroYear',
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    Year: Year,
                    Sucursal:Sucursal
                    
                },
                beforeSend: function(){
                    // {backdrop: 'static', keyboard: false} Bloquear Modal
                    $("#MdCargando").modal({backdrop: 'static', keyboard: false});
                },
                success: function(response){
                
                        $("#MdCargando").modal('hide');
                        $("#TblBody").html(response);
                        // La Respuesta que debuelve la peticion solo sera TR 

            
                },
                error: function(error){
                    alert('No se ecnotro la direccioón');
                }
                
            });

    }
    // DetalleCompra
    function VerDetalle(IdCompra){
        $.ajax({
            url: '/VDetalleCompra',
            type: 'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                IdCompra: IdCompra
            },
            beforeSend: function(){
                // {backdrop: 'static', keyboard: false} Bloquear Modal
                $("#MdCargando").modal({backdrop: 'static', keyboard: false});
            },
            success: function(response){
                $("#MdDetalleCompra").modal('show');
                $("#BodyDetalleCompra").html(response);
            },
            error: function(error){
                alert('No se ecnotro la direccioón');
            }
            
        });
    }
    function PdfCompras(IdCompra){
        $.ajax({
            url: '//'+IdCompra,
            type: 'GET',
            data:{
                "_token": "{{ csrf_token() }}"
               
            },
            error: function(error){
                alert('No se ecnotro la direccioón');
            }
            
        });
    }
</script>