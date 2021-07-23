@extends('layouts.app', ['page' => __('User'), 'pageSlug' => 'User'])

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
                        <h2 class="card-title">Usuarios</h2>
                    </div>
                    <div class="col-4 text-right">
                        <a onclick="FrmCrearUser()"  class="card-link text-dark" data-toggle="collapse" href="#CrearProducto">
                    <button class="btn btn-info mt-3">
                    <i class="fas fa-plus"></i>
                    </button>
                    </a>
               </div>
       
            </div>
            
           
        </div>
        <div  id="CrearProducto" class="collapse" data-parent="#accordion">  
            <div class="card-body all-icons" id="Body_CreateUser">

            </div>
            </div><!--Find del div collapse-->
            <div class="card-header ">
                <table class="table table-hover">
                <thead>
                        <tr>
                        <th class="text-center">#</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th class="text-center"><h5>Puesto</h5></th>
                            
                            <th class="text-center">Actions</th>
                        </tr>
                 </thead>
                 <tbody>
                    
                        @foreach($User as $USER)
                        @if($USER->EstadoU == 1)
                            <tr>
                            <td>{{$USER->IdUsuario}}</td>
                            <td>{{$USER->Nombres}}{{$USER->Apellidos}}</td>
                            <td>{{$USER->email}}</td>
                            <td>{{$USER->Descripcion}}</td>
                           
                          
                           
                            <td class="td-actions text-center">
                                <button onclick="VerInfoUser({{$USER->IdUsuario}})" type="button" rel="tooltip" class="btn btn-info btn-lg btn-round btn-icon">
                                    <i class="tim-icons icon-single-02"></i>
                                </button>
                                <a onclick="FrmModifarUser({{$USER->IdUsuario}})"  class="card-link text-dark" data-toggle="collapse" href="#CrearProducto">
                                <button type="button" rel="tooltip" class="btn btn-success btn-lg btn-round btn-icon">
                                    <i class="tim-icons icon-settings"></i>
                                </button>
                               </a>
                                <button onclick="DeleteUser({{$USER->IdUsuario}})" type="button" rel="tooltip" class="btn btn-danger btn-lg btn-round btn-icon">
                                    <i class="tim-icons icon-simple-remove"></i>
                                </button>
                            </td>
                            @elseif($USER->EstadoU == 0)
                            <td class="border border-danger">{{$USER->IdUsuario}}</td>
                            <td class="border border-danger">{{$USER->Nombres}}{{$USER->Apellidos}}</td>
                            <td class="border border-danger">{{$USER->email}}</td>
                            <td class="border border-danger">{{$USER->Descripcion}}</td>
                            <td class="td-actions text-center border border-danger">
                            
                            <button onclick="VerInfoUser({{$USER->IdUsuario}})" type="button" rel="tooltip" class="btn btn-info btn-lg btn-round btn-icon">
                                    <i class="tim-icons icon-single-02"></i>
                                </button>
                            
                            <button onclick="HabilitarUser({{$USER->IdUsuario}})" type="button" rel="tooltip" class="btn btn-success text-dark">
                                    Habilitar Usuario.
                                </button>
                            </td>
                            @endif
                        </tr>
                         
                        @endforeach
                    
                 </tbody>
                </table>
            </div>
        </div>
        

    </div><!--Fin del Card-->
    <!---Modal Ver Información-->
    <div class="modal" id="MyModalInfoUser">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h2 class="modal-title">Información</h2>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body" id="Body_Infomation">
        
      </div>

     

    </div>
  </div>
</div>
    <!--- FIN Modal Ver Información-->




@endsection
<script>
    function FrmCrearUser(){
        $.ajax({
            url: '/FrmCreateUser',
            type:'POST',
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response){
                $("#Body_CreateUser").html(response)
            },
            error : function(error){
                alert('No se Encontro la dirección');
            }
        });
    }
    function FrmModifarUser(IdUser){
        $.ajax({
            url: '/FrmModificarUser',
            type:'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                IdUser: IdUser
            },
            success: function(response){
                $("#Body_CreateUser").html(response)
            },
            error : function(error){
                alert('No se Encontro la dirección');
            }
        });
    }
    function VerInfoUser(IdUser){
        $.ajax({
            url : '/InfoUser',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                IdUser: IdUser
            },
            success : function(response){
                $("#MyModalInfoUser").modal('show');
                $("#Body_Infomation").html(response);
            },
            error: function(error){
                alert('No se encotro la dirección');
            }
        })
    }
    function DeleteUser(IdUser){
      Swal.fire({
        title: 'Quieres eliminar este Usuario?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminarlo!'
      }).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: '/DeleteUser',
      type: 'POST',
      data:{ IdUser: IdUser, "_token": "{{ csrf_token() }}"},
      success:function(response){
        if(response == 1){
                Swal.fire(
            'Eliminado!',
            'El Usuario ha sido deshabilitado.',
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
    function HabilitarUser(IdUser){
        Swal.fire({
        title: 'Habilitar?',
        text: "Quires Habilitar esta Uusario?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Habilitarlo!'
      }).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: '/HabilitarUser',
      type: 'POST',
      data:{ IdUser: IdUser, "_token": "{{ csrf_token() }}"},
      success:function(response){
        if(response == 1){
                Swal.fire(
            'Habilitado!',
            'El Usuario ha sido Habilitado Correctamente.',
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