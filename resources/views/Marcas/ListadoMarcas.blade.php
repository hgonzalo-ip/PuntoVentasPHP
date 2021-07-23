@extends('layouts.app', ['page' => __('Marcas'), 'pageSlug' => 'Marcas'])

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
                        <h2 class="card-title">Marcas</h2>
                    </div>
                    <div class="col-4 text-right">
                        <a onclick="FrmCreateMarcas()"  class="card-link text-dark" data-toggle="collapse" href="#CrearMarca">
                    <button class="btn btn-info mt-3">
                    <i class="fas fa-plus"></i>
                    </button>
                    </a>
               </div>
       
            </div>
            
           
        </div>
        <div  id="CrearMarca" class="collapse" data-parent="#accordion">  
            <div class="card-body all-icons" id="Body_CreateMarcas">

            </div>
        </div><!--Find del div collapse-->
            <div class="card-header ">
            @if(sizeof($Marcas) <=0 )
                 <center><h2 class="text-danger">No hay Ningun Dato</h2></center>
            @elseif(sizeof($Marcas) >= 1)
                <table class="table table-hover table-striped " id="Tabla">
                <thead>
                        <tr>
                        <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>                            
                            <th class="text-center">Acciones</th>
                        </tr>
                 </thead>
                 
               
               
                
                
                 <tbody>
                 @foreach($Marcas as $Marca)

<tr>
    <td class="text-center">{{$Marca->IdMarca}}</td>
    <td class="text-center">{{$Marca->Descripcion}}</td>
    
    
    @if($Marca->Estado == 1)
    <td class="text-center">
    <a onclick="FrmEditarMarcas({{$Marca->IdMarca}})" class="card-link text-dark" data-toggle="collapse" data-target="#CrearMarca">
        <button type="button" rel="tooltip" class="btn btn-primary btn-lg btn-round btn-icon">
            <i class="tim-icons icon-settings"></i>
        </button>
       </a>
        <button onclick="EliminarMarca({{$Marca->IdMarca}})" type="button" rel="tooltip" class="btn btn-danger btn-lg btn-round btn-icon">
            <i class="tim-icons icon-simple-remove"></i>
        </button>
    </td>
    @elseif($Marca->Estado == 0)
    <td class="text-center">
    
    <button onclick="HabilitarMarca({{$Marca->IdMarca}})" type="button" rel="tooltip" class="btn btn-success text-dark">
            Habilitar Marca.
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
            $(document).ready(function(){
                $("#Tabla").DataTable();
                
            });
            function FrmCreateMarcas(){
                $.ajax({
                    url: '/FrmCreateMarca',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    
                    },
                    success: function(response){
                        
                        $("#Body_CreateMarcas").html(response)
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
            }
            function FrmEditarMarcas(IdMarca){
                $.ajax({
                    url: '/FrmModificarMarca',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        IdMarca : IdMarca
                    },
                    success: function(response){
                        
                        $("#Body_CreateMarcas").html(response)
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
            }
            function EliminarMarca(IdMarca){
               Swal.fire({
                        title: 'Quieres eliminar esta Marca?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminarlo!'
                    }).then((result) => {
                if (result.isConfirmed) {
                
                    $.ajax({
                    url: '/EliminarMarca',
                    type: 'POST',
                    data:{ IdMarca: IdMarca, "_token": "{{ csrf_token() }}"},
                    success:function(response){
                        if(response == 1){
                                Swal.fire(
                            'Eliminado!',
                            'La Marca ha sido deshabilitado.',
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
                
                }*/
                })
            }
            function HabilitarMarca(IdMarca){
                Swal.fire({
                        title: 'Quieres Habilitar esta Marca?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Habilitar!'
                    }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/HabilitarMarca',
                    type: 'POST',
                    data:{ IdMarca: IdMarca, "_token": "{{ csrf_token() }}"},
                    success:function(response){
                        if(response == 1){
                                Swal.fire(
                            'Habilitar!',
                            'La Marca ha sido Habilitada.',
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
   