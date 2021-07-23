<div class="row justify-content-center">
    <div class="col-md-3 form-group">
        <label class="text-white">Usuario</label>
        <input type="text" class="form-control text-white" readonly value="{{$Venta->User->Nombres}}">
    </div>
    <div class="col-md-3 form-group">
        <label class="text-white">Cliente</label>
        @php 
        $NombreCompletoCliente;
        @endphp
        <input type="text" class="form-control text-white" readonly value="{{$Venta->Clientes[0]->Nombres}} {{$Venta->Clientes[0]->Apellidos}}">
    </div>
    <div class="col-md-3 form-group">
    <label class="text-white">Nit</label>
        <input type="text" class="form-control text-white" readonly value="{{$Venta->Clientes[0]->NIT}}">
    </div>
    <div class="col-md-3 form-group">
    <label class="text-white">Fecha Venta</label>
        <input type="text" class="form-control text-white" readonly value="{{$Venta->FechaVenta}}">
    </div>
</div>
<table class="table table-hover table-dark">
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
        @foreach($DetalleVenta as $Detalle)
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
                <strong >Q.{{$Venta->TotalPagar}}</strong>           
            </td>
        </tr>
        <tr >
            <td colspan="4" class="text-right">
                <strong>Efectivo</strong>
            </td>
            <td colspan="1" class="text-lefth">
                <strong >Q.{{$Venta->Efectivo}}</strong>           
            </td>
        </tr>
        <tr>
            <td colspan="4" class="text-right border-button border-danger">
                <strong>Cambio</strong>
            </td>
            <td colspan="1" class="text-lefth border-button border-danger">
                <strong >Q.{{$Venta->Cambio}}</strong>           
            </td>
        </tr>
    </tbody>
</table>