<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\TipoUsuario;
use App\Models\Sucursal;

use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }
    public function VistaListar(){
        $User = User::join('tipousuario', 'users.IdTipoUsuario', '=', 'tipousuario.IdTipoUsuario')->get();
        return view('Usuarios.ListUser',[
            'User' => $User
        ]);
    }
    public function ViewFrmCreateUser(){
        $TypeUser = TipoUsuario::where('Estado', '=',1)->get();
        $typeStore = Sucursal::where('Estado','=',1)->get();
        return view('Usuarios.FrmCreateUser', [
            'TypeUser'  => $TypeUser,
            'TypeStore' => $typeStore
        ]);
    }
    function CreateUser(Request $request){
     
        $IdTypeUser = $request->input('Slt_IdTypeUser'); 
        $IdTypeStore = $request->input('Slt_IdTypeStore'); 
        $NameUser = $request->input('NameUser');
        $LastName = $request->input('LastName');
        $Tel       = $request->input('Tel');
        $DPI       = $request->input('DPI');
        $Email     = $request->input('Email');
        $Password  = bcrypt($request->input('password'));

        $User = new User();
        $User->IdTipoUsuario = $IdTypeUser;
        $User->IdSucursal    = $IdTypeStore;
        $User->Nombres       = $NameUser;
        $User->Apellidos        = $LastName;
        $User->Telefono        = $Tel;
        $User->DPI        = $DPI;
        $User->email        = $Email;
        $User->password     =$Password;
        $User->EstadoU        = 1;

            $User->save();
          
            return redirect('/VListarUsuarios')->with('info', 'Usuario Creado Correctamente' );
        
    }

    public function InfoUser(Request $request){
        $IdUser = $request->IdUser;
        $User = user::join('tipousuario', 'users.IdTipoUsuario', '=', 'tipousuario.IdTipoUsuario')
                    ->join('sucursales', 'users.IdSucursal', '=' , 'sucursales.IdSucursal')
                    ->where('IdUsuario', '=', $IdUser)->get();
        return view('Usuarios.InfoUser',[
            'User' => $User
        ]);
    }
    public function DeleteUser(Request $request){
        $IdUser = $request->IdUser;
        $User = user::find($IdUser);
        $User->EstadoU = 0;
        
        if($User->save()){
            return 1;
        }
    }
    public function HabilitarUser(Request $request){
        $IdUser = $request->IdUser;
        $User = user::find($IdUser);
        $User->EstadoU = 1;
        
        if($User->save()){
            return 1;
        }
    }

    public function ViewFrmModificarUser(Request $request){
        $IdUser = $request->IdUser;
        $TypeUser = TipoUsuario::where('Estado', '=',1)->get();
        $typeStore = Sucursal::where('Estado','=',1)->get();
        $User = User::find($IdUser);
        return view('Usuarios.FrmModificarUser', [
            'TypeUser'  => $TypeUser,
            'TypeStore' => $typeStore,
            'User'      =>  $User
        ]);
    }

    public function EditUser(Request $request){
        $IdUser = $request->input('IdUsuer'); 
        $IdTypeUser = $request->input('Slt_IdTypeUser'); 
        $IdTypeStore = $request->input('Slt_IdTypeStore'); 
        $NameUser = $request->input('NameUser');
        $LastName = $request->input('LastName');
        $Tel       = $request->input('Tel');
        $DPI       = $request->input('DPI');
        $Email     = $request->input('Email');

        $User = User::find($IdUser);
        $User->IdTipoUsuario = $IdTypeUser;
        $User->IdSucursal    = $IdTypeStore;
        $User->Nombres       = $NameUser;
        $User->Apellidos        = $LastName;
        $User->Telefono        = $Tel;
        $User->DPI        = $DPI;
        $User->email        = $Email;

        $User->save();
          
        return redirect('/VListarUsuarios')->with('info', 'Usuario Modificado Correctamente' );
    }
}
