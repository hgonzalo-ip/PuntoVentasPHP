<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sucursal;
use App\Models\TipoProducto;
use App\Models\Productos;
use App\Models\Proveedores;
use App\Models\Imeis;
use App\Models\Compras;
use App\Models\DetalleCompra;
use  PDF;
use Carbon\Carbon;
class ComprasController extends Controller
{
    public function VGenerarCompra(){
        $Sucursales = Sucursal::where('Estado','=',1)->get();
        $Proveedores = Proveedores::where('Estado','=',1)->get();
        return view('Compras.GenerarCompra',[
            'Sucursales' => $Sucursales,
            'Proveedores' => $Proveedores
        ]);
    }
    public function ListarCompras(){
        $Fecha = Carbon::now('America/Guatemala');
        $Fecha = $Fecha->format('Y-m-d');
        $Sucursales  = Sucursal::where('Estado','=', 1)->get();
        $ListadoCompras = Compras::where('Estado','=', 3)
                                ->where('FechaCompra','LIKE',"%{$Fecha}%")->get();
        return view('Compras.ListarCompras',[
            'ListadoCompras' => $ListadoCompras,
            'Sucursales'    => $Sucursales
        ]);
    }
    public function ListadoProductosCompra(Request $request){
      
        $IdSucursal     = $request->IdSucursal;
        $IdProveedor = $request->IdProveedor;
      
            $Productos =  Productos::where('Estado', '=', 1)
                                    ->where('IdProveedor','=',$IdProveedor)
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Compras.CardProductosCompra',[
            'ProductosL' => $Productos
            ]); 
        
      
    }

    public function BuscadorProductos(Request $request){
        $Info = $request->Info;
        $IdSucursal = $request->IdSucursal;
        $IdIdProveedor = $request->IdProveedor;


        if($IdIdProveedor == 0){
         
            $Productos = Productos::where('NombreProductos','LIKE',"%{$Info}%")
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Compras.CardProductosCompra',[
            'ProductosL' => $Productos
            ]);
        }else{
           
            $Productos = Productos::where('NombreProductos','LIKE',"%{$Info}%")
                                    ->where('IdProveedor','=', $IdIdProveedor)
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Compras.CardProductosCompra',[
            'ProductosL' => $Productos
            ]);
        }
    }

    public function ModalAgregarImeis(Request $request){
        $IdProducto = $request->IdProducto;
        $Cantidad   = $request->Cantidad;
       return view('Compras.FrmAgregarImeis',[
           'IdProducto' => $IdProducto,
           'Cantidad'   => $Cantidad
       ]);
    }
    public function AgregarImeis(Request $request){

        $Imeis      = $request->input('Txt_Imeis');
        $Cantidad   = $request->input('Cantidad');
        $IdProducto = $request->input('Txt_IdProducto');
        
        for($i=0; $i < count($Imeis) ; $i++){
            $UnImei = $Imeis[$i];
            $ImeisOB = new imeis();
            $ImeisOB->IdProducto = $IdProducto;
            $ImeisOB->Imei = $UnImei;
            // El Estado 2 Hace referencia que la compra esta en proceso
            $ImeisOB->Estado = 2;

            $ImeisOB->save();
        }
        
        return 1;

    }

    public function GenerarCompra(Request $request){
        // Datos que bienen por la request
        $IdProducto = $request->input('IdProducto');
        $IdUsuario = auth()->user()->IdUsuario;
        $FechaCompra =  Carbon::now('America/Guatemala');
       
        
        $IdProductos = $request->input('IdProducto');
        $Cantidad   = $request->input('Cantidad');
        $TotalUnidad = $request->input('TotalUnidad');
        $TotalFinCompra = $request->input('TotalFinCompra');
        // 
        $Compra = new Compras();
        $Compra->IdUsuario      = $IdUsuario;
        $Compra->FechaCompra    = $FechaCompra;
        
        $Compra->Total          = $TotalFinCompra;
        $Compra->Estado         = 3;

        

        if($Compra->save()){
            $IdCompra  = $Compra->IdCompra;
            //$CanitadCompra = 0;
                for($i=0; $i < count($IdProductos); $i++){
                    $IdProducto = $IdProductos[$i];
                    $CanitadUnidad = $Cantidad[$i];
                    
                    $TotalUnidaFor = $TotalUnidad[$i];

                
                  // $CanitadCompra +=  $CanitadUnidad;

                    
                    $DetalleCompra = new DetalleCompra;
                    $DetalleCompra->IdCompra    = $IdCompra;
                    $DetalleCompra->IdProducto  = $IdProducto;
                    $DetalleCompra->CantidadUnidad = $CanitadUnidad;
                    $DetalleCompra->SubTotal    = $TotalUnidaFor;
                    $DetalleCompra->Estado      = 3;
                    
                    if($DetalleCompra->save()){
                        $Producto = Productos::find($IdProducto);
                        // Tomar la Cantidad del producto
                        $CantidadProductos = $Producto->Stok;
                        $CantidadNueva = $CantidadProductos + $CanitadUnidad;
                        $Producto->Stok = $CantidadNueva;
                        if($Producto->save()){
                            Imeis::where('Estado','=',2)
                                    ->where('IdProducto','=',$IdProducto)
                                    ->update(['Estado' => 3]);
                        // Modifica el Imeis a 3 hace referencia a que ese imei ya fue comprado
                        }
                        
                    }
                }
                //$Compra->Cantidad   = $CanitadCompra; No Funciona
                return 1;
        }
        
    }
    // GENERAR PDF PARA IMPRIMIR COMPRAS

    public function PdfCompras(Request $request, $IdCompra){
        $Compra        = Compras::find($IdCompra);
        $pdf = PDF::loadView('DetalleCompra.PDFDetalleCompra',[
            'Compra'        => $Compra
        ]);
        return $pdf->stream('DetalleCompra.pdf');
    }



    // VerDetalle de la Compra 
    public function VDetalleCompra(Request $request){
        $IdCompra = $request->IdCompra;
        $Compra        = Compras::find($IdCompra);
        $DetalleCompra = DetalleCompra::where('IdCompra','=',$IdCompra)->get();
        return view('DetalleCompra.ListadoDetalleCompra',[
            'DetalleCompra' => $DetalleCompra,
            'Compra'        => $Compra 
        ]);
    }

    // FILTROS DE COMPRAS
    public function FiltroFecha(Request $request){
        $Fecha = $request->Fecha;
        $IdSucursal = $request->Sucursal;
        // El Estado 3 hace referencia a que la Compra Ya fue realizada
        $Compras = Compras::select('compras.IdCompra', 'compras.IdUsuario', 'compras.FechaCompra', 'compras.Total','compras.Estado','users.Nombres','users.Apellidos')
                            ->join('users','users.IdUsuario','=','compras.IdUsuario')
                            ->join('detalleCompra','detalleCompra.IdCompra','=','compras.IdCompra')
                            ->join('productos','productos.IdProducto','=','detalleCompra.IdProducto')
                            ->where('productos.IdSucursal','=',$IdSucursal)
                            ->where('compras.Estado','=',3)
                            ->where('compras.FechaCompra','LIKE',"%{$Fecha}%")->get();
        return view('Compras.TrFecha',[
            'Compras' => $Compras
        ]);
    }
    public function FiltroEntreFecha(Request $request){
        $FechaInicio = $request->FechaInicio;
        $FechaFin = $request->FechaFin;
        $IdSucursal = $request->Sucursal;
        // El Estado 3 hace referencia a que la Compra Ya fue realizada
        $Compras = Compras::select('compras.IdCompra', 'compras.IdUsuario', 'compras.FechaCompra', 'compras.Total','compras.Estado','users.Nombres','users.Apellidos')
                            ->join('users','users.IdUsuario','=','compras.IdUsuario')
                            ->join('detalleCompra','detalleCompra.IdCompra','=','compras.IdCompra')
                            ->join('productos','productos.IdProducto','=','detalleCompra.IdProducto')
                            ->where('productos.IdSucursal','=',$IdSucursal)
                            ->where('compras.Estado','=',3)
                            ->where('compras.FechaCompra','>=',$FechaInicio)
                            ->where('compras.FechaCompra','<=',$FechaFin)->get();
        return view('Compras.TrFecha',[
            'Compras' => $Compras
        ]);
    }

    public function FiltroMes(Request $request){
        $Mes = $request->Mes;
        $IdSucursal = $request->Sucursal;
        // El Estado 3 hace referencia a que la Compra Ya fue realizada
        $Compras = Compras::select('compras.IdCompra', 'compras.IdUsuario', 'compras.FechaCompra', 'compras.Total','compras.Estado','users.Nombres','users.Apellidos')
                            ->join('users','users.IdUsuario','=','compras.IdUsuario')
                            ->join('detalleCompra','detalleCompra.IdCompra','=','compras.IdCompra')
                            ->join('productos','productos.IdProducto','=','detalleCompra.IdProducto')
                            ->where('productos.IdSucursal','=',$IdSucursal)
                            ->where('compras.Estado','=',3)
                            ->where('FechaCompra','LIKE',"%{$Mes}%")//Ver si se puede modificar la fecha que viene de la bd 
                            ->get();
        return view('Compras.TrFecha',[
            'Compras' => $Compras
        ]);
    }

    public function FiltroYear(Request $request){
        $Year = $request->Year;
        $IdSucursal = $request->Sucursal;
        // El Estado 3 hace referencia a que la Compra Ya fue realizada
        $Compras = Compras::select('compras.IdCompra', 'compras.IdUsuario', 'compras.FechaCompra', 'compras.Total','compras.Estado','users.Nombres','users.Apellidos')
                            ->join('users','users.IdUsuario','=','compras.IdUsuario')
                            ->join('detalleCompra','detalleCompra.IdCompra','=','compras.IdCompra')
                            ->join('productos','productos.IdProducto','=','detalleCompra.IdProducto')
                            ->where('productos.IdSucursal','=',$IdSucursal)
                            ->where('compras.Estado','=',3)
                            ->where('FechaCompra','LIKE',"%{$Year}%")//Ver si se puede modificar la fecha que viene de la bd 
                            ->get();
        return view('Compras.TrFecha',[
        'Compras' => $Compras
        ]);

        if($Condicio){
            // Declaraciones
        }


        
        if($Condicio)
        {
            // Declaraciones
        }
        
    }
}
