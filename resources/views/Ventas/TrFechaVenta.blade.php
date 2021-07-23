@if(sizeof($Ventas) <= 0)
    
     <tr>
        <td colspan="11"> <center><h3 class="text-danger">No hay Ventas...</h3></center></td>
     </tr>
    
@elseif(sizeof($Ventas) >= 1)
    @php 
    $Contador = 1;
    @endphp
    @foreach($Ventas as $ListadoVentas)
        <tr>
            <td>{{$Contador++}}</td>
            <td>{{$ListadoVentas->FechaVenta}}</td>
            <td>{{$ListadoVentas->user->Nombres}} {{$ListadoVentas->user->Apellidos}}</td>
            <td>{{$ListadoVentas->Clientes[0]->Nombres}} {{$ListadoVentas->Clientes[0]->Apellidos}}</td>
            <td><strong>{{$ListadoVentas->Efectivo}}</strong></td>
            <td><strong>{{$ListadoVentas->Cambio}}</strong></td>
            <td><strong>{{$ListadoVentas->TotalPagar}}</strong></td>
            <td>
            <a href="">
            <button  class="btn btn-info btn-sm">
                Imprimir
            </button>
            </a> 
        
            <button onclick="VerDetalleVentas({{$ListadoVentas->IdVenta}})" class="btn btn-warning btn-sm">
                Ver Detalles
            </button>
            <button onclick="VerImeisVendidos({{$ListadoVentas->DetalleVenta[0]->IdProducto}})" class="btn btn-success btn-sm text-center mt-2">
                                    Ver Imeis
             </button>
            </td>
        </tr>
    @endforeach
@endif