<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/Estadisticas', [App\Http\Controllers\HomeController::class, 'Estadisticas'])->name('Estadisticas');

Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');


Route::group(['middleware' => 'auth'], function () {
		Route::get('icons', ['as' => 'pages.icons', 'uses' => 'App\Http\Controllers\PageController@icons']);
		Route::get('maps', ['as' => 'pages.maps', 'uses' => 'App\Http\Controllers\PageController@maps']);
		Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'App\Http\Controllers\PageController@notifications']);
		Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'App\Http\Controllers\PageController@rtl']);
		Route::get('tables', ['as' => 'pages.tables', 'uses' => 'App\Http\Controllers\PageController@tables']);
		Route::get('typography', ['as' => 'pages.typography', 'uses' => 'App\Http\Controllers\PageController@typography']);
		Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'App\Http\Controllers\PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});
Route::group(['middleware' => 'auth'], function () {
	Route::get('/VCrearProductos', [App\Http\Controllers\ProductosController::class, 'VistaCrear'])->name('VCrearProductos');
	Route::get('/VListarProductos', [App\Http\Controllers\ProductosController::class, 'VistaListar'])->name('VListarProductos');

	Route::post('/FrmCrearProducto', [App\Http\Controllers\ProductosController::class, 'FrmCrearProducto'])->name('FrmCrearProducto');
	Route::post('/FrmCrearChip', [App\Http\Controllers\ProductosController::class, 'FrmCrearChip'])->name('FrmCrearChip');
	
	
	Route::post('/GuardarProducto', [App\Http\Controllers\ProductosController::class, 'GuardarProducto'])->name('GuardarProducto');
	Route::post('/GuardarChip', [App\Http\Controllers\ProductosController::class, 'GuardarChip'])->name('GuardarChip');

	Route::post('/ListadoProductos', [App\Http\Controllers\ProductosController::class, 'ListadoProductos'])->name('ListadoProductos');
	//Route::post('/FrmAgregarFoto', [App\Http\Controllers\ProductosController::class, 'MdAgregarFotos'])->name('FrmAgregarFoto');
	Route::post('/FrmAgregarFoto', [App\Http\Controllers\ProductosController::class, 'MdAgregarFotos'])->name('FrmAgregarFoto');

	Route::post('/FrmProductosEdit', [App\Http\Controllers\ProductosController::class, 'MdProductosEdit'])->name('FrmProductosEdit');
	
	Route::post('/GuardarImagen', [App\Http\Controllers\ProductosController::class, 'GuardarImagen'])->name('GuardarImagen');

	Route::post('/EliminarProd', [App\Http\Controllers\ProductosController::class, 'EliminarProducto'])->name('EliminarProd');
	Route::post('/HabilitarProd', [App\Http\Controllers\ProductosController::class, 'HabilitarProducto'])->name('HabilitarProd');

	Route::post('/ModificarChip', [App\Http\Controllers\ProductosController::class, 'EditarChip'])->name('ModificarChip');
	Route::post('/ListarMarca', [App\Http\Controllers\ProductosController::class, 'ListarMarca'])->name('ListarMarca');
	
	// Ver Imagenes
	Route::get('/VerImagen/{NombreImagen}', [App\Http\Controllers\ProductosController::class, 'VerImagen'])->name('VerImagen');
	// Buscador Productos
	Route::post('/BuscadorProductosPro', [App\Http\Controllers\ProductosController::class , 'BuscadorProductos'])->name('BuscadorProductosPro');

});
Route::group(['middleware' => 'auth'], function () {
	Route::get('/VListarUsuarios', [App\Http\Controllers\UserController::class, 'VistaListar'])->name('VListarUsuarios');
	Route::post('/FrmCreateUser', [App\Http\Controllers\UserController::class, 'ViewFrmCreateUser'])->name('FrmCreateUser');
	Route::post('/CreateUser', [App\Http\Controllers\UserController::class, 'CreateUser'])->name('CreateUser');
	Route::post('/InfoUser', [App\Http\Controllers\UserController::class, 'InfoUser'])->name('InfoUser');
	Route::post('/DeleteUser', [App\Http\Controllers\UserController::class, 'DeleteUser'])->name('DeleteUser');
	Route::post('/HabilitarUser', [App\Http\Controllers\UserController::class, 'HabilitarUser'])->name('HabilitarUser');
	Route::post('/FrmModificarUser', [App\Http\Controllers\UserController::class, 'ViewFrmModificarUser'])->name('FrmModificarUser');
	Route::post('/EditUser', [App\Http\Controllers\UserController::class, 'EditUser'])->name('EditUser');
	
	
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/VListTypeUser', [App\Http\Controllers\TipoUsuarioController::class , 'VistaListar'])->name('VListTypeUser');
	Route::post('/FrmCreateTypeUser', [App\Http\Controllers\TipoUsuarioController::class , 'VFrmCreateTypeUser'])->name('FrmCreateTypeUser');
	Route::post('/CreateTypeUser', [App\Http\Controllers\TipoUsuarioController::class , 'FCreateTypeUser'])->name('CreateTypeUser');
	Route::post('/DeleteTypeUser', [App\Http\Controllers\TipoUsuarioController::class , 'DeleteTypeUser'])->name('DeleteTypeUser');
	Route::post('/HabilitarTypeUser', [App\Http\Controllers\TipoUsuarioController::class , 'ControHabilitarTypeUser'])->name('HabilitarTypeUser');
	Route::post('/FrmModificarTypeUser', [App\Http\Controllers\TipoUsuarioController::class , 'VFrmModificarTypeUser'])->name('FrmModificarTypeUser');
	Route::post('/ModificarTypeUser', [App\Http\Controllers\TipoUsuarioController::class , 'ContoModificarTypeUser'])->name('ModificarTypeUser');
	
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/VListarProveedores', [App\Http\Controllers\ProveedoresController::class , 'ViewListProvider'])->name('VListarProveedores');
	Route::post('/FrmCreateProviders', [App\Http\Controllers\ProveedoresController::class , 'VFrmCreateProviders'])->name('FrmCreateProviders');
	Route::post('/CrearProveedor', [App\Http\Controllers\ProveedoresController::class , 'ControCrearProveedor'])->name('CrearProveedor');
	Route::post('/FrmModificarProviders', [App\Http\Controllers\ProveedoresController::class , 'VFrmModificarProviders'])->name('FrmModificarProviders');
	Route::post('/ModificarProveedores', [App\Http\Controllers\ProveedoresController::class , 'ModificarProveedores'])->name('ModificarProveedores');
	Route::post('/TblListMarcas', [App\Http\Controllers\ProveedoresController::class , 'VistaAgregarMarca'])->name('TblListMarcas');
	Route::post('/AgregarDetalleMarca', [App\Http\Controllers\ProveedoresController::class , 'AgregarMarcaProveedor'])->name('AgregarDetalleMarca');
	Route::post('/QuitarDetalleMarca', [App\Http\Controllers\ProveedoresController::class , 'QuitarMarcaProveedor'])->name('QuitarDetalleMarca');
	Route::post('/DeleteProveedor', [App\Http\Controllers\ProveedoresController::class , 'DeleteProveedor'])->name('DeleteProveedor');
	
	Route::post('/HabilitarProveedor', [App\Http\Controllers\ProveedoresController::class , 'HabilitarProveedor'])->name('HabilitarProveedor');
	
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/RListarMarcas', [App\Http\Controllers\MarcasController::class , 'VListarMarcas'])->name('RListarMarcas');
	Route::post('/FrmCreateMarca', [App\Http\Controllers\MarcasController::class , 'VFrmCreateMarcas'])->name('FrmCreateMarca');
	Route::post('/CrearMarca', [App\Http\Controllers\MarcasController::class , 'ControCrearMarca'])->name('CrearMarca');
	Route::post('/EditarMarca', [App\Http\Controllers\MarcasController::class , 'EditarMarca'])->name('EditarMarca');
	Route::post('/FrmModificarMarca', [App\Http\Controllers\MarcasController::class , 'VFrmModificarMarcas'])->name('FrmModificarMarca');
	Route::post('/EliminarMarca', [App\Http\Controllers\MarcasController::class , 'EliminarMarca'])->name('EliminarMarca');
	Route::post('/HabilitarMarca', [App\Http\Controllers\MarcasController::class , 'HabilitarMarca'])->name('HabilitarMarca');
	
	

});

