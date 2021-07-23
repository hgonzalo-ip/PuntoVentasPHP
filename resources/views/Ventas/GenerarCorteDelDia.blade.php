@extends('layouts.app', ['page' => __('CorteDia'), 'pageSlug' => 'CorteDia'])

@section('content')
                @if (session('Message'))
                        <div class="row justify-content-center form-group alert alert-success">
                            <div class="col-md-6">
                                <h5>{{ session('Message') }}</h5>
                            </div>
                        </div>
                    @endif
	<div class="card" id="CardCompras">
        <div class="card-header" >
            <h3 class="title">Generar Corte</h3>
             <p class="category">Seleccione una sucursal para generar corte</p>
        
         
        </div>
        <div class="card-body all-icons">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <label>Sucursales</label>
                        <select name="IdSucursal" id="IdSucursal" onchange="VerBtnGenerarCorte()"  id="IdSucursal" class="form-control bg-dark">
                            <option selected disabled>Elige una sucursal</option>
                            @foreach($Sucursales as $Listado)
                                <option value="{{$Listado->IdSucursal}}">{{$Listado->Nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mt-3" id="RowBtnGenerarCorte" style="display:none;">
                        <button class="btn btn-info" onclick="GenerarCorteDia()" >
                            Generar Corte
                        </button>
                    </div>
                </div><br><br>
                <div class="row justify-content-center">
                    <div class="col-md-11" id="DivMostrarCorte">
                      
                    </div>
                </div>                

        </div>
    </div>
@endsection

<script>
    function VerBtnGenerarCorte(){
        $("#RowBtnGenerarCorte").show();
    }
    function GenerarCorteDia(){
        var IdSucursal = $("#IdSucursal").val();
        $.ajax({
            url: '/CorteDia',
            type: 'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                IdSucursal : IdSucursal
            },
            success:function(response){
                $("#DivMostrarCorte").html(response);
            },  
            error:function(erro){
                alert('No se encontro la direccion');
            }
        })
    }
</script>
