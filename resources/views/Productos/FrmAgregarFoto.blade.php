<form id="Frm_AggImagen" enctype="multipart/form-data">
@csrf
    <div class="row justify-content-center">
        <div class="col-md-12 form-group bg-dark">
            <label><h4>Seleccionar Foto +</h4></label>
            <input onchange="MostrarBtn()" type="file" class="form-control" name="Fotos" id="Fotos" required>
            <input type="hidden" name="IdProducto" id="IdProducto"  value='{{$IdProducto}}'>
        </div>
    </div><br>
  
</form>
