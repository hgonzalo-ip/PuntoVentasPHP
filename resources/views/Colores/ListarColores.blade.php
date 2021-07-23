@extends('layouts.app', ['page' => __('Colores'), 'pageSlug' => 'Colores'])

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
                        <h2 class="card-title">Colores</h2>
                    </div>
                    <div class="col-4 text-right">
                        <a onclick="FrmCreateColores()"  class="card-link text-dark" data-toggle="collapse" href="#CrearColor">
                    <button class="btn btn-info mt-3">
                    <i class="fas fa-plus"></i>
                    </button>
                    </a>
               </div>
       
            </div>
            
           
        </div>
        <div  id="CrearColor" class="collapse" data-parent="#accordion">  
            <div class="card-body all-icons" id="Body_CreateColor">

            </div>
            </div><!--Find del div collapse-->
            <div class="card-header ">
            @if(sizeof($Colores) <=0 )
                 <center><h2 class="text-danger">No hay Ningun Dato</h2></center>
            @elseif(sizeof($Colores) >= 1)
                <table class="table table-hover">
                <thead>
                        <tr>
                        <th class="text-center">#</th>
                            <th class="text-center">Nombre</th>                            
                            <th class="text-center">Acciones</th>
                        </tr>
                 </thead>
                 
               
               
                
                
                 <tbody>
                 @foreach($Colores as $Color)

<tr>
    <td class="text-center">{{$Color->IdColor}}</td>
    <td class="text-center">{{$Color->Descripcion}}</td>
    
    
    @if($Color->Estado == 1)
    <td class="text-center">
    <a onclick="FrmModificarColores({{$Color->IdColor}})" class="card-link text-dark" data-toggle="collapse" data-target="#CrearColor">
        <button type="button" rel="tooltip" class="btn btn-primary btn-lg btn-round btn-icon">
            <i class="tim-icons icon-settings"></i>
        </button>
       </a>
        <button onclick="EliminarColor({{$Color->IdColor}})" type="button" rel="tooltip" class="btn btn-danger btn-lg btn-round btn-icon">
            <i class="tim-icons icon-simple-remove"></i>
        </button>
    </td>
    @elseif($Color->Estado == 0)
    <td class="text-center">
    
    <button onclick="HabilitarColor({{$Color->IdColor}})" type="button" rel="tooltip" class="btn btn-success text-dark">
            Habilitar Color.
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
            function FrmCreateColores(){
                $.ajax({
                    url: '/FrmCrearColor',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    
                    },
                    success: function(response){
                        
                        $("#Body_CreateColor").html(response)
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
            }
            function FrmModificarColores(IdColor){
                $.ajax({
                    url: '/FrmModificarColor',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        IdColor : IdColor
                    
                    },
                    success: function(response){
                        
                        $("#Body_CreateColor").html(response)
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
            }
            function EliminarColor(IdColor){
                Swal.fire({
                        title: 'Quieres eliminar este Color?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminarlo!'
                    }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/EliminarColor',
                    type: 'POST',
                    data:{ IdColor: IdColor, "_token": "{{ csrf_token() }}"},
                    success:function(response){
                        if(response == 1){
                                Swal.fire(
                            'Eliminado!',
                            'El Color ha sido deshabilitado.',
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
            function HabilitarColor(IdColor){
                Swal.fire({
                        title: 'Quieres Habilitar esta Color?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Habilitar!'
                    }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    url: '/HabilitarColor',
                    type: 'POST',
                    data:{ IdColor: IdColor, "_token": "{{ csrf_token() }}"},
                    success:function(response){
                        if(response == 1){
                                Swal.fire(
                            'Habilitar!',
                            'El Color ha sido Habilitado.',
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