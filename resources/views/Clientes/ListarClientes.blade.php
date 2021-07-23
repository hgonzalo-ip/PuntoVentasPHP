@extends('layouts.app', ['page' => __('Icons'), 'pageSlug' => 'ListadoClientes'])

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
                        <h2 class="card-title">Clientes</h2>
                    </div>
                    <div class="col-4 text-right">
                        <a onclick="FrmCrearCliente()"  class="card-link text-dark" data-toggle="collapse" href="#CrearMarca">
                    <button class="btn btn-info mt-3">
                    <i class="fas fa-plus"></i>
                    </button>
                    </a>
               </div>
       
            </div>
            
           
        </div>
        <div  id="CrearMarca" class="collapse" data-parent="#accordion">  
            <div class="card-body all-icons" id="BoyCardCliente">
               
            </div>
        </div><!--Find del div collapse-->
        <br>
        <div class="card-foteer">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Nombre Completo</th>
                    <th class="text-center">NIT</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        $Contador=1;
                    @endphp
                    @foreach($Clientes as $Client)
                        <tr>
                            <td class="text-center">{{$Contador++}}</td>
                            <td class="text-center">{{$Client->Nombres}}{{$Client->Apellidos}}</td>
                            <td class="text-center">{{$Client->NIT}}</td>
                            @if($Client->Estado == 1)
                                <td class="text-center">Activo</td>
                                <td class="text-center">
                                    <button class="btn btn-info" onclick="FrmEditCliente({{$Client->IdCliente}})" data-toggle="collapse" href="#CrearMarca">
                                    <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger" onclick="EliminarCliente({{$Client->IdCliente}})">
                                    <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            @elseif($Client->Estado == 0)
                                <td class="text-center">Inactivo</td>
                                <td class="text-center">    
                                    <button class="btn btn-info" onclick="HabilitarCliente({{$Client->IdCliente}})">
                                        Habilitar Cliente
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
     
    function FrmCrearCliente(){
       
            $.ajax({
                url: '/FrmCrearClientes',
                type:'POST',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response){
                    $("#BoyCardCliente").html(response)
                },
                error : function(error){
                    alert('No se Encontro la dirección');
                }
            });
  
    }
    function FrmEditCliente(IdCliente){
        $.ajax({
                url: '/FrmEditCliente',
                type:'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    IdCliente:IdCliente
                },
                success: function(response){
                    $("#BoyCardCliente").html(response)
                },
                error : function(error){
                    alert('No se Encontro la dirección');
                }
            });
    }
    function EliminarCliente(IdCliente){
        Swal.fire({
            title: 'Quieres eliminar este Cliente?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminarlo!'
        }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
        url: '/EliminarCliente',
        type: 'POST',
        data:{ IdCliente: IdCliente, "_token": "{{ csrf_token() }}"},
        success:function(response){
            if(response == 1){
                    Swal.fire(
                'Eliminado!',
                'El Cliente ha sido deshabilitado.',
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
function HabilitarCliente(IdCliente){
        Swal.fire({
            title: 'Quieres Habilitar este Cliente?',
            text: "No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Habilitar!'
        }).then((result) => {
    if (result.isConfirmed) {
        $.ajax({
        url: '/HabilitarCliente',
        type: 'POST',
        data:{ IdCliente: IdCliente, "_token": "{{ csrf_token() }}"},
        success:function(response){
            if(response == 1){
                    Swal.fire(
                'Habilitado!',
                'El Cliente ha sido Habilitar.',
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