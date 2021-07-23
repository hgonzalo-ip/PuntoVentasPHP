


@if(sizeof($ProductosL) == 0)
<center><p>No hay ningun producto creado</p></center>
@endif


@foreach($ProductosL as $Producto)
 
  <div class="card" " style="margin-left: 2%;  width: 22%;  display: inline-block; background-color: #004d73; border-radius: 1.5em; box-shadow: 5px 5px 25px #6534ac;">
         <div class="card-header " onclick="VerDetalleProducto({{$Producto->IdProducto}})">
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
                <div class="col-sm-12">
                <h4 class="card-title">{{$Producto->NombreProductos}}</h4>
                </div>
          
            </div>
            <div class="row justify-content-star">
               <ul>
   
               <li>  <p class="card-text ml-2">Precio Venta:  <b>Q.{{$Producto->PrecioVenta}}</b></p></li>
                @if($Producto->IdTipoProducto == 2)
                   <li></li>
                    @else
                    <li>  <p class="card-text ml-2">Color:  <b>{{$Producto->Color->Descripcion}}</b></p></li>
                    @endif
                @if($Producto->Stok == 0)
                <li> <p class="card-text ml-2">Stok:<b>0</b></p></li>
          
                @elseif($Producto->Stok > 0)  
               <li> <p class="card-text ml-2">Stok:<b>{{$Producto->Stok}}</b></p></li>
            
               
               

              
               </ul>
            </div>
           
            <div class="row justify-content-center">
      
                 @if($Producto->IdTipoProducto == 2)
                    @php
                    $Color = "No tiene color";
                    @endphp
                <button class="btn" onclick="AgregarFilaTabalVentasG({{$Producto->IdProducto}},'{{$Producto->NombreProductos}}', '{{$Color}}',{{$Producto->PrecioVenta}}, {{$Producto->IdTipoProducto}}, {{$Producto->Stok}})">Vender</button> 
                   @else
                <button class="btn" onclick="AgregarFilaTabalVentasG({{$Producto->IdProducto}},'{{$Producto->NombreProductos}}', '{{$Producto->Color->Descripcion}}',{{$Producto->PrecioVenta}}, {{$Producto->IdTipoProducto}},{{$Producto->Stok}})">Vender</button> 
                   @endif
                   @endif
            
            </div>
            </div>
       
        </div>
        </div><!--Div del car-->
 
    @endforeach

<script>
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

