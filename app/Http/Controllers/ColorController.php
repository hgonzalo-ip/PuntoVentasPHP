<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
class ColorController extends Controller
{
  public function VListarColores(){
      $Colores = Color::all();
      return view('Colores.ListarColores',[
          'Colores' => $Colores
      ]);
  }

  public function VFrmCrearColor(){
      return view('Colores.FrmCrearColor');
  }

  public function ControCrearColor(Request $request){
      $Descripcion = $request->Descripcion;

      $Colores = new Color();
      $Colores->Descripcion = $Descripcion;
      $Colores->Estado = 1;

    $Colores->save();
    return redirect('VListarColores')->with('info','Color Creado Correctamente');
  }

  public function VFrmModificarColor(Request $request){
      $IdColor = $request->IdColor;

      $Color = Color::find($IdColor);
      return view('Colores.FrmEditarColor',[
        'Color' => $Color
      ]);

  }

  public function EditarColor(Request $request){
      $IdColor = $request->IdColor;
      $Descripcion = $request->Descripcion;

      $Color = Color::find($IdColor);
      $Color->Descripcion = $Descripcion;

      $Color->save();
      return redirect('VListarColores')->with('info','Datos Modifiados Correctamente');

  }

  public function EliminarColor(Request $request){
      $IdColor  = $request->IdColor;

      $Color = Color::find($IdColor);
      $Color->Estado = 0;
    
        if($Color->save()){
            return 1;
        }
  }
  public function HabilitarColor(Request $request){
    $IdColor  = $request->IdColor;

    $Color = Color::find($IdColor);
    $Color->Estado = 1;
  
      if($Color->save()){
          return 1;
      }
}
}
