<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProducto;
use App\Models\Sucursal;
use App\Models\Proveedores;
use App\Models\Marcas;
use App\Models\DetalleMarca;
use App\Models\Color;
use App\Models\Productos;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;

class ProductosController extends Controller
{
    public function VistaCrear(){
        $TipoProducto       = TipoProducto::where('Estado', '=', 1)->get();
        $Sucursal           = Sucursal::where('Estado', '=', 1)->get();
        $Proveedores        = Proveedores::where('Estado', '=' , 1)->get();
       // $ProveedoresAccesorios        = Proveedores::where('Estado', '=' , 1)->where('IdTipoProducto', '=', 3)->get();
        $ProveedoresChip        = Proveedores::where('Estado', '=' , 1)->get();
       // $MarcasTelefono     = Marcas::where('Estado','=',1)->where('IdProducto','=',1)->get();
       // $MarcasAccesorios   = Marcas::where('Estado','=',1)->where('IdTipoProducto','=',3)->get();
        $Colores            = Color::where('Estado','=',1)->get();
        return view('Productos.Crear',[
            'TipoProductos'   => $TipoProducto,
            'Sucursales'      => $Sucursal,
            'Proveedores'     => $Proveedores,
            'ProveedoresChip' => $ProveedoresChip,
           // 'MarcaTelefonos'  => $MarcasTelefono,
            //'MarcaAccesorios' => $MarcasAccesorios,
            'Colores'         => $Colores       
        ]);
    }
    public function ListarMarca(Request $request){
        $IdProveedor = $request->IdProveedor;
        $DetalleMarca     = DetalleMarca::join('marcas','marcas.IdMarca','=','DetalleMarca.IdMarca')
                                        ->where('marcas.Estado','=',1)
                                        ->where('DetalleMarca.IdProveedor','=',$IdProveedor)->get();
        return view('Productos.SelectMarca',[
            'DetalleMarca'  => $DetalleMarca
        ]);
    }

    public function VistaListar(){
          $TipoProductos      = TipoProducto::where('Estado', '=', 1)->get();
          $Sucursal           = Sucursal::where('Estado','=',1)->get();
            return view('Productos.ListarP',[
            'TiposProductos' => $TipoProductos,
            'Sucursales'     => $Sucursal
        ]); 
    }




    public function FrmCrearProducto(Request $request){
        $IdTipoProducto = $request->IdTipo;
        $Sucursal           = Sucursal::where('Estado', '=', 1)->get();
        $Proveedores        = Proveedores::where('Estado', '=' , 1)->get();
        $Colores            = Color::where('Estado','=',1)->get();
        return view('Productos.FrmCrearProducto',[
            'Sucursales'      => $Sucursal,
            'Proveedores'     => $Proveedores,
            'Colores'         => $Colores,
            'IdTipoProducto'  => $IdTipoProducto
               
        ]);
    }

    public function FrmCrearChip(){
        $TipoProducto       = TipoProducto::where('Estado', '=', 1)->get();
        $Sucursal           = Sucursal::where('Estado', '=', 1)->get();
        $ProveedoresChip        = Proveedores::where('Estado', '=' , 1)->get();
        $Colores            = Color::where('Estado','=',1)->get();
        return view('Productos.FrmCrearChip',[
            'TipoProductos'   => $TipoProducto,
            'Sucursales'      => $Sucursal,
            'ProveedoresChip' => $ProveedoresChip,
            'Colores'         => $Colores   
        ]);
    }



