<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Clientes;
use App\Models\User;
use App\Models\Productos;
use App\Models\Imeis;
use App\Models\Ventas;
use App\Models\DetalleVenta;
use App\Models\Sucursal;
use  PDF;
use Carbon\Carbon;
class VentasController extends Controller

{
    
    public function VGenerarVenta(){
       
        $IdTipoUser = auth()->user()->IdTipoUsuario;

        if($IdTipoUser == 1){
            $Clientes = Clientes::where('Estado','=',1)->get();
            $Productos = Productos::where('Estado','=',1)->get();
            return view('Ventas.GenerarVenta',[
                'Clientes' => $Clientes,
                'Productos' => $Productos
            ]);
        }else if($IdTipoUser == 2){
            $IdSucursal = auth()->user()->IdSucursal;
            $Clientes = Clientes::where('Estado','=',1)->get();
            $Productos = Productos::where('Estado','=',1)
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Ventas.GenerarVenta',[
                'Clientes' => $Clientes,
                'Productos' => $Productos
            ]);
        }
       
    }
    public function SeleccionarCliente(Request $request){ //Retorna la vista de la informacion del cliente a quien le haremos la compra
        $IdCliente = $request->IdCliente;
       
        $Cliente= Clientes::find($IdCliente);
        return view('Ventas.ClienteVenta',[
            'Cliente' => $Cliente
        ]);
    }
    public function ListadoProductosVenta(Request $request){
      
        $IdSucursal     =auth()->user()->IdSucursal;
            $Productos =  Productos::where('Estado', '=', 1)
                                    ->where('IdSucursal','=',$IdSucursal)
                                    ->where('Stok','>=',1)->get();
            return view('Ventas.CardProductosVenta',[
            'ProductosL' => $Productos
            ]); 
        
      
    }
    public function BuscadorProductosVenta(Request $request){
        $Info = $request->Info;
        $IdSucursal     =auth()->user()->IdSucursal;

            $Productos = Productos::where('NombreProductos','LIKE',"%{$Info}%")
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Ventas.CardProductosVenta',[
            'ProductosL' => $Productos
            ]);
    
    }

    public function ModalSeleccionarImeisVenta(Request $request){
        $IdProducto = $request->IdProducto;
        $Cantidad   = $request->Cantidad;
        // Se buscara todos los imesis dependiendo el El IdProducto
        // El Estado 3 del Imei Hace referencia a todos los imeis que ya fueron comprados
        $Imeis = Imeis::where('IdProducto','=',$IdProducto)->where('Estado','=',3)->get();
       return view('Ventas.FrmSeleccionaImeisVentas',[
           'IdProducto' => $IdProducto,
           'Imeis'      => $Imeis,
           'Cantidad'   => $Cantidad
       ]);
    }
    public function VenderImeis(Request $request){
        $IdImei = $request->IdImei;
        $Imeis = Imeis::find($IdImei);
        // El Estado 4 hace referencia que la Venta esta em proceso
        $Imeis->Estado = 4;
        if($Imeis->save()){
            return 1;
        }
    }

    public function GenerarVenta(Request $request){
        // VARIABLES
     
        $IdUsuario         = auth()->user()->IdUsuario;
        $IdCliente         = $request->input('Txt_IdCliente');    
        
        // ARRAYS
        $IdProductos     = $request->input('IdProducto');
        $Cantidades       = $request->input('Cantidad');
        $TotalUnidades    = $request->input('TotalUnidad');
        // Variables
        $TotalFinCompra = $request->input('TotalFinVenta');
        $Efectivo       = $request->input('Efectivo');
        $Cambio         =$request->input('Cambio');


        $Venta = new Ventas();
        $Venta->IdUsuario = $IdUsuario;
        $Venta->IdCliente = $IdCliente;
        $Venta->FechaVenta =  Carbon::now('America/Guatemala');
        $Venta->TotalPagar = $TotalFinCompra;
        $Venta->Efectivo   = $Efectivo;
        $Venta->Cambio     = $Cambio;
        $Venta->Estado     = 5;
        
        if($Venta->save()){
            $IdUltimaVenta = $Venta->IdVenta;

            // Recorrer Los Arrays
            for($i=0; $i < count($IdProductos); $i++){
                $IdProducto = $IdProductos[$i];
                $Cantidad   = $Cantidades[$i];
                $TotalUnidad = $TotalUnidades[$i];

                // Hace el inser al detalleVenta
                $DetalleVenta = new DetalleVenta();
                $DetalleVenta->IdVenta          = $IdUltimaVenta;
                $DetalleVenta->IdProducto       = $IdProducto;
                $DetalleVenta->CanitadUnidad    = $Cantidad;
                $DetalleVenta->SubTotal         = $TotalUnidad;
                $DetalleVenta->Estado           = 5;

                if($DetalleVenta->save()){
                    $Productos = Productos::find($IdProducto);
                    $StokActual = $Productos->Stok;
                    $CantidadNueva = $StokActual - $Cantidad;
                    $Productos->Stok = $CantidadNueva;

                    if($Productos->save()){
                        Imeis::where('Estado','=',4)
                                ->where('IdProducto','=',$IdProducto)
                                ->update(['Estado' => 5]);
                                
                    }
                }
            }
        }else{
            Imeis::where('Estado','=',4)
                    ->where('IdProducto','=',$IdProducto)
                    ->update(['Estado' => 3]);
        }
        return 1;
    }

    // ListarVentas 
    public function VListarVentas(){
        $IdTipoUser     = auth()->user()->IdTipoUsuario;
        $IdUsuario      = auth()->user()->IdUsuario;
        
        $Sucursales     = Sucursal::where('Estado','=', 1)->get();
        $Fecha = Carbon::now('America/Guatemala');
        $Fecha = $Fecha->format('Y-m-d');
        if($IdTipoUser == 1){
            $Ventas = Ventas::where('Estado','=', 5)
                            ->where('FechaVenta','LIKE',"%{$Fecha}%")
                            ->get();
            return view('Ventas.ListarVentas',[
            'Ventas' => $Ventas,
            'Sucursales' => $Sucursales
            ]);
        }else if($IdTipoUser == 2){
            $Ventas = Ventas::where('Estado','=', 5)
                            ->where('IdUsuario','=',$IdUsuario)
                            ->where('FechaVenta','LIKE',"%{$Fecha}%")
                            ->get();
                return view('Ventas.ListarVentas',[
                'Ventas' => $Ventas,
                'Sucursales' => $Sucursales
                ]);
        }
       
     
    }
    
    // Filtros De Fechas
    public function FiltroFechaVenta(Request $request){
        $Fecha      = $request->Fecha;
        $IdSucursal = $request->Sucursal;
        // El Estado 5 hace referencia a que la Venta Ya fue realizada
        $Sucursales = Sucursal::where('Estado','=', 1)->get();
        $Ventas = Ventas::select('ventas.IdVenta','ventas.IdUsuario','ventas.IdCliente', 'ventas.FechaVenta', 'ventas.TotalPagar', 'ventas.Efectivo','ventas.cambio','ventas.Estado','users.IdSucursal')
                        ->join('users','users.IdUsuario','=','ventas.IdUsuario')
                        ->join('clientes','clientes.IdCliente','=','ventas.IdCliente')
                        ->where('ventas.Estado','=', 5)
                        ->where('users.IdSucursal','=',$IdSucursal)
                        ->where('FechaVenta','LIKE',"%{$Fecha}%")->get();
        return view('Ventas.TrFechaVenta',[
            'Ventas' => $Ventas
        ]);
    }
    public function FiltroEntreFechaVentas(Request $request){
        $FechaInicio = $request->FechaInicio;
        $FechaFin = $request->FechaFin;
        $IdSucursal = $request->Sucursal;
        // El Estado 5 hace referencia a que la Venta Ya fue realizada
        $Ventas = Ventas::select('ventas.IdVenta','ventas.IdUsuario','ventas.IdCliente', 'ventas.FechaVenta', 'ventas.TotalPagar', 'ventas.Efectivo','ventas.Cambio','ventas.Estado','users.IdSucursal')
                            ->join('users','users.IdUsuario','=','ventas.IdUsuario')
                            ->join('clientes','clientes.IdCliente','=','ventas.IdCliente')
                            ->where('ventas.Estado','=', 5)
                            ->where('users.IdSucursal','=',$IdSucursal)
                            ->where('FechaVenta','>=',$FechaInicio)
                            ->where('FechaVenta','<=',$FechaFin)->get();
        return view('Ventas.TrFechaVenta',[
            'Ventas' => $Ventas
        ]);
    }
    public function FiltroPorMesVentas(Request $request){
        $Mes = $request->Mes;
        $IdSucursal = $request->Sucursal;
       
        // El Estado 5 hace referencia a que la Venta Ya fue realizada
        $Ventas = Ventas::select('ventas.IdVenta','ventas.IdUsuario','ventas.IdCliente', 'ventas.FechaVenta', 'ventas.TotalPagar', 'ventas.Efectivo','ventas.Cambio','ventas.Estado','users.IdSucursal')
                        ->join('users','users.IdUsuario','=','ventas.IdUsuario')
                        ->join('clientes','clientes.IdCliente','=','ventas.IdCliente')
                        ->where('ventas.Estado','=', 5)
                        ->where('users.IdSucursal','=',$IdSucursal)
                        ->where('FechaVenta','LIKE',"%{$Mes}%")
                        ->get();
        return view('Ventas.TrFechaVenta',[
            'Ventas' => $Ventas
        ]);
    }
    
    public function FiltroYearVenta(Request $request){
        $Year = $request->Year;
        $IdSucursal = $request->Sucursal;
      
        // El Estado 5 hace referencia a que la Venta Ya fue realizada
        $Ventas = Ventas::select('ventas.IdVenta','ventas.IdUsuario','ventas.IdCliente', 'ventas.FechaVenta', 'ventas.TotalPagar', 'ventas.Efectivo','ventas.Cambio','ventas.Estado','users.IdSucursal')
                        ->join('users','users.IdUsuario','=','ventas.IdUsuario')
                        ->join('clientes','clientes.IdCliente','=','ventas.IdCliente')
                        ->where('ventas.Estado','=', 5)
                        ->where('users.IdSucursal','=',$IdSucursal)
                        ->where('FechaVenta','LIKE',"%{$Year}%")
                        ->get();
        return view('Ventas.TrFechaVenta',[
        'Ventas' => $Ventas
        ]);
    }

    // Ver Detalle Venta
    
    public function VDetalleVenta(Request $request){
        $IdVenta = $request->IdVenta;
        $Venta        = Ventas::find($IdVenta);
        $DetalleVenta = DetalleVenta::where('IdVenta','=',$IdVenta)->get();
        return view('DetalleVenta.ListadoDetalleVenta',[
            'DetalleVenta' => $DetalleVenta,
            'Venta'        => $Venta 
        ]);
    }
        // GENERAR PDF PARA IMPRIMIR Ventas

        public function PDFVentas(Request $request, $IdVenta){
       
            $Ventas        = Ventas::find($IdVenta);
          
            $pdf = PDF::loadView('DetalleVenta.PDFDetalleVenta',[
                'Ventas'        => $Ventas
            ]);
            return $pdf->stream('DetalleVenta.pdf');
        }
    
    public function VGenerarCorte(Request $request){
        $Sucursales = Sucursal::where('Estado','=',1)->get();
        return view('Ventas.GenerarCorteDelDia',[
            'Sucursales' => $Sucursales
        ]);
    }
   
    public function CorteDia(Request $request){
        $IdSucursal = $request->IdSucursal;
        $Fecha = Carbon::now('America/Guatemala');
        $Fecha = $Fecha->format('Y-m-d');
         
        $Ventas = Ventas::select('ventas.IdVenta','ventas.IdUsuario','ventas.IdCliente', 'ventas.FechaVenta', 'ventas.TotalPagar', 'ventas.Efectivo','ventas.Cambio','ventas.Estado','users.IdSucursal')
                        ->join('users','users.IdUsuario','=','ventas.IdUsuario')
                        ->where('ventas.FechaVenta','=',$Fecha)
                        ->where('ventas.Estado','=', 5)
                        ->where('users.IdSucursal','=',$IdSucursal)
                        ->get();
        
         return view('Ventas.CorteDia',[
             'Ventas' => $Ventas
         ]);
    }
    // Vista Ver detalle Producto
    public function VerDetalleProducto(Request $request){
        $IdProducto  = $request->IdProducto;
        $Producto = Productos::find($IdProducto);

        return view('Productos.VistaDetalleProducto', [
            'Producto' => $Producto
        ]);
    }
}
