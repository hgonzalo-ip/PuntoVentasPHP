<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProveedores;
use App\Models\Proveedores;
use App\Models\Marcas;
use App\Models\DetalleMarca;
class ProveedoresController extends Controller
{
public function ViewListProvider(){
    $Proveedores = Proveedores::all();
    return view('Proveedores.ListProviders', [
        'Proveedores' =>$Proveedores
    ]);
}

public function VFrmCreateProviders(){
    $TiposDeProveedores = TipoProveedores::where('Estado','=', 1)->get();
    return view('Proveedores.FrmCreateProviders',[
        'TiposDeProveedores' => $TiposDeProveedores
    ]);
}
public function ControCrearProveedor(Request $request){
    $IdTipoProveedor = $request->input('Slt_IdTipoProveedor');
    $NombreProveedor         = $request->input('Nombre');
    $Direccion       = $request->input('Direccion');
    $Telefono        = $request->input('Telefono');
    $NIT       = $request->input('NIT');

    $Proveedores = new Proveedores();
    $Proveedores->IdTipoProveedor = $IdTipoProveedor;
    $Proveedores->Nombre          = $NombreProveedor;
    $Proveedores->Direccion       = $Direccion;
    $Proveedores->Telefono        = $Telefono;
    $Proveedores->NIT             = $NIT;
    $Proveedores->Estado          = 1;

    $Proveedores->save();
   
    return redirect('VListarProveedores')->with('info', 'Proveedor Creado Correctamente');
}

    public function VFrmModificarProviders(Request $request){
        $IdProvider = $request->IdProviders;
        $TiposDeProveedores = TipoProveedores::where('Estado','=', 1)->get();
        $Proveedores = Proveedores::find($IdProvider);
        return view('Proveedores.FrmModificarProviders',[
            'Proveedores' => $Proveedores,
            'TiposDeProveedores' => $TiposDeProveedores
        ]);
    }

    public function ModificarProveedores(Request $request){
        $IdProveedor = $request->IdProveedor;
        $IdTipoProveedor = $request->input('Slt_IdTipoProveedor');
        $NombreProveedor         = $request->input('Nombre');
        $Direccion       = $request->input('Direccion');
        $Telefono        = $request->input('Telefono');
        $NIT       = $request->input('NIT');

        $Proveedores =  Proveedores::find($IdProveedor);
        $Proveedores->IdTipoProveedor = $IdTipoProveedor;
        $Proveedores->Nombre          = $NombreProveedor;
        $Proveedores->Direccion       = $Direccion;
        $Proveedores->Telefono        = $Telefono;
        $Proveedores->NIT             = $NIT;
        $Proveedores->Estado          = 1;
    
        $Proveedores->save();
       
        return redirect('VListarProveedores')->with('info', 'Proveedor Modificado Correctamente');
        
    }

        public function DeleteProveedor(Request $request){
            $IdProveedor = $request->IdProveedor;
            $Proveedores =  Proveedores::find($IdProveedor);
            $Proveedores->Estado = 0;

            if($Proveedores->save()){
                return 1;
            }
        }
    
    public function HabilitarProveedor(Request $request){
        $IdProveedor = $request->IdProveedor;
        $Proveedores =  Proveedores::find($IdProveedor);
        $Proveedores->Estado = 1;

        if($Proveedores->save()){
            return 1;
        }
    }
    public function VistaAgregarMarca(Request $request){
        $Marca = Marcas::all();
        $IdProvider = $request->IdProviders;
       
       return view('Proveedores.TblListMarcas', [
           'Marca' => $Marca,
           'Proveedor' => $IdProvider
       ]);
    }

    public function AgregarMarcaProveedor(Request $request){
        $IdMarca = $request->IdMarca;
        $IdProveedor = $request->IdProveedor;

        $DetalleMarcaFind = DetalleMarca::where('IdMarca','=' ,$IdMarca)
                                        ->where('IdProveedor','=',$IdProveedor)->get();

        if(sizeof($DetalleMarcaFind) == 0){

            $DetalleMarca = new DetalleMarca();

        $DetalleMarca->IdProveedor = $IdProveedor;
        $DetalleMarca->IdMarca = $IdMarca;
        $DetalleMarca->Estado = 1;

        if($DetalleMarca->save()){
            return 1;
        }
        }else{
            $DetalleMarcaFind = DetalleMarca::where('IdMarca','=' ,$IdMarca)
                                        ->where('IdProveedor','=',$IdProveedor)->first();
            $DetalleMarcaFind->Estado = 1;
            if($DetalleMarcaFind->save()){
                return 1;
            }
        }

        
    }
    public function QuitarMarcaProveedor(Request $request){
        $IdMarca = $request->IdMarca;
        $IdProveedor = $request->IdProveedor;
        
        $DetalleMarca = DetalleMarca::where('IdMarca','=',$IdMarca)->where('IdProveedor','=',$IdProveedor)->where('Estado','=',1)->first();
        
        $DetalleMarca->Estado = 2;
      
       if($DetalleMarca->save()){
           return 1;
       }
            
        
    }
}
