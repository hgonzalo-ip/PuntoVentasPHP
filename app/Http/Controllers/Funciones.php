<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetalleMarca;
class Funciones extends Controller
{
    public static function EstadoDetalleMarca($IdMarca, $IdProveedor){

        $DetalleMarca = DetalleMarca::where('IdMarca', '=',$IdMarca)->where('IdProveedor','=',$IdProveedor)->where('Estado','=',1)->count();
        return $DetalleMarca;
    
    }

    public static function NumeroMarcas($IdProveedor){
        $NumDetalleMarca = DetalleMarca::where('IdProveedor','=',$IdProveedor)
                                        ->where('Estado','=', 1)->count();
        return $NumDetalleMarca;
    }


}
