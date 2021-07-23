@foreach($User as $U)
<div class="container">
    <div class="row justify-content-center">
    
      <div class="col-md-6">
        <h3 class="text-dark d-inline">- Nombres: </h3><h3 class="text-dark ml-2 d-inline">{{$U->Nombres}}.</h3><br><br>
        <h3 class="text-dark d-inline">- Apellidos: </h3><h3 class="text-dark ml-2 d-inline">{{$U->Apellidos}}.</h3><br><br>
        <h3 class="text-dark d-inline">- Telefono : </h3><h3 class="text-dark ml-2 d-inline">{{$U->Telefono}}.</h3><br><br>
        <h3 class="text-dark d-inline">- DPI: </h3><h3 class="text-dark ml-2 d-inline">{{$U->DPI}}.</h3><br><br>
        

      </div>
      <div class="col-md-6">
      <h3 class="text-dark d-inline">- Rol: </h3><h3 class="text-dark ml-2 d-inline">{{$U->Descripcion}}.</h3><br><br>
      <h3 class="text-dark d-inline">- Sucursal: </h3><h3 class="text-dark ml-2 d-inline">{{$U->Nombre}}.</h3><br><br>
      <h3 class="text-dark d-inline">- Estado: </h3><h3 class="text-dark ml-2 d-inline">
        @if($U->EstadoU == 1)
        Activo.
        @elseif($U->EstadoU == 0)
        Deshabilitado.
        @endif
      </h3><br><br>
      </div>

    </div>
</div>
@endforeach