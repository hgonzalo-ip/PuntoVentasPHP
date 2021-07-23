<div class="row justify-content-center">
    <div class="col-md-3">
        <label class="text-white">Nombre Producto</label>
        <h3>{{$Producto->NombreProductos}}</h3>
    </div>
    <div class="col-md-3">
        <label class="text-white">Precio</label>
        <h3>{{$Producto->PrecioVenta}}</h3>
    </div>
    <div class="col-md-3">
        <label class="text-white">Color</label>
        <h3>{{$Producto->Color->Descripcion}}</h3>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-10">
        <label class="text-white">Descripcion</label>
        <h3>{{$Producto->Descripcion}}</h3>
    </div>

</div>