<form class="was-validated" action="{{ route('CrearCliente') }}" method="POST">
@csrf
    <div class="row justify-content-center">
  
      
        <div class="col-xl-3 col-md-4 col-sm-3 form-group"> 
            <label for="Nombre">Nombre</label>
            <input type="text" class="form-control" name="Txt_Nombre" id="Txt_Nombre" required>
            <div class="valid-feedback">Muy bien</div>
            <div class="invalid-feedback">Rellenar este campo.</div>
            
        </div>
        <div class="col-xl-3 col-md-4 col-sm-3  form-group">
            <label for="Apellido">Apellido</label>
            <input type="text" class="form-control" name="Txt_Apellido" required> 
            <div class="valid-feedback">Muy bien</div>
            <div class="invalid-feedback">Rellenar este campo.</div>
        </div>
        <div class="custom-control col-xl-3 col-md-4 col-sm-3 "> 
            <label for="NIT">NIT</label>
          
            <input onkeyup="MostrarConfir(this.value)" maxlength="9" type="text" class=" form-control" name="Txt_NIT" id="Txt_NIT"  required> 
            <div class="valid-feedback" style="display: none;" id="MuyBien">Muy bien</div>
            <div class="invalid-feedback" id="MuyMal">Rellenar este campo con 9 digitos.</div>
            @include('alerts.feedback', ['field' => 'password'])
        </div>
       
    </div>
 
    <div class="row justify-content-center d-none" id="DvBtn" >
        <div class="col-xl-3 col-md-6 col-sm-12 form-group">
            <button class="btn btn-block" type="submit" class="form-control">
                Crear Cliente
            </button>
        </div>
    </div>
</form>
<script>


    function MostrarConfir(Text){
        var Cantidad = Text.length;
        if(Cantidad >= 9){
           
            $("#MuyBien").show();
            $("#DvBtn").removeClass('d-none');
            $("#MuyMal").hide();
            
        }else if(Cantidad < 9){
            $("#MuyMal").show();
            $("#MuyBien").hide();
            $("#DvBtn").addClass('d-none');
        }
       
    }
</script>