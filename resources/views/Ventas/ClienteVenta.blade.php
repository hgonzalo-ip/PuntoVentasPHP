@php
$Fecha = date("Y-m-d");

@endphp
<div class="col-md-3">
    <label>Fecha De la Venta</label>
   <input class="form-control" style="color:white ;" type="date" value="{{$Fecha}}" readonly>
</div>
<div class="col-md-3 form-group">
    <label>Nombre</label>
    <input type="hidden" name="Txt_IdCliente" id="Txt_IdCliente" value="{{$Cliente->IdCliente}}">
    <input type="text" class="form-control text-white" name="Txt_Nombre"  id=Txt_Nombre" disabled value="{{$Cliente->Nombres}}">
</div>
<div class="col-md-3 form-group">
    <label>Apellido</label>
    <input type="text" class="form-control text-white" name="Txt_Apellido"  id=Txt_Apellido" disabled value="{{$Cliente->Apellidos}}">
</div>
<div class="col-md-3 form-group">
    <label>Nit</label>
    <input type="text" class="form-control text-white" name="Txt_NIT"  id=Txt_NIT" disabled value="{{$Cliente->NIT}}">
</div>