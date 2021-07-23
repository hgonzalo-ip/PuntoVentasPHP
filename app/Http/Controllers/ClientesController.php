<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use Illuminate\Support\Facades\Validator;
class ClientesController extends Controller
{
    public function VListarClientes(){
        $Clientes = Clientes::all();
        return view('Clientes.ListarClientes',[
            'Clientes' => $Clientes
        ]);
    }
    public function FrmCrearClientes(){
        return view('Clientes.FrmCrearClientes');
    }

    public function CrearCliente(Request $request){
   
        $validated = $request->validate([
            'NIT' => 'required|unique:clientes|max:9',
            
        ]);

        $Nombre = $request->input('Txt_Nombre');
        $Apellido = $request->input('Txt_Apellido');
        $NIT = $request->input('Txt_NIT');

        $Clientes = new Clientes();
        $Clientes->Nombres = $Nombre;
        $Clientes->Apellidos = $Apellido;
        $Clientes->NIT = $NIT;
        $Clientes->Estado = 1;
        $Clientes->save();
        return redirect('VListarClientes')->with('info','Cliente Agregado Correctamente');
    }

    public function ValidarNit(Request $request){
        
    }
    public function FrmEditCliente(Request $request){
        $IdCliente = $request->IdCliente;

        $Cliente = Clientes::find($IdCliente);

        return view('Clientes.FrmEditCliente',[
            'Cliente' => $Cliente
        ]);

    }
    function EditarCliente(Request $request){
        $IdCliente = $request->input('Txt_IdCliente');
        $Nombre = $request->input('Txt_Nombre');
        $Apellido = $request->input('Txt_Apellido');
        $NIT = $request->input('Txt_NIT');

        $Cliente = Clientes::find($IdCliente);
        $Cliente->Nombres = $Nombre;
        $Cliente->Apellidos = $Apellido;
        $Cliente->NIT = $NIT;

        $Cliente->save();
        return redirect('VListarClientes')->with('info','Cliente Modificado Correctamente');
        
    }

    public function EliminarCliente(Request $request){
        $IdCliente = $request->IdCliente;

        $Cliente = Clientes::find($IdCliente);
        $Cliente->Estado = 0;

        if($Cliente->save()){
            return 1;
        }
    }

    public function HabilitarCliente(Request $request){
        $IdCliente = $request->IdCliente;

        $Cliente = Clientes::find($IdCliente);
        $Cliente->Estado = 1;

        if($Cliente->save()){
            return 1;
        }
    }
}
