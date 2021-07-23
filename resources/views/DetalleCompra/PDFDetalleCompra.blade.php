
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Detalle Compra</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<style>
    #ContendorTitulo{
        border-bottom: dashed black 4px;
    }
    #ContenedorProv{
        border-bottom: dashed  black 4px;
    }
    #DetalleCompra{
        border-bottom: dashed  black 4px;
    }
</style>
<body>
    <div class="container">
       
      
       <div id="ContendorTitulo" >
            <h1 class="text-primary text-center">  {{$Compra->User->Sucursales->Nombre}}</h1>  
            <h5 id="Direccion" class="text-dark text-center">{{$Compra->User->Sucursales->Direccion}}</h5>                       
            <h5 id="Direccion" class="text-dark text-center">{{$Compra->User->Sucursales->Telefono}}</h5>                       
       </div>
       <br>
       <div id="ContenedorProv">
            <h5 class="text-dark">Nombre Proveedor: <strong>{{$Compra->DetalleCompra[0]->Productos->Proveedor->Nombre}}</strong></h5>
            <h5 class="text-dark">Dirección: <strong>{{$Compra->DetalleCompra[0]->Productos->Proveedor->Direccion}}</strong></h5>
            <h5 class="text-dark">Telefono: <strong>{{$Compra->DetalleCompra[0]->Productos->Proveedor->Telefono}}</strong></h5>
            <h5 class="text-dark">NIT: <strong>{{$Compra->DetalleCompra[0]->Productos->Proveedor->Nit}}</strong></h5>
       </div> 
        <br>   
        <div id="DetalleCompra">
        <h5 class="text-dark text-center">Fecha Compra: <strong>{{$Compra->FechaCompra}}</strong></h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Cantidad</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>SubTotal</th>
                        
                    </tr>
                </thead>
                <tbody>
                @php 
                     $Contador = 1;
                   
              
                        
                        @endphp
                   @foreach($Compra->DetalleCompra as $Detalle)
                        <tr>
                            <td>{{$Contador++}}</td>
                            <td>{{$Detalle->Productos->NombreProductos}}</td>
                            <td>{{$Detalle->CantidadUnidad}}</td>
                            <td>{{$Detalle->Productos->PrecioCompra}}</td>
                            <td>{{$Detalle->Productos->PrecioVenta}}</td>
                            <td>{{$Detalle->SubTotal}}</td>
                           <td></td>
                        </tr>
                       
                    @endforeach
                   
                    <tr>
                        <td colspan="5" class="text-right"><strong>Total</strong></td>
                        <td colspan="1" class="text-lefth">
                        <strong>{{$Compra->Total}}</strong>
                       </td>
                    </tr>
                </tbody>
            
            </table>
         
        </div>  
      
        
    </div>
</body>

</html>