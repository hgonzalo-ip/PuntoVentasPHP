@if(sizeof($Ventas) == 0)
    <center><h3>No se ha realizado Ninguna Venta</h3></center>
@else

@php
    $Contador = 1;
    $SumaVentas = 0;    
@endphp
@foreach($Ventas as $Ventas)
    @php
     $SumaVentas+=$Ventas->TotalPagar;//sumanos los valores, ahora solo fata mostrar dicho valor
    @endphp 
@endforeach

<div class="card">
    <div class="card-body">
    <h3 class="card-title">Fecha Corte : <strong>{{$Ventas->FechaVenta}}</strong></h3>
    <h3 class="card-title">Q.{{$SumaVentas}}</h3>

    </div>
</div>               
@endif