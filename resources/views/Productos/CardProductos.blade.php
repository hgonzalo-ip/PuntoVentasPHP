<div class="col-md-12"><br><br><br>

@if(sizeof($ProductosL) == 0)
<center><p>No hay ningun producto creado</p></center>
@endif

@foreach($ProductosL as $Producto)

  <div class="card" style="margin: 18px ;  width: 18rem; display: inline-block; background-color: #004d73; border-radius: 1em; box-shadow: 5px 5px 25px #6534ac;">
         <div class="card-header" onclick="VerDetalleProducto({{$Producto->IdProducto}})">
        
        @if($Producto->Foto == "")
         <img style="width: 230px; height:100px;" src="storage/Img/SinImg.jpg" >
         @else
        <center>
        <img  src="{{ route('VerImagen', ['NombreImagen' => $Producto->Foto]) }}" >
        </center>
         @endif
        
         </div>
        <div class="card-body">
            <div class="justify-content-center">
            <div class="row">
                <div class="col-sm-8 ">
                <h4 class="card-title ml-2">{{$Producto->NombreProductos}}</h4>
                </div>
                <div class="col-sm-1">

                    <div class="dropdown">
                        @if($Producto->Estado == 1)
                        <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown">
                           
                           </button>
                  
                       
                        @endif
                        <div class="dropdown-menu">
                            <a class="dropdown-item text-dark" onclick="MdEditDatos({{$Producto->IdProducto}})">Editar</a>
                            <a class="dropdown-item text-dark" onclick="EliminarProducto({{$Producto->IdProducto}})">Eliminar</a>
                            <a class="dropdown-item text-dark" onclick="MdAgregarImg({{$Producto->IdProducto}})">Agregar Foto</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-star">
               <ul>
               @if($Producto->Estado == 1)
               <li>  <p class="card-text ml-2">Precio Venta:  <b>Q.{{$Producto->PrecioVenta}}</b></p></li>
                @if($Producto->Stok == 0)
                <li><p class="card-text ml-2">No hay Productos</b></p></li>
                @elseif($Producto->Stok > 0)  
               <li> <p class="card-text ml-2">Stok: <strong>{{$Producto->Stok}}</strong></p></li>
                @endif
               @else
               <li> <p class="card-text ml-2 text-danger"><strong>Producto Desactivado</strong></p></li>
               <li> <p class="card-text ml-2 text-danger">Descripción: {{$Producto->Descripcion}}</b></p></li>

               @endif
               </ul>
            </div>
           
            <div class="row justify-content-center">
               @if($Producto->Estado == 0)

               <button onclick="HabilitarProducto({{$Producto->IdProducto}})" class="btn btn-warning">
               Abilitar Producto
               </button>
               @else
               
               @endif
            </div>
            </div>
       
    </div>
</div><!--Div del car-->
    @endforeach
</div>

<!--- MODALES -->
<!--------------------------Modal Editar Productos--------------------->
  <!-- The Modal -->
  <div class="modal fade" id="MdProductosEdit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content bg-dark">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="text-with">Modificar Datos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div class="row justify-content-center" id="BodyProductosEdit">
           
         </div>
        </div>
      
        
      </div>
    </div>
  </div>
<!--------------------------FIN de Modal Editar Productos--------------------->
<!--------------------------Modal Agregar Foto--------------------->
  <!-- The Modal -->
  <div class="modal fade" id="MdProductos">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Agregar Fotos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         <div class="row justify-content-center" id="Md_Body">
           
         </div>
        </div>
      
          <div class="row justify-content-center">
              <div class="col-md-3 form-group">
                <button  class=" btn btn-info" style="display: none;" id="BtnGuardarImg" onclick="GuardarImagen()">
                    Guardar Fotos
                </button>
              </div>
          </div>
      </div>
    </div>
  </div>
<!--------------------------FIN de Modal Agregar Foto--------------------->




<script>
    function MdAgregarImg(IdProducto){
      var Token = "{{ csrf_token() }}";
       $.ajax({
        url: 'FrmAgregarFoto',
        type: 'POST',
        data:{ IdProducto: IdProducto, "_token": "{{ csrf_token() }}"},
        success: function (response){
            $("#MdProductos").modal('show');
            $("#Md_Body").html(response);
            
        },
        error: function(){
            
        }
       });
    }
    function GuardarImagen(){
      var Formulario = document.getElementById('Frm_AggImagen');
        var Foto = new FormData(Formulario);
        var Token = '{{ csrf_token() }}';
        $.ajax({
          url : '/GuardarImagen',
          type :'POST',
          data : Foto,
          contentType : false,
          cache : false,
          processData : false,
          success:function(response){
            if(response == 1){
              Swal.fire(
                'Imagen',
                'Imagen Guardada con exito',
                'success'
                ).then((result) => {
                    if(result.isConfirmed){
                        location.reload();
                    }
                });
            }
          },
          error : function(error){
           alert('Ocuarrio un errro');
          }
        });
   
      
    }
    function MostrarBtn(){
        $("#BtnGuardarImg").show();
    }
    function MdEditDatos(IdProducto){
      var Token = "{{ csrf_token() }}";
       $.ajax({
        url: 'FrmProductosEdit',
        type: 'POST',
        data:{ IdProducto: IdProducto, "_token": "{{ csrf_token() }}"},
        success: function (response){
            $("#MdProductosEdit").modal('show');
            $("#BodyProductosEdit").html(response);
            
        },
        error: function(){
            
        }
       });
    }
    function EliminarProducto(IdProducto){
      Swal.fire({
        title: 'Quieres eliminar este Producto?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Eliminarlo!'
      }).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: '/EliminarProd',
      type: 'POST',
      data:{ IdProducto: IdProducto, "_token": "{{ csrf_token() }}"},
      success:function(response){
        if(response == 1){
                Swal.fire(
            'Eliminado!',
            'Tu Producto ha sido eliminado.',
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

 
    function HabilitarProducto(IdProducto){
      Swal.fire({
        title: 'Quieres Habilitar este Producto?',
        text: "..",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, Habilitarlo!'
      }).then((result) => {
  if (result.isConfirmed) {
    $.ajax({
      url: '/HabilitarProd',
      type: 'POST',
      data:{ IdProducto: IdProducto, "_token": "{{ csrf_token() }}"},
      success:function(response){
        if(response == 1){
                Swal.fire(
            'Habilitado!',
            'Tu Producto ha sido Habilitado.',
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

    function VerDetalleProducto(IdProducto){
     $.ajax({
        url: 'VerDetalleProducto',
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            IdProducto: IdProducto
        },
        success : function(response){
            $("#MdSeleccionarImeis").modal('show');
            $("#MdBodyAgregarImeis").html(response);
        },
        error : function (error){
            alert('No se encotnro la direccion');
        }
     });
    }
</script>