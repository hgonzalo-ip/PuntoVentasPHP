<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoUsuario;
class TipoUsuarioController extends Controller
{
    public function VistaListar(){
        $TypeUser = TipoUsuario::all();
        return view('TipoUsuario.ListTypeUser', [
            'TypeUser' => $TypeUser
        ]);
    }
    public function VFrmCreateTypeUser(){
        return view('TipoUsuario.FrmCreateTypeUser');
    }

    public function FCreateTypeUser(Request $request){
        $Descripcion = $request->input('Descripcion');

        $TypeUser = new TipoUsuario();
        $TypeUser->Descripcion = $Descripcion;
        $TypeUser->Estado = 1;
        
        $TypeUser->save();
        return redirect('VListTypeUser')->with('info', 'Creado Correctamente');
    }
    function DeleteTypeUser(Request $request){
        $IdTypeUser = $request->IdTypeUser;
        $TypeUser = TipoUsuario::find($IdTypeUser);
        $TypeUser->Estado = 0;
        
        if($TypeUser->save()){
            return 1;
        }
    }
    
    function ControHabilitarTypeUser(Request $request){
        $IdTypeUser = $request->IdTypeUser;
        $TypeUser = TipoUsuario::find($IdTypeUser);
        $TypeUser->Estado = 1;
        
        if($TypeUser->save()){
            return 1;
        }
    }

    public function VFrmModificarTypeUser(Request $request){
        $IdTypeUser = $request->IdTypeUser;
        $TypeUser = TipoUsuario::find($IdTypeUser);
        return view('TipoUsuario.FrmModificarTypeUser',[
            'TypeUser' => $TypeUser
        ]);

    }
    public function ContoModificarTypeUser(Request $request){
        $IdTypeUser = $request->input('Txt_IdTypeUser');
        $Descripcion = $request->input('Descripcion');
        $TypeUser = TipoUsuario::find($IdTypeUser);
        $TypeUser->Descripcion = $Descripcion;

        $TypeUser->save();
        return redirect('VListTypeUser')->with('info', 'Modifiado Correctamente');
    }
}
