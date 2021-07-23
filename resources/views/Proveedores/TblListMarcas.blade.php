@inject('Funciones', 'App\Http\Controllers\Funciones')
<table class="table table-striped" >
    <thead>
        <tr>
            <td class="text-white">#</td>
            <td class="text-white text-center">Nombre</td>
            <td class="text-white text-center">Estado</td>
            <td ></td>
            <td class="text-white text-center">Acciones</td>
        </tr>
    </thead>
    <tbody>
        @foreach($Marca as $marca)
        @php
            $EstadoDetalleMarca='';
        @endphp
        <tr>
           
            <td>{{$marca->IdMarca}}</td>
            <td class="text-center">{{$marca->Descripcion}}</td>
            @php
                $EstadoDetalleMarca = $Funciones::EstadoDetalleMarca($marca->IdMarca, $Proveedor);
            @endphp
            @if($EstadoDetalleMarca == 0)
            <td class="text-center text-success">No Mia</td>
            <td><!--<input type="checkbox" class="form-control">--></td>
            <td class="td-actions text-center">
            <button onclick="AgregarDetalleMarcaBd({{$marca->IdMarca}} , {{$Proveedor}})" type="button" rel="tooltip" class="btn btn-info btn-lg btn-icon">
            <i class="fas fa-plus"></i>
                </button>   
            </td>
           
           
            @elseif($EstadoDetalleMarca == 1)
            <td class="text-center text-success"> mia</td>
            <td></td>
            <td class="td-actions text-center">
            <button onclick="QuitarDetalleMarcaBd({{$marca->IdMarca}} , {{$Proveedor}})" type="button" rel="tooltip" class="btn btn-info btn-lg btn-icon">
            <i class="fas fa-minus"></i>
                </button>   
            </td>
        
            @endif
            
        </tr>
        @endforeach
    </tbody>
</table>
<script>

    function AgregarDetalleMarcaBd(IdMarca, IdProveedor){
        $.ajax({
                    url: '/AgregarDetalleMarca',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        IdMarca: IdMarca,
                        IdProveedor: IdProveedor
                    },
                    success: function(response){
                        if(response == 1){
                            Swal.fire({
                            icon: 'success',
                            text: 'Marca Agregada!', 
                            })
                        }
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
    }
    function QuitarDetalleMarcaBd(IdMarca, IdProveedor){
        $.ajax({
                    url: '/QuitarDetalleMarca',
                    type:'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        IdMarca: IdMarca,
                        IdProveedor: IdProveedor
                    },
                    success: function(response){
                        if(response == 1){
                            Swal.fire({
                            icon: 'success',
                            text: 'Marca Quitada!', 
                            })
                        }
                    },
                    error : function(error){
                        alert('No se Encontro la dirección');
                    }
                });
    }
</script>