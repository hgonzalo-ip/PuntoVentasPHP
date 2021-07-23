
    <div class="row justify-content-center" >
        <div class="col-xl-10 form-group" style="width:100%; height:200px; overflow: scroll;">
        <input class="form-control" id="myInput" type="text" placeholder="Buscar....">
        <div class="row justify-content-center">
                <div class="col-md-3 form-group">
                    <button class="btn btn-success d-none" id="BtnListo" onclick="CerrarModal()">
                        LISTO
                    </button>
                </div>
            </div>
            <table id="TblSeleccionarImei" class="table table-dark table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Imeis</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" id="Cantidad" value="{{$Cantidad}}">
                    @foreach($Imeis as $Imei)
                    <tr>
                        <input type="hidden" name="Txt_Imei" id="Txt_Imei" value="{{$Imei->IdImei}}">
                        <td class="text-center">{{$Imei->Imei}}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info" onclick="VenderImeis({{$Imei->IdImei}})">
                                Seleccionar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#TblSeleccionarImei tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
var Contador = 0;
function VenderImeis(IdImei){
    Contador ++;

    var Cantidad = $("#Cantidad").val();
    if(Contador > Cantidad){
        Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Ya no puedes seguir seleccionando mas campos!'
            })
           
    }else if(Contador <= Cantidad){
        $("#BtnListo").removeClass('d-none');
                $("#myInput").hide();
        $.ajax({
            url: '/VenderImeis',
            type: 'POST',
            data:{
            "_token": "{{ csrf_token() }}",
            IdImei : IdImei
            },
            suuccess:function(response){
                if(response == 1){
                    Swal.fire({
                        icon: 'success',
                        title: 'Exitoso...',
                        text: 'Imei Agregado Correctamente!'
                    })
                }
               
            },
            error:function(error){
                alert('No se encontro la direccion');
            }
        })
    }
 
}
function CerrarModal(){
    $("#MdSeleccionarImeis").modal('hide');
    $("#TxtCantidad").attr('readonly','readonly');
}
</script>