<table class="table table-dark table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Imei</th>
        </tr>
    </thead>
    <tbody>
        @php 
            $Contador = 1;
        @endphp
        @foreach($Imei as $ListadoImeis)
            <tr>
                <td>{{$Contador++}}</td>
                <td>{{$ListadoImeis->Imei}}</td>
                <td>
                    @if($ListadoImeis->Estado == 5)
                    Vendido
                    @elseif($ListadoImeis->Estado == 3)
                    Disponible
                    @endif


                </td>
            </tr>
        @endforeach
    </tbody>
</table>