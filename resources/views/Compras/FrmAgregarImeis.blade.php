<form id="FrmAggImeis">
@csrf
    <div class="row justify-content-center" id="DvInputsBtn">
        <div class="col-md-8">
            <lable class="text-white">Imei</lable>
            <input type="hidden" name="Txt_IdProducto" value="{{$IdProducto}}">
            <input type="hidden" name="Cantidad" value="{{$Cantidad}}">
            <input onchange="AgregarImeiTabla({{$Cantidad}})" type="text" maxlength="15" class="form-control"  id="Txt_Imei">
        </div>
        <div class="col-md-2 form-group">
            <button onclick="AgregarImeiTabla({{$Cantidad}})" id="BtnAgregarMas" type="button" class="btn btn-info form-control mt-4">
            <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <br>
    <table class="table table-hover" style="width: 100%;">
        <thead>
           <tr>
           <th>#</th> 
            <th class="text-center">Imei</th>
            <th class="text-center">Acciones</th>
           </tr>
        </thead>
        <tbody id="BodyTabalImei">

        </tbody>
    </table>
</form>
<script>

    var Contador = 0;
    function AgregarImeiTabla(Cantidad){
      
        var Estilos = "background-color: #02394A; Color: white; text-align:center;   font-size:18px; padding:10px 1px 10px 5px;margin:0px auto;display:block;width:100%;border:none;border-bottom:1px solid #757575;";
        var ImeiInput = $("#Txt_Imei").val();
        
       if(Contador >= Cantidad){
      
            $("#DvInputsBtn").hide('slow');
            $("#CancelarImes").removeClass('d-none');
            $("#AguardarImesi").removeClass('d-none');
          

       }else if(Contador <= Cantidad){
            if(ImeiInput == ""){
                alert("Rellenar este campo porfavor");
                $("#Txt_Imei").focus();
            }else{
                Contador++;
                var Fila = "<tr id='filaImput"+Contador+"'>"+
                    "<td class='text-center'>"+ Contador +"</td>"+
                    "<td class='text-center'>"+"<input type='number' style='"+Estilos+"' id='Imeis"+Contador+"'  name='Txt_Imeis[]' readonly value="+ImeiInput+">"+"</td>"+
                   
                    "<td class='text-center'>"+"<input type='Button' onclick='EliminarFilaImei("+Contador+","+Cantidad+")'   class='btn btn-danger' value='Eliminar'>" +"</td>"+
                    +"</tr>"
                    $("#BodyTabalImei").append(Fila);  //Agrega una fila mas
                    $("#Txt_Imei").val(""); //Limpia el Input principal
                    var ImeisTabla = $("#Imeis"+Contador).val();//
                    $("#DvInputsBtn").show('slow');
                    $("#CancelarImes").removeClass('d-none');
                    $("#AguardarImesi").removeClass('d-none');
                    
                    
            }
    
       }
    }       
    function EliminarFilaImei(Contador,Cantidad){
              
        alert(Contador);
        $("#filaImput" + Contador).remove();
        Contador--;
        if(Contador <= Cantidad){
            $("#DvInputsBtn").show('slow');
            $("#CancelarImes").addClass('d-none');
            $("#AguardarImesi").addClass('d-none');
        }
        
    }
</script>