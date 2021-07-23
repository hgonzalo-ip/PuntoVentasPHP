<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Venta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
    #ContendorTitulo{
        border-bottom: dashed black 2.5px;
    }
    #ContenedorProv{
        border-bottom: dashed  black 2.5px;
    }
    #DetalleCompra{
        border-bottom: dashed  black 2.5px;
    }
</style>
</head>
<body>
   <div class="container">
        <div id="ContendorTitulo" >
            <h1 class="text-primary text-center">  {{$Ventas->User->Sucursales->Nombre}}.</h1>  
            <h5 id="Direccion" class="text-dark text-center">{{$Ventas->User->Sucursales->Direccion}}.</h5>                       
            <h5 id="Direccion" class="text-dark text-center">{{$Ventas->User->Sucursales->Telefono}}.</h5>                       
       </div><br>
       <div id="ContenedorProv">
            <label>Datos Cliente</label>
            <h5 class="text-dark ml-5">Nombre: <strong>{{$Ventas->Clientes[0]->Nombres}}.</strong></h5>
            <h5 class="text-dark ml-5">Apellidos: <strong>{{$Ventas->Clientes[0]->Apellidos}}.</strong></h5>
            <h5 class="text-dark ml-5">NIT: <strong>{{$Ventas->Clientes[0]->NIT}}.</strong></h5>
            <label>Datos Vendedor</label>
            <h5 class="text-dark ml-5">Atendio: <strong>{{$Ventas->User->Nombres}} {{$Ventas->User->Apellidos}}.</strong></h5>
            <h5 class="text-dark ml-5">Fecha Venta: <strong>{{$Ventas->FechaVenta}}</strong></h5>
       </div> 
       <br>
       <div id="DetalleCompra">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Precio Venta</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                @php 
                     $Contador = 1;
                   
              
                        
                        @endphp
                   @foreach($Ventas->DetalleVenta as $Detalle)
                    <tr>
                        <td>{{$Contador++}}</td>
                        <td>{{$Detalle->Productos->NombreProductos}}</td>
                        <td>{{$Detalle->Productos->PrecioVenta}}</td>
                        <td><strong>{{$Detalle->CanitadUnidad}}</strong></td>
                        <td><strong>{{$Detalle->SubTotal}}</strong></td>
                    </tr>  
                       
                    @endforeach
                    <tr class="mt-2" >
            <td colspan="4" class="text-right">                
                <strong>Total</strong>
            </td>
            <td colspan="1" class="text-lefth">
                <strong >Q.{{$Ventas->TotalPagar}}</strong>           
            </td>
        </tr>
        <tr >
            <td colspan="4" class="text-right">
                <strong>Efectivo</strong>
            </td>
            <td colspan="1" class="text-lefth">
                <strong >Q.{{$Ventas->Efectivo}}</strong>           
            </td>
        </tr>
        <tr>
            <td colspan="4" class="text-right" style="border-top: solid 1px black;">
                <strong>Cambio</strong>
            </td>
            <td colspan="1" class="text-lefth " style="border-top: solid 1px black;">
                <strong >Q.{{$Ventas->Cambio}}</strong>           
            </td>
        </tr>
                </tbody>
            
            </table>
         
        </div>  
   </div>
</body>
</html>