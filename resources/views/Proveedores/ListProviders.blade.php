@extends('layouts.app', ['page' => __('Proveedores'), 'pageSlug' => 'Proveedores'])

@section('content')
@inject('Funciones', 'App\Http\Controllers\Funciones')       
<div id="accordion"> 
@if (session('info'))
                        <div class="alert alert-success" role="alert">
                            {{ session('info') }}
                        </div>
                    @endif 
	<div class="card">
        <div class="card-header">   
            
            <div class="row">
                <div class="col-8">
                        <h2 class="card-title">Proveedores</h2>
                    </div>
                    <div class="col-4 text-right">
                        <a onclick="FrmCreateProviders()"  class="card-link text-dark" data-toggle="collapse" href="#CrearProvedor">
                    <button class="btn btn-info mt-3">
                    <i class="fas fa-plus"></i>
                    </button>
                    </a>
               </div>
       
            </div>
            
           
        </div>
        <div  id="CrearProvedor" class="collapse" data-parent="#accordion">  
            <div class="card-body all-icons" id="Body_CreateProviders">

            </div>
            </div><!--Find del div collapse-->
            <div class="card-header ">
                <table class="table table-hover table-striped" id="TablaProveedores">
                <thead>
                        <tr>
                        <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Direccion</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">NIT</th>
                            <th class="text-center">No Marcas</th>
                            <th class="text-center">Acciones</th>
                          
                        </tr>
                 </thead>
   
                 <tbody>
                    @foreach($Proveedores as $Pro)

                        <tr>
                            <td class="text-center">{{$Pro->IdProveedor}}</td>
                            <td class="text-center">{{$Pro->Nombre}}</td>
                            <td class="text-center">{{$Pro->Direccion}}</td>
                            <td class="text-center">{{$Pro->Telefono}}</td>
                            <td class="text-center">{{$Pro->Nit}}</td>
                            @php
                            $NumeroDeMarcas = $Funciones::NumeroMarcas( $Pro->IdProveedor);
                            @endphp
                            <td class="text-center">
                            {{$NumeroDeMarcas}}
                            </td>
                            @if($Pro->Estado == 1)
                            <td class="text-center">
                            <button onclick="AgregarMarca({{$Pro->IdProveedor}})" type="button" rel="tooltip" class="btn btn-success btn-lg btn-round btn-icon">
                            <i class="fas fa-list"></i>
                                </button>
                            <a onclick="FrmModificarProveedor({{$Pro->IdProveedor}})" class="card-link text-dark" data-toggle="collapse" data-target="#CrearProvedor">
                                <button type="button" rel="tooltip" class="btn btn-primary btn-lg btn-round btn-icon">
                                    <i class="tim-icons icon-settings"></i>
                                </button>
                            </a>
                                <button onclick="DeleteProviders({{$Pro->IdProveedor}})" type="button" rel="tooltip" class="btn btn-danger btn-lg btn-round btn-icon">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </td>
                            @elseif($Pro->Estado == 0)
                            
                            <td class="text-center">
                 
                            <button onclick="HabilitarProveedor({{$Pro->IdProveedor}})" type="button" rel="tooltip" class="btn btn-success text-dark">
                                    Habilitar Proveedor.
                                </button>
                            </td>
                            @endif
                           
                        </tr>
                
                    @endforeach
   
                   

                 </tbody>
  
                </table>
            </div>
        </div>
        </div>
        <!--Modales-->
        <div class="modal" id="MyModalProveedores">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-dark">

                <!-- Modal Header -->
                <div class="modal-header">
                    <center><h2 class="modal-title text-white">Proveedores-Agregar Marca</h2></center>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body" id="Body_Proveedores">
                    
                </div>

                

                </div>
            </div>
        </div>
        <!--Fin de Modal-->
        @endsection
    
        <script>
        $(document).ready(function(){
                $("#TablaProveedores").DataTable();
            });
            function FrmCreateProviders(){
                $.ajax({
                    url: '/FrmCreateProviders',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    
                    },
                    success: function(response){
                        
                        $("#Body_CreateProviders").html(response)
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
            }

            function FrmModificarProveedor(IdProviders){
                $.ajax({
                    url: '/FrmModificarProviders',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        IdProviders : IdProviders
                    
                    },
                    success: function(response){
                        $("#Body_CreateProviders").html(response)
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
            }
            function AgregarMarca(IdProviders){
                $.ajax({
                    url: '/TblListMarcas',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        IdProviders: IdProviders
                    },
                    success: function(response){
                        $("#MyModalProveedores").modal('show');
                        $("#Body_Proveedores").html(response)
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
              
            }
            function DeleteProviders(IdProveedor){
                Swal.fire({
                        title: 'Quieres eliminar este Proveedor?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminarlo!'
                    }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/DeleteProveedor',
                    type: 'POST',
                    data:{ IdProveedor: IdProveedor, "_token": "{{ csrf_token() }}"},
                    success:function(response){
                        if(response == 1){
                                Swal.fire(
                            'Eliminado!',
                            'El Proveedor ha sido deshabilitado.',
                            'success'
                        ).then((res) =>{
                            if(res.isConfirmed){
                            location.reload();
                            }
                        })
                        
                        }
                    },
                    error:function(error){
                        swal({
                            text : 'Ocurrio un error Inesperado',
                            icon : 'error'
                        })
                    }
                    });
                
                }
                })
            }
            function HabilitarProveedor(IdProveedor){
                Swal.fire({
                        title: 'Quieres Habilitar este Proveedor?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Habilitarlo!'
                    }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/HabilitarProveedor',
                    type: 'POST',
                    data:{ IdProveedor: IdProveedor, "_token": "{{ csrf_token() }}"},
                    success:function(response){
                        if(response == 1){
                                Swal.fire(
                            'Habilitado!',
                            'El Proveedor ha sido Habilitado.',
                            'success'
                        ).then((res) =>{
                            if(res.isConfirmed){
                            location.reload();
                            }
                        })
                        
                        }
                    },
                    error:function(error){
                        swal({
                            text : 'Ocurrio un error Inesperado',
                            icon : 'error'
                        })
                    }
                    });
                
                }
                })
            }
        </script>
       