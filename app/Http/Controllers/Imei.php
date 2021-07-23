<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imeis;
class Imei extends Controller
{
    public function VerImeisVendidos(Request $request){
        $IdProducto = $request->IdProducto;
        $Imei = Imeis::where('IdProducto','=',$IdProducto)
                        ->where('Estado','=',5)->get();
        return view('Imeis.TblImeiCompradosVendi',[
            'Imei' => $Imei
        ]);
    }
    public function VerImeisComprados(Request $request){
        $IdProducto = $request->IdProducto;
        $Imei = Imeis::where('IdProducto','=',$IdProducto)
                        ->where('Estado','=',3)->get();
        return view('Imeis.TblImeiCompradosVendi',[
            'Imei' => $Imei
        ]);
    }
    
}
