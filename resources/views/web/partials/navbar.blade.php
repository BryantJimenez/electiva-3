<header class="@if(request()->is('finalizar-compra') || request()->is('tienda') || is_int(strpos(request()->path(), 'productos/'))) header_in clearfix @else header clearfix element_to_stick @endif">
    <div class="container">
        <div id="logo">
            <a href="{{ route('home') }}">
                @if(!request()->is('finalizar-compra') && !request()->is('tienda') && !is_int(strpos(request()->path(), 'productos/')))
                <img src="{{ asset('/web/img/logo.svg') }}" width="162" height="35" title="Logo" alt="Logo" class="logo_normal">
                @endif
                <img src="{{ asset('/web/img/logo_sticky.svg') }}" width="162" height="35"  title="Logo" alt="Logo" class="logo_sticky">
            </a>
        </div>
        <div class="layer"></div>
        @guest
        <ul id="top_menu">
            <li><a href="{{ route('login') }}" class="login">Iniciar Sesión</a></li>
        </ul>
        @else
        <ul id="top_menu" class="drop_user">
            <li>
                <div class="dropdown user clearfix">
                    <a href="javascript:void(0);" data-toggle="dropdown">
                        <figure>
                            <img src="{{ image_exist('/admins/img/users/', Auth::user()->photo, true) }}" title="Foto de Perfil" alt="{{ Auth::user()->name." ".Auth::user()->lastname }}">
                        </figure>
                        <span>{{ Auth::user()->name." ".Auth::user()->lastname }}</span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="dropdown-menu-content">
                            <ul>
                                @can('dashboard')
                                <li><a href="{{ route('admin') }}"><i class="icon_key"></i>Panel Administrativo</a></li>
                                @endcan
                                <li><a href="{{ route('web.profile') }}"><i class="icon_cog"></i>Mi Cuenta</a></li>
                                <hr class="w-75 my-0">
                                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon_key"></i>Cerrar Sesión</a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        @endguest
        <a href="#0" class="open_close">
            <i class="icon_menu"></i><span>Menu</span>
        </a>
        <nav class="main-menu">
            <div id="header_menu">
                <a href="#0" class="open_close">
                    <i class="icon_close"></i><span>Menu</span>
                </a>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('/web/img/logo.svg') }}" width="162" height="35"  title="Logo" alt="Logo">
                </a>
            </div>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Inicio</a>
                </li>
                <li>
                    <a href="{{ route('web.categories') }}">Categorías</a>
                </li>
                <li>
                    <a href="{{ route('web.shop') }}">Tienda</a>
                </li>
                <li>
                    <a href="{{ route('web.cart') }}">Carrito</a>
                </li>
            </ul>
        </nav>
    </div>
</header>