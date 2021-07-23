@extends('layouts.app', ['page' => __('TypeUser'), 'pageSlug' => 'TypeUser'])

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
                        <h2 class="card-title">Tipos De Usuario</h2>
                    </div>
                    <div class="col-4 text-right">
                        <a onclick="FrmCrearTypeUser()"  class="card-link text-dark" data-toggle="collapse" href="#CrearProducto">
                    <button class="btn btn-info mt-3">
                    <i class="fas fa-plus"></i>
                    </button>
                    </a>
               </div>
       
            </div>
            
           
        </div>
            <div  id="CrearProducto" class="collapse" data-parent="#accordion">  
                <div class="card-body all-icons" id="Body_CreateTypeUser">

                </div>
            </div>
            <div class="card-header ">
                <table class="table table-hover">
                <thead>
                        <tr>
                        <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>
                            <th colspan="1">&nbsp;</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                 </thead>
                 <tbody>
                    @foreach($TypeUser as $Type)
                        <tr>
                            <td class="text-center">{{$Type->IdTipoUsuario}}</td>
                            <td class="text-center">{{$Type->Descripcion}}</td>
                            <td class="text-right">
                                @if($Type->Estado == 1)
                                <td class="td-actions text-center">
                              
                                <a onclick="FrmModificarTypeUser({{$Type->IdTipoUsuario}})"  class="card-link text-dark" data-toggle="collapse" href="#CrearProducto">
                                <button type="button" rel="tooltip" class="btn btn-primary btn-lg btn-round btn-icon">
                                    <i class="tim-icons icon-settings"></i>
                                </button>
                               </a>
                                <button onclick="DeleteTypeUser({{$Type->IdTipoUsuario}})" type="button" rel="tooltip" class="btn btn-danger btn-lg btn-round btn-icon">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </td>
                                @elseif($Type->Estado == 0)
                                <td class="td-actions text-center">
                               
                            
                            <button onclick="HabilitarTypeUser({{$Type->IdTipoUsuario}})" type="button" rel="tooltip" class="btn btn-success text-dark">
                                    Habilitar Rol.
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
        @endsection
        <script>
            function FrmCrearTypeUser(){
                $.ajax({
            url: '/FrmCreateTypeUser',
            type:'POST',
            data: {
                "_token": "{{ csrf_token() }}"
               
            },
            success: function(response){
                $("#Body_CreateTypeUser").html(response)
            },
            error : function(error){
                alert('No se Encontro la dirección');
            }
        });
            }
            function DeleteTypeUser(IdTypeUser){
                Swal.fire({
                title: 'Quieres eliminar este Rol?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminarlo!'
                }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                url: '/DeleteTypeUser',
                type: 'POST',
                data:{ IdTypeUser: IdTypeUser, "_token": "{{ csrf_token() }}"},
                success:function(response){
                if(response == 1){
                        Swal.fire(
                    'Eliminado!',
                    'El Rol ha sido deshabilitado.',
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
        function HabilitarTypeUser(IdTypeUser){
            Swal.fire({
                title: 'Quieres Habilitar este Rol?',
               
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Habilitar!'
                }).then((result) => {
            if (result.isConfirmed) {
            $.ajax({
                url: '/HabilitarTypeUser',
                type: 'POST',
                data:{ IdTypeUser: IdTypeUser, "_token": "{{ csrf_token() }}"},
                success:function(response){
                if(response == 1){
                        Swal.fire(
                    'Habilitado!',
                    'El Rol ha sido Habilitado.',
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

        function FrmModificarTypeUser(IdTypeUser){
                $.ajax({
            url: '/FrmModificarTypeUser',
            type:'POST',
            data: {
                "_token": "{{ csrf_token() }}" ,
                IdTypeUser: IdTypeUser
            },
            success: function(response){
                $("#Body_CreateTypeUser").html(response)
            },
            error : function(error){
                alert('No se Encontro la dirección');
            }
        });
            }
        </script>