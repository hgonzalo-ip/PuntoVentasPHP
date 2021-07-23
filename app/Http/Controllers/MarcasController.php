<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marcas;

class MarcasController extends Controller
{
   public function VListarMarcas(){
       $Marcas = Marcas::all();
       return view('Marcas.ListadoMarcas', [
           'Marcas' => $Marcas
       ]);
   }

   public function VFrmCreateMarcas(){
       return view('Marcas.FrmCreateMarcas');
   }

   public function ControCrearMarca(Request $request){
       $Descripcion = $request->input('Descripcion');
       $Marca = new Marcas();
       
       $Marca->Descripcion = $Descripcion;
       $Marca->Estado      = 1;

       $Marca->save();

       return redirect('RListarMarcas')->with('info','Marca Creada Correctamente');
   }

   public function VFrmModificarMarcas(Request $request){
    $IdMarca = $request->IdMarca;
    $Marca = Marcas::find($IdMarca);
    return view('Marcas.FrmEditarMarca',[
        'Marca' => $Marca
    ]);
   }
   public function EditarMarca(Request $request){
    $IdMarca     = $request->input('IdMarca');
    $Descripcion = $request->input('Descripcion');

    $Marca = Marcas::find($IdMarca);
    $Marca->Descripcion = $Descripcion;

    $Marca->save();

    return redirect('RListarMarcas')->with('info','Datos Modificados Correctamente');
   }

   public function EliminarMarca(Request $request){
       $IdMarca = $request->IdMarca;

       $Marca = Marcas::find($IdMarca);
       $Marca->Estado = 0;

       if($Marca->save()){
           return 1;
       }
   }
   public function HabilitarMarca(Request $request){
    $IdMarca = $request->IdMarca;

    $Marca = Marcas::find($IdMarca);
    $Marca->Estado = 1;

    if($Marca->save()){
        return 1;
    }
}
}
