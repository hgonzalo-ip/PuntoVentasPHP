<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
class SucursalController extends Controller
{
  public function VListarSucursales(){
      $Sucursales = Sucursal::all();
      return view('Sucursales.SucursalesIndex',[
        'Sucursales' => $Sucursales
      ]);
  }
  public function FrmCrearSucursal(){
      return view('Sucursales.FrmCrearSucursal');
  }
  public function FrmEditarSucursal(Request $request){
    $IdSucursal = $request->IdSucursal;
    $Sucursales = Sucursal::find($IdSucursal);
    return view('Sucursales.FrmEditarSucursal',[
        'Sucursales' => $Sucursales
    ]);
   
    }
  public function CrearSucursal(Request $request){
 
      $Nombre = $request->Txt_Nombre;
      $Direccion = $request->Txt_Direccion;
      $Telefono = $request->Txt_Telfono;

      $Sucursal = new Sucursal();
      $Sucursal->Nombre = $Nombre;
      $Sucursal->Direccion = $Direccion;
      $Sucursal->Telefono = $Telefono;
      $Sucursal->Estado = 1;

      $Sucursal->save();

      return redirect('VListarSucursales')->with('info','Sucursal Creada Correctamente');
  }

  
  public function EditarSucursal(Request $request){

      $IdSucursal = $request->Txt_EditIdSucursal;
      $Nombre = $request->Txt_EditNombre;
      $Direccion = $request->Txt_EditDireccion;
      $Telefono = $request->Txt_EditTelfono;

      $Sucursales = Sucursal::find($IdSucursal);
      $Sucursales->Nombre = $Nombre;
      $Sucursales->Direccion = $Direccion;
      $Sucursales->Telefono = $Telefono;
      $Sucursales->save();

      return redirect('VListarSucursales')->with('info','Sucursal Modificada Correctamente');

  }
  public function EliminarSucursal(Request $request){
      $IdSucursal = $request->IdSucursal;
      $Sucursal = Sucursal::find($IdSucursal);
      $Sucursal->Estado = 0;
      if($Sucursal->save()){
          return 1;
      }
  }
  public function HabilitarSucursal(Request $request){
    $IdSucursal = $request->IdSucursal;
    $Sucursal = Sucursal::find($IdSucursal);
    $Sucursal->Estado = 1;
    if($Sucursal->save()){
        return 1;
    }
}
}
