<div class="sidebar-wrapper sidebar-theme">

    <nav id="sidebar"> 
        <div class="profile-info">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" width="90" height="90" title="Foto de Perfil" alt="{{ Auth::user()->name." ".Auth::user()->lastname }}">
                <h6 class="">{{ Auth::user()->name." ".Auth::user()->lastname }}</h6>
                <p class="">{!! roleUser(Auth::user()) !!}</p>
            </div>
        </div>
        <div class="shadow-bottom"></div>
        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ active(['admin', 'admin/perfil', 'admin/perfil/editar']) }}">
                <a href="{{ route('admin') }}" aria-expanded="{{ menu_expanded(['admin', 'admin/perfil', 'admin/perfil/editar']) }}" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span> Inicio</span>
                    </div>
                </a>
            </li>

            @can('users.index')
            <li class="menu {{ active('admin/usuarios', 0) }}">
                <a href="{{ route('usuarios.index') }}" aria-expanded="{{ menu_expanded('admin/usuarios', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-users"></i> Usuarios</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('banners.index')
            <li class="menu {{ active('admin/banners', 0) }}">
                <a href="{{ route('banners.index') }}" aria-expanded="{{ menu_expanded('admin/banners', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-image"></i> Banners</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('categories.index')
            <li class="menu {{ active('admin/categorias', 0) }}">
                <a href="{{ route('categorias.index') }}" aria-expanded="{{ menu_expanded('admin/categorias', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fab fa-dropbox"></i> Categor??as</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('products.index')
            <li class="menu {{ active('admin/productos', 0) }}">
                <a href="{{ route('productos.index') }}" aria-expanded="{{ menu_expanded('admin/productos', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-box"></i> Productos</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('orders.index')
            <li class="menu {{ active('admin/pedidos', 0) }}">
                <a href="{{ route('pedidos.index') }}" aria-expanded="{{ menu_expanded('admin/pedidos', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-shopping-cart"></i> Pedidos</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('payments.index')
            <li class="menu {{ active('admin/pagos', 0) }}">
                <a href="{{ route('pagos.index') }}" aria-expanded="{{ menu_expanded('admin/pagos', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-credit-card"></i> Pagos</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('coupons.index')
            <li class="menu {{ active('admin/cupones', 0) }}">
                <a href="{{ route('cupones.index') }}" aria-expanded="{{ menu_expanded('admin/cupones', 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fas fa-ticket-alt"></i> Cupones</span>
                    </div>
                </a>
            </li>
            @endcan

            @can('settings.edit')
            <li class="menu {{ active(['admin/terminos', 'admin/politicas', 'admin/contactos'], 0) }}">
                <a href="#cog" data-toggle="collapse" aria-expanded="{{ menu_expanded(['admin/terminos', 'admin/politicas', 'admin/contactos'], 0) }}" class="dropdown-toggle">
                    <div class="">
                        <span><i class="fa fa-cogs"></i> Ajustes</span>
                    </div>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled {{ submenu(['admin/terminos', 'admin/politicas', 'admin/contactos'], 0) }} }}" id="cog" data-parent="#accordionExample">
                    <li {{ submenu('admin/terminos/editar') }}>
                        <a href="{{ route('terminos.edit') }}"> T??rminos y Condiciones</a>
                    </li>
                    <li {{ submenu('admin/politicas/editar') }}>
                        <a href="{{ route('politicas.edit') }}"> Pol??ticas</a>
                    </li>
                    <li {{ submenu('admin/contactos/editar') }}>
                        <a href="{{ route('contactos.edit') }}"> Contactos</a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>

    </nav>

</div>