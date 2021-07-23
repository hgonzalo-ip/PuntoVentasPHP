<div class="sidebar">
    <div class="sidebar-wrapper bg-info">
        <div class="logo">
          
            <h3 class="mt-2 ml-5">{{ __(auth()->user()->Sucursales->Nombre) }}</h3>
           
        </div>
        <ul class="nav">
           
           @if(auth()->user()->IdTipoUsuario == 1)
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <a href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
               <!--Ventas-->
               <li>
                <a data-toggle="collapse" href="#Ventas" aria-expanded="true">
                    <i class="fas fa-cart-plus"></i>
                    <span class="nav-link-text" ><h5>{{ __('Ventas') }}</h5></span>
                    <b class="caret mt-1"></b>
                </a>
                
                <div class="collapse show" id="Ventas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'GenerarVenta') class="active " @endif>
                            <a href="{{ route('VGenerarVenta')  }}">
                            <i class="fas fa-money-bill-alt"></i>
                                <p>{{ __('Generar Nueva Venta') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'ListadoVentas') class="active " @endif>
                            <a href="{{ route('VListarVentas')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Listar Ventas') }}</p>
                            </a>
                        </li>
                      
                      
                    </ul>
                </div>
            </li>
            <!--Fin Ventas-->
            <!--Compras-->
            <li>
                <a data-toggle="collapse" href="#Compras" aria-expanded="true">
                <i class="fas fa-shopping-bag"></i>
                    <span class="nav-link-text" ><h5>{{ __('Compras') }}</h5></span>
                    <b class="caret mt-1"></b>
                </a>
                
                <div class="collapse show" id="Compras">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'GenerarCompra') class="active " @endif>
                            <a href="{{ route('VGenerarCompra')  }}">
                            <i class="fas fa-money-bill-alt"></i>
                                <p>{{ __('Generar Compra') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'Listado') class="active " @endif>
                            <a href="{{ route('ListarCompras')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Listar Compras') }}</p>
                            </a>
                        </li>
                      
                    </ul>
                </div>
            </li>
            <!--Fin Compras-->
            <!--Productos-->
            <li>
                <a data-toggle="collapse" href="#Productos" aria-expanded="true">
                <i class="fab fa-product-hunt"></i>
                    <span class="nav-link-text" ><h5>{{ __('Productos') }}</h5></span>
                    <b class="caret mt-1"></b>
                </a>
                
                <div class="collapse show" id="Productos">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'CrearProducto') class="active " @endif>
                            <a href="{{ route('VCrearProductos')  }}">
                            <i class="fas fa-plus"></i>
                                <p>{{ __('Crear Producto') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'Listado') class="active " @endif>
                            <a href="{{ route('VListarProductos')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Listar Productos') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'Colores') class="active " @endif>
                            <a href="{{ route('VListarColores')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Listar Colores') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--Fin Productos-->
            <li @if ($pageSlug == 'Sucursales') class="active " @endif>
                            <a href="{{ route('VListarSucursales')  }}">
                            <i class="fas fa-user-plus"></i>
                                <p>{{ __('Sucursales') }}</p>
                            </a>
             </li>
                <!--Productos-->
                <li>
                <a data-toggle="collapse" href="#Clientes" aria-expanded="true">
                <i class="fas fa-users"></i>
                    <span class="nav-link-text" ><h5>{{ __('Clientes') }}</h5></span>
                    <b class="caret mt-1"></b>
                </a>
                
                <div class="collapse show" id="Clientes">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'ListadoClientes') class="active " @endif>
                            <a href="{{ route('VListarClientes')  }}">
                            <i class="fas fa-user-plus"></i>
                                <p>{{ __('Crear Clientes') }}</p>
                            </a>
                        </li>
                     
                      
                    </ul>
                </div>
            </li>
            <!--Fin Productos-->
            <!--Inicio Usuarios-->
            <li>
                <a data-toggle="collapse" href="#Usuarios" aria-expanded="true">
                <i class="fas fa-user-circle"></i>
                    <span class="nav-link-text" ><h5>{{ __('Usuarios') }}</h5></span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="Usuarios">
                    <ul class="nav pl-4">
                    <li @if ($pageSlug == 'User') class="active " @endif>
                        <a href="{{ route('VListarUsuarios') }}">
                        <i class="fas fa-plus"></i>
                            <p>{{ __('Usuarios') }}</p>
                        </a>
                    </li>
                        <li @if ($pageSlug == 'TypeUser') class="active " @endif>
                            <a href="{{ route('VListTypeUser')  }}">
                            <i class="fas fa-street-view"></i>
                                <p>{{ __('Tipos De Usuario') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--FinUsuarios-->
               <!--Inicio Usuarios-->
               <li>
                <a data-toggle="collapse" href="#Proveedores" aria-expanded="true">
                <i class="fas fa-truck"></i>
                    <span class="nav-link-text" ><h5>{{ __('Proveedores') }}</h5></span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse show" id="Proveedores">
                    <ul class="nav pl-4">
                    <li @if ($pageSlug == 'Proveedores') class="active " @endif>
                        <a href="{{ route('VListarProveedores') }}">
                        <i class="fas fa-ambulance"></i>
                            <h5>{{ __('Proveedores') }}</h5>
                        </a>
                    </li>
                    <li @if ($pageSlug == 'Proveedores') class="active " @endif>
                        <a href="{{ route('RListarMarcas') }}">
                        <i class="fas fa-copyright"></i>
                            <h5>{{ __('Marcas') }}</h5>
                        </a>
                    </li>
                    
                    </ul>
                </div>
            </li>
            <!--FinUsuarios-->

        </ul>
        @elseif(auth()->user()->IdTipoUsuario == 2)
               <!--Ventas-->
               <li>
                <a data-toggle="collapse" href="#Ventas" aria-expanded="true">
                    <i class="fas fa-cart-plus"></i>
                    <span class="nav-link-text" ><h5>{{ __('Ventas') }}</h5></span>
                    <b class="caret mt-1"></b>
                </a>
                
                <div class="collapse show" id="Ventas">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'GenerarVenta') class="active " @endif>
                            <a href="{{ route('VGenerarVenta')  }}">
                            <i class="fas fa-money-bill-alt"></i>
                                <p>{{ __('Generar Nueva Venta') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'ListadoVentas') class="active " @endif>
                            <a href="{{ route('VListarVentas')  }}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <p>{{ __('Listar Ventas') }}</p>
                            </a>
                        </li>
                      
                    </ul>
                </div>
            </li>
            <!--Fin Ventas-->
        @endif
    </div>
</div>
