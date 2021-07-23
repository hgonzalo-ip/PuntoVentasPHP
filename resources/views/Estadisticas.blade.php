
@php
    $suma=0;
    $SumaVentas = 0;    
@endphp
<div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    <h5 class="card-category text-white">Compras</h5>
               
                 
                        @foreach($Compras as $Compra)
                        @php
                            $suma+=$Compra->Total;//sumanos los valores, ahora solo fata mostrar dicho valor
                        @endphp 

                        @endforeach
                        <h3 class="card-title p-1"><i class="tim-icons icon-bell-55 text-primary"></i>{{$suma}}</h3><br>
                </div>
               
                </div>
                <div class="card-body">
       
                    <!--<div class="chart-area">
                        <canvas id="chartLinePurple"></canvas>
                    </div>-->
                 
            </div>
        </div>
    
        <div class="col-lg-4">
            <div class="card card-chart">
                <div class="card-header">
                    
                    <h5 class="card-category text-white">Ventas</h5>
                    @foreach($Ventas as $Ventas)
                    @php
                        $SumaVentas+=$Ventas->TotalPagar;//sumanos los valores, ahora solo fata mostrar dicho valor
                    @endphp 
                @endforeach
                <h3 class="card-title"><i class="tim-icons icon-bell-55 text-primary"></i>{{$SumaVentas}}</h3>
                </div>
              
                <div class="card-body">
              
                   <!-- 
                    <div class="chart-area">
                        <canvas id="CountryChart"></canvas>
                    </div>
                    -->
                </div> 
            </div>
        </div>
      