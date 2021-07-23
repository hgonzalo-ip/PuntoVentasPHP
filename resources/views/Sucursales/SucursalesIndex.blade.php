@extends('layouts.app', ['page' => __('Sucursales'), 'pageSlug' => 'Sucursales'])

@section('content')

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
                        <h2 class="card-title">Sucursales</h2>
                    </div>
                    <div class="col-4 text-right">
                        <a onclick="FrmCreateSucursales()"  class="card-link text-dark" data-toggle="collapse" href="#CrearSucursales">
                    <button class="btn btn-info mt-3">
                    <i class="fas fa-plus"></i>
                    </button>
                    </a>
               </div>
       
            </div>
            
           
        </div>
        <div  id="CrearSucursales" class="collapse" data-parent="#accordion">  
            <div class="card-body all-icons" id="Body_CrearSucursales">

            </div>
        </div><!--Find del div collapse-->
            <div class="card-footer ">
           
            @if(sizeof($Sucursales) <=0 )
                 <center><h2 class="text-danger">No hay Ningun Dato</h2></center>
            @elseif(sizeof($Sucursales) >= 1)
                <table class="table table-hover table-striped " id="Tabla">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Direccion</th>
                            <th class="text-center">Telefono</th>
                          
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php 
                            $Contador = 1;
                        @endphp
                        @foreach($Sucursales as $sucur)
                            <tr>
                                <td class="text-center">{{$Contador++}}</td>
                                <td class="text-center">{{$sucur->Nombre}}</td>
                                <td class="text-center">{{$sucur->Direccion}}</td>
                                <td class="text-center">{{$sucur->Telefono}}</td>
                         
                                @if($sucur->Estado == 1)
                                <td class="text-center">
                                    <a onclick="FrmEditarSucursal({{$sucur->IdSucursal}})" class="card-link text-dark" data-toggle="collapse" data-target="#CrearSucursales">
                                        <button type="button" rel="tooltip" class="btn btn-info btn-lg btn-round btn-icon">
                                            <i class="tim-icons icon-settings"></i>
                                        </button>
                                    </a>
                                    <button onclick="EliminarSucursal({{$sucur->IdSucursal}})" type="button" rel="tooltip" class="btn btn-danger btn-lg btn-round btn-icon">
                                        <i class="tim-icons icon-simple-remove"></i>
                                    </button>
                                </td>                                
                                @elseif($sucur->Estado == 0)
                                <td class="text-center">
                                <button onclick="HabilitarSucursal({{$sucur->IdSucursal}})" type="button" rel="tooltip" class="btn btn-success text-dark">
                                         Habilitar Sucursal.
                                </button>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif    
  
            </div>
        </div>
        </div>
        <!--Modales-->
        <div class="modal" id="MyModalProveedores">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 class="modal-title">Proveedores</h2>
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
        function FrmCreateSucursales(){
            $.ajax({
                url: '/FrmCrearSucursal',
                type:'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                
                },
                success: function(response){
                    
                    $("#Body_CrearSucursales").html(response)
                },
                error : function(error){
                    alert('No se Encontro la dirección');
                }
            });
    }
    function FrmEditarSucursal(IdSucursal){
            $.ajax({
                url: '/FrmEditarSucursal',
                type:'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    IdSucursal : IdSucursal
                },
                success: function(response){
                    
                    $("#Body_CrearSucursales").html(response)
                },
                error : function(error){
                    alert('No se Encontro la dirección');
                }
            });
    }
    function EliminarSucursal(IdSucursal){
                Swal.fire({
                        title: 'Quieres eliminar esta sucursal?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminarlo!'
                    }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/EliminarSucursal',
                    type: 'POST',
                    data:{ IdSucursal: IdSucursal, "_token": "{{ csrf_token() }}"},
                    success:function(response){
                        if(response == 1){
                                Swal.fire(
                            'Eliminado!',
                            'La Sucursal ha sido desabilitada.',
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
    function HabilitarSucursal(IdSucursal){
        Swal.fire({
            title: 'Quieres Habilitar esta sucursal?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Habilitar!'
            }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            url: '/HabilitarSucursal',
            type: 'POST',
            data:{ IdSucursal: IdSucursal, "_token": "{{ csrf_token() }}"},
            success:function(response){
                if(response == 1){
                        Swal.fire(
                    'Habilitada!',
                    'La Sucursal ha sido Habilitada.',
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