    public function ListadoProductos(Request $request){
        $IdTipoProducto = $request->IdTipoProducto;
        $IdSucursal     = $request->IdSucursal;
        if($IdTipoProducto == 4){
            $Productos =  Productos::where('Estado', '=', 1)
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Productos.CardProductos',[
            'ProductosL' => $Productos
            ]); 
        }else if($IdTipoProducto == 1 || $IdTipoProducto == 2 || $IdTipoProducto == 3) {
            $Productos =  Productos::where('Estado', '=', 1)
                                    ->where('IdTipoProducto','=', $IdTipoProducto)
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Productos.CardProductos',[
            'ProductosL' => $Productos
            ]); 
        }else if($IdTipoProducto == 0){
            $Productos =  Productos::where('Estado', '=', 0)
                                   ->where('IdSucursal','=',$IdSucursal)->get();
                                    return view('Productos.CardProductos',[
                                    'ProductosL' => $Productos
                                    ]); 
        }
   
    }
    

    public function GuardarProducto(Request $request){

    $IdTipoProducto  = $request->input('IdTipoProducto');
    $IdProveedor     = $request->IdProveedorT;
    $IdSucursal      = $request->IdSucursalT;
    $IdMarca        = $request->IdMarcaT;
    $Nombre          = $request->name;
    $Descripcion     = $request->DescripcionT;
    $IdColor         = $request->IdColorT;
    $PrecioVenta     = $request->PrecioVentaT;
    $PrecioCompra    = $request->PrecioCompraT;
    $Ganancia        = $request->GananciaT;
        
        $Productos = new Productos ();
        $Productos->IdTipoProducto = $IdTipoProducto;
        $Productos->IdProveedor    = $IdProveedor;
        $Productos->IdSucursal      = $IdSucursal;
        $Productos->IdMarca         = $IdMarca;
        $Productos->IdColor         = $IdColor;
        $Productos->NombreProductos = $Nombre;
        $Productos->Descripcion     = $Descripcion;
        $Productos->PrecioVenta     = $PrecioVenta;
        $Productos->PrecioCompra    = $PrecioCompra;
        $Productos->Ganancia        = $Ganancia;
        $Productos->Stok            = 0;
        $Productos->Estado          = 1;

             $Productos->save();
            return redirect('VCrearProductos')->with('info','Producto Creado Correctamente');
    }

    
    public function GuardarChip(Request $request){

        $IdTipoProducto  = $request->IdTipoProducto;
        $IdProveedor     = $request->IdProveedorT;
        $IdSucursal      = $request->IdSucursalT;
        $Nombre          = $request->name;
        $Descripcion     = $request->DescripcionT;
       
        $PrecioVenta     = $request->PrecioVentaT;
        $PrecioCompra    = $request->PrecioCompraT;
        $Ganancia        = $request->GananciaT;
        
        $Productos = new Productos ();
        $Productos->IdTipoProducto = $IdTipoProducto;
        $Productos->IdProveedor    = $IdProveedor;
        $Productos->IdSucursal      = $IdSucursal;
        $Productos->NombreProductos = $Nombre;
        $Productos->Descripcion     = $Descripcion;
        $Productos->PrecioVenta     = $PrecioVenta;
        $Productos->PrecioCompra    = $PrecioCompra;
        $Productos->Ganancia        = $Ganancia;
        $Productos->Stok            = 0;
        $Productos->Estado          = 1;

             $Productos->save();
             return redirect('VCrearProductos')->with('info','Chip Creado Correctamente');
    }
   
    public function MdAgregarFotos(Request $request){
        $IdProducto = $request->IdProducto;
       
        return view('Productos.FrmAgregarFoto', [
            'IdProducto' => $IdProducto
            ]);
        
    }
    public function GuardarImagen(Request $request){
   
         $Imagen     = $request->file('Fotos');
         $NombreImg = uniqid().'.'.$Imagen->extension();
      
        
        
        $IdProducto = $request->input('IdProducto');
        $Productos = Productos::find($IdProducto);
        $Productos->Foto = $NombreImg;
        $Ruta = Storage_path().'\app\Img/'.$NombreImg;
        Image::make($Imagen)->resize(null, 125, function ($constraint) {
            $constraint->aspectRatio();
        })->save($Ruta);
        if(  $Productos->save()){
            return 1;
        }
    }

    public function VerImagen($NombreImagen){
        $File = Storage::disk('Imagenes')->get($NombreImagen);
        return Response($File);
    }

    public function MdProductosEdit(Request $request){
        $IdProducto = $request->input('IdProducto');
        $Productos = Productos::find($IdProducto);

        $IdProveedorFind = $Productos->IdProveedor;
        $IdMarcaFind     = $Productos->IdMarca;

        $IdTipo = $Productos->IdTipoProducto;
        
        if($IdTipo == 1 || $IdTipo == 3){
            $TipoProducto       = TipoProducto::where('Estado', '=' , 1)->get();     
            $Proveedores        = Proveedores::where('Estado', '=' , 1)->get();
            $DetalleMarcaFind   = DetalleMarca::where('IdMarca','=',$IdMarcaFind)->where('IdProveedor','=',$IdProveedorFind)->first();
           
            $Marcas             = Marcas::where('Estado', '=', 1) ->get();
            $Colores            = Color::where('Estado','=',1)->get();
            return view('Productos.FrmProductosEdit', [
                'ProductosEdit'     => $Productos,
                'Proveedores'       => $Proveedores,
                'Colores'           => $Colores,
                'DetalleMarcaFind'  => $DetalleMarcaFind,
                'Marcas'            => $Marcas,
                'TipoProducto'      => $TipoProducto
            ]);

        }elseif($IdTipo == 2){
              
            $Proveedores        = Proveedores::where('Estado', '=' , 1)->get();
            return view('Productos.FrmChipEdit', [
                'ProductosEdit' => $Productos,
                'Proveedores'   => $Proveedores,
                
               
                
            ]);
        }
        
    }

    public function EliminarProducto(Request $request){
        $IdProducto = $request->IdProducto;
        $Productos = Productos::find($IdProducto);
        $Productos->Estado = 0;
        if($Productos->save()){
            
            return 1;
        }
    }
    public function HabilitarProducto(Request $request){
        $IdProducto = $request->IdProducto;
        $Productos = Productos::find($IdProducto);
        $Productos->Estado = 1;
        if($Productos->save()){
            
            return 1;
        }
    }

    public function EditarChip(Request $request){
        $IdProducto         = $request->input('IdProductoEdit');
        $IdTipoProducto     = $request->input('IdTipoProducto');
   
        if($IdTipoProducto == 2){

            $IdProveedor    = $request->input('IdProveedorT');
            $Nombre         = $request->input('name');
            $Descripcion    = $request->input('DescripcionT');
            $PrecioVenta    = $request->input('PrecioVentaT');
            $PrecioCompra   = $request->input('PrecioCompraT');
            $GananciaT      = $request->input('GananciaT');

            $Producto = Productos::find($IdProducto);
            $Producto->IdProveedor      = $IdProveedor;
            $Producto->IdTipoProducto   = $IdTipoProducto;
            $Producto->NombreProductos  = $Nombre;
            $Producto->Descripcion      = $Descripcion;
            $Producto->PrecioVenta      = $PrecioVenta;
            $Producto->PrecioCompra     = $PrecioCompra;
            $Producto->Ganancia         = $GananciaT;
            
            if($Producto->save()){
                return 1;
            }

        }else{
            $IdTipoProducto = $request->input('IdTipoProducto');
            $IdProveedor    = $request->input('IdProveedorT');
            $IdMarcaT    = $request->input('IdMarcaT');
            $IdColorT    = $request->input('IdColorT');
            $Nombre         = $request->input('name');
            $Descripcion    = $request->input('DescripcionT');
            $PrecioVenta    = $request->input('PrecioVentaT');
            $PrecioCompra   = $request->input('PrecioCompraT');
            $GananciaT      = $request->input('GananciaT');
            $Producto = Productos::find($IdProducto);

            $Producto->IdProveedor      = $IdProveedor;
            $Producto->IdMarca          = $IdMarcaT;
            $Producto->IdColor          = $IdColorT;
            $Producto->IdTipoProducto   = $IdTipoProducto;
            $Producto->NombreProductos  = $Nombre;
            $Producto->Descripcion      = $Descripcion;
            $Producto->PrecioVenta      = $PrecioVenta;
            $Producto->PrecioCompra     = $PrecioCompra;
            $Producto->Ganancia         = $GananciaT;

            if($Producto->save()){
                return 1;
            }
        }
        
    }
     public function BuscadorProductos(Request $request){
        $Info = $request->Info;
        $IdSucursal = $request->IdSucursal;
        $IdTipoProducto = $request->IdTipoProducto;
        if($IdTipoProducto == 4){
            $Productos = Productos::where('NombreProductos','LIKE',"%{$Info}%")
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Productos.CardProductos',[
            'ProductosL' => $Productos
            ]);
        }else if($IdTipoProducto == 1 || $IdTipoProducto == 2 || $IdTipoProducto == 3) {
            $Productos = Productos::where('NombreProductos','LIKE',"%{$Info}%")
                                    ->where('IdTipoProducto','=', $IdTipoProducto)
                                    ->where('IdSucursal','=',$IdSucursal)->get();
            return view('Productos.CardProductos',[
            'ProductosL' => $Productos
            ]);
        }
    }

}



