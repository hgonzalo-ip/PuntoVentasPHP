@if(sizeof($Compras) <= 0)
    
     <tr>
        <td colspan="11"> <center><h3 class="text-danger">No hay Compras...</h3></center></td>
     </tr>
    
@elseif(sizeof($Compras) >= 1)
@php
    $Contado= 1;
@endphp
    @foreach($Compras as $Compra)
    <tr>
        <td>{{$Contado++}}</td>
        <td>{{$Compra->FechaCompra}}</td>
        <td>{{$Compra->User->Nombres}} {{$Compra->User->Nombres}}</td>
     
        <td>{{$Compra->Total}}</td>
        <td>
        <a href="{{ route('PdfCompras', $Compra->IdCompra) }}">
            <button  class="btn btn-info btn-sm">
                Imprimir
            </button>
        </a>
            <button class="btn btn-warning btn-sm" onclick="VerDetalle({{$Compra->IdCompra}})">
                Ver Detalles
            </button>
            <button onclick="VerImeisComprados({{$Compra->DetalleCompra[0]->IdProducto}})" class="btn btn-success btn-sm text-center">
                                    Ver Imeis
                                </button>
        </td>
   
    </tr>
    @endforeach
    
@endif