Route::group(['middleware' => 'auth'], function () {
	Route::get('/VListarColores', [App\Http\Controllers\ColorController::class , 'VListarColores'])->name('VListarColores');
	Route::post('/FrmCrearColor', [App\Http\Controllers\ColorController::class , 'VFrmCrearColor'])->name('FrmCrearColor');
	Route::post('/CrearColor', [App\Http\Controllers\ColorController::class , 'ControCrearColor'])->name('CrearColor');
	Route::post('/FrmModificarColor', [App\Http\Controllers\ColorController::class , 'VFrmModificarColor'])->name('FrmModificarColor');
	Route::post('/EditarColor', [App\Http\Controllers\ColorController::class , 'EditarColor'])->name('EditarColor');
	Route::post('/EliminarColor', [App\Http\Controllers\ColorController::class , 'EliminarColor'])->name('EliminarColor');
	Route::post('/HabilitarColor', [App\Http\Controllers\ColorController::class , 'HabilitarColor'])->name('HabilitarColor');
	
});
// Compras
Route::group(['middleware' => 'auth'], function () {
	Route::get('/VGenerarCompra', [App\Http\Controllers\ComprasController::class , 'VGenerarCompra'])->name('VGenerarCompra');
	Route::get('/ListarCompras', [App\Http\Controllers\ComprasController::class , 'ListarCompras'])->name('ListarCompras');
	Route::post('/ListadoProductosCompra', [App\Http\Controllers\ComprasController::class , 'ListadoProductosCompra'])->name('ListadoProductosCompra');
	Route::post('/BuscadorProductosCompra', [App\Http\Controllers\ComprasController::class , 'BuscadorProductos'])->name('BuscadorProductosCompra');
	Route::post('/ModalAgregarImeis', [App\Http\Controllers\ComprasController::class , 'ModalAgregarImeis'])->name('ModalAgregarImeis');
	Route::post('/AgregarImeis', [App\Http\Controllers\ComprasController::class , 'AgregarImeis'])->name('AgregarImeis');
	Route::post('/GenerarCompra', [App\Http\Controllers\ComprasController::class , 'GenerarCompra'])->name('GenerarCompra');
	// Rutas de Filtrado de Compras
	// Filtrado Por Fechas
	Route::post('/FiltroFecha', [App\Http\Controllers\ComprasController::class , 'FiltroFecha'])->name('FiltroFecha');
	Route::post('/FiltroEntreFecha', [App\Http\Controllers\ComprasController::class , 'FiltroEntreFecha'])->name('FiltroEntreFecha');
	Route::post('/FiltroMes', [App\Http\Controllers\ComprasController::class , 'FiltroMes'])->name('FiltroMes');
	Route::post('/FiltroYear', [App\Http\Controllers\ComprasController::class , 'FiltroYear'])->name('FiltroYear');
	
	// Imprimir DetalleCompras
	Route::get('/PdfCompras/{IdCompra}', [App\Http\Controllers\ComprasController::class , 'PdfCompras'])->name('PdfCompras');
	// Listar Detalle
	Route::post('/VDetalleCompra', [App\Http\Controllers\ComprasController::class , 'VDetalleCompra'])->name('VDetalleCompra');
		// Ver Imeis Ya sea vendidos o comprados por producto
	
		
});
// Ventas
Route::group(['middleware' => 'auth'], function () {
	Route::get('/VGenerarVenta', [App\Http\Controllers\VentasController::class , 'VGenerarVenta'])->name('VGenerarVenta');
	Route::post('/SeleccionarCliente', [App\Http\Controllers\VentasController::class , 'SeleccionarCliente'])->name('SeleccionarCliente');
	Route::post('/ListadoProductosVenta', [App\Http\Controllers\VentasController::class , 'ListadoProductosVenta'])->name('ListadoProductosVenta');
	// Buscador Productos
	Route::post('/BuscadorProductosVenta', [App\Http\Controllers\VentasController::class , 'BuscadorProductosVenta'])->name('BuscadorProductosVenta');
	Route::post('/ModalSeleccionarImeisVenta', [App\Http\Controllers\VentasController::class , 'ModalSeleccionarImeisVenta'])->name('ModalSeleccionarImeisVenta');
	// Vender Imies
	Route::post('/VenderImeis', [App\Http\Controllers\VentasController::class , 'VenderImeis'])->name('VenderImeis');
	// Generar Ventas
	Route::post('/GenerarVenta', [App\Http\Controllers\VentasController::class , 'GenerarVenta'])->name('GenerarVenta');
	// Vista ListadoVentas 
	Route::get('/VListarVentas', [App\Http\Controllers\VentasController::class , 'VListarVentas'])->name('VListarVentas');
	// Filtros De Fechas
	Route::post('/FiltroFechaVenta', [App\Http\Controllers\VentasController::class , 'FiltroFechaVenta'])->name('FiltroFechaVenta');
	Route::post('/FiltroEntreFechaVentas', [App\Http\Controllers\VentasController::class , 'FiltroEntreFechaVentas'])->name('FiltroEntreFechaVentas');
	Route::post('/FiltroPorMesVentas', [App\Http\Controllers\VentasController::class , 'FiltroPorMesVentas'])->name('FiltroPorMesVentas');
	Route::post('/FiltroYearVenta', [App\Http\Controllers\VentasController::class , 'FiltroYearVenta'])->name('FiltroYearVenta');
	// Ver Detalle Venta
	Route::post('/VDetalleVenta', [App\Http\Controllers\VentasController::class , 'VDetalleVenta'])->name('VDetalleVenta');
	
	Route::get('/PDFVentas/{IdVenta}', [App\Http\Controllers\VentasController::class , 'PDFVentas'])->name('PDFVentas');
	// Generar Vista Corte 
	Route::get('/VGenerarCorte', [App\Http\Controllers\VentasController::class , 'VGenerarCorte'])->name('VGenerarCorte');
	// Generar Corte 
	Route::post('/CorteDia', [App\Http\Controllers\VentasController::class , 'CorteDia'])->name('CorteDia');
	// Ver Detalle del Producto
	
	Route::post('/VerDetalleProducto', [App\Http\Controllers\VentasController::class , 'VerDetalleProducto'])->name('VerDetalleProducto');
});
// Imeis Vendidos Y Comprados
Route::group(['middleware' => 'auth'], function () {
	Route::post('/VerImeis', [App\Http\Controllers\Imei::class , 'VerImeisVendidos'])->name('VerImeis');
	Route::post('/VerImeisComprados', [App\Http\Controllers\Imei::class , 'VerImeisComprados'])->name('VerImeisComprados');
	
});
// Clientes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/VListarClientes', [App\Http\Controllers\ClientesController::class , 'VListarClientes'])->name('VListarClientes');
	Route::post('/FrmCrearClientes', [App\Http\Controllers\ClientesController::class , 'FrmCrearClientes'])->name('FrmCrearClientes');
	Route::post('/FrmEditCliente', [App\Http\Controllers\ClientesController::class , 'FrmEditCliente'])->name('FrmEditCliente');
	Route::post('/CrearCliente', [App\Http\Controllers\ClientesController::class , 'CrearCliente'])->name('CrearCliente');
	Route::post('/EditarCliente', [App\Http\Controllers\ClientesController::class , 'EditarCliente'])->name('EditarCliente');
	
	Route::post('/EliminarCliente', [App\Http\Controllers\ClientesController::class , 'EliminarCliente'])->name('EliminarCliente');
	Route::post('/HabilitarCliente', [App\Http\Controllers\ClientesController::class , 'HabilitarCliente'])->name('HabilitarCliente');

});
// Sucursales
Route::group(['middleware' => 'auth'], function () {
	Route::get('/VListarSucursales', [App\Http\Controllers\SucursalController::class , 'VListarSucursales'])->name('VListarSucursales');
	Route::post('/FrmCrearSucursal', [App\Http\Controllers\SucursalController::class , 'FrmCrearSucursal'])->name('FrmCrearSucursal');
	Route::post('/FrmEditarSucursal', [App\Http\Controllers\SucursalController::class , 'FrmEditarSucursal'])->name('FrmEditarSucursal');
	
	Route::post('/CrearSucursal', [App\Http\Controllers\SucursalController::class , 'CrearSucursal'])->name('CrearSucursal');
	Route::post('/EditarSucursal', [App\Http\Controllers\SucursalController::class , 'EditarSucursal'])->name('EditarSucursal');
	
	Route::post('/EliminarSucursal', [App\Http\Controllers\SucursalController::class , 'EliminarSucursal'])->name('EliminarSucursal');
	Route::post('/HabilitarSucursal', [App\Http\Controllers\SucursalController::class , 'HabilitarSucursal'])->name('HabilitarSucursal');
	
});
