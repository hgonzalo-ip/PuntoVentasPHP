@extends('layouts.app', ['pageSlug' => 'dashboard'])

@section('content')
  <!--  <div class="row">
        <div class="col-12">
            <div class="card card-chart">
                <div class="card-header ">
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <h5 class="card-category">Total Shipments</h5>
                            <h2 class="card-title">Performance</h2>
                        </div>
                        <div class="col-sm-6">
                        
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="chartBig1"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
    <br>

    @if(auth()->user()->IdTipoUsuario == 1)

    
    <div class="row justify-content-center">
        <div class="col-lg-6 form-group">
            <select class="form-control" onchange="Estadisticas(this.value)">
                <option selected disabled class="bg-dark" >Elige una Sucursal</option>
                @foreach($Sucursales as $Listado)
                    <option value="{{$Listado->IdSucursal}}" class="bg-dark">{{$Listado->Nombre}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
    <br><br>
   
    <div class="row justify-content-center" id="Estadisticas">
      
    </div>
 
   
@endsection

@push('js')
    <script src="{{ asset('black') }}/js/plugins/chartjs.min.js"></script>
    <script>
      
        function Estadisticas(IdSucursal){
       
            $.ajax({
                url: 'Estadisticas',
                type: 'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    IdSucursal : IdSucursal
                },
                success: function(response){
                    $("#Estadisticas").html(response)
                },
                error: function (erroe){
                    alert('No se encontro la direccion');
                }
            })
        }
    </script>
@endpush
