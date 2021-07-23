<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\Compras;
use App\Models\Ventas;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(){
        $Sucursales = Sucursal::where('Estado','=',1)->get();
        return view('dashboard',[
            'Sucursales' => $Sucursales
        ]);
    }
    public function Estadisticas(Request $request){
        $Fecha = Carbon::now('America/Guatemala');
        $Fecha = $Fecha->format('Y-m-d');
        $IdSucursal = $request->IdSucursal;
         $Compras = Compras::select('compras.IdCompra', 'compras.IdUsuario', 'compras.FechaCompra',  'compras.Total','compras.Estado','productos.IdSucursal')
                            ->join('detalleCompra','detalleCompra.IdCompra','=','compras.IdCompra')
                            ->where('compras.FechaCompra','LIKE',"%{$Fecha}%")
                            ->join('productos','productos.IdProducto','=','detalleCompra.IdProducto')
                            ->where('productos.IdSucursal','=',$IdSucursal)
                            ->where('compras.Estado','=',3)
                            ->get();
        $Ventas = Ventas::select('ventas.IdVenta','ventas.IdUsuario','ventas.IdCliente', 'ventas.FechaVenta', 'ventas.TotalPagar', 'ventas.Efectivo','ventas.cambio','ventas.Estado','users.IdSucursal')
        ->join('users','users.IdUsuario','=','ventas.IdUsuario')
        ->join('clientes','clientes.IdCliente','=','ventas.IdCliente')
        ->where('ventas.FechaVenta','LIKE',"%{$Fecha}%")
        ->where('ventas.Estado','=', 5)
        ->where('users.IdSucursal','=',$IdSucursal)->get();                 
        return view('Estadisticas',[
            'Compras' => $Compras,
            'Ventas' => $Ventas
        ]);
    }
}
