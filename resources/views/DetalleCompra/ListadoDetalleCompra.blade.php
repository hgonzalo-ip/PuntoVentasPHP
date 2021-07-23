<div class="row justify-content-center">
    <div class="col-md-3 form-group">
        <label class="text-white">Proveedor</label>
        <input type="text" class="form-control text-white" disabled value="{{$Compra->DetalleCompra[0]->Productos->Proveedor->Nombre}}">
    </div>
    <div class="col-md-3 form-group">
        <label class="text-white">Direccion</label>
        <input type="text" class="form-control text-white" disabled value="{{$Compra->DetalleCompra[0]->Productos->Proveedor->Direccion}}">
    </div>
    <div class="col-md-3 form-group">
    <label class="text-white">Telefono</label>
        <input type="text" class="form-control text-white" disabled value="{{$Compra->DetalleCompra[0]->Productos->Proveedor->Telefono}}">
    </div>
</div>
<br>
<table class="table table-dark">
    <thead>
        <tr>
            <th>#</th>
            <th>Producto</th>
            <th>Toal Compra</th>
        </tr>        
    </thead>
    <tbody>
        @php 
        $Contador = 1;
        @endphp
      @foreach($DetalleCompra as $Detalle)
      <tr>
            <td>{{$Contador++}}</td>
            <td>{{$Detalle->Productos->NombreProductos}}</td>
            <td><strong>Q.{{$Detalle->SubTotal}}</strong></td>
        </tr>
      @endforeach
      
      <tr>
        <td colspan="2" class="text-right">
            <ins>
            <strong>Total</strong>
            </ins>
        </td>
        <td colspan="1" class="text-lefth">
            <ins>
                <strong>Q.{{$Detalle->Compra->Total}}</strong>
            </ins>
        </td>
    </tr>
    </tbody>
</table>