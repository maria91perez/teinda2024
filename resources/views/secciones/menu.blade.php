<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"
  button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span><img src="/img/carrito.png" width="80"alt="" > MI TIENDA</a>
    <link rel="stylesheet" href="../css/estilo.css" >

   
    </button>
    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        @guest
        <li class="nav-item active">
          <a class="nav-link" href="{{ route('login') }}">Acceso</a>
        </li>
        <li class="nav-item">
          &nbsp;
        </li>
        <li class="nav-item">
          <a href="{{ route('register') }}">Registro</a>
        </li>
        @else
        <li class="nav-item active">
          <a class="nav-link" href="{{route('perfiles.index')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="{{route('perfiles.index')}}">Perfiles</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('clientes.index')}}">Clientes</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('facturas.index')}}">Facturacion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Productos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pedidos</a>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link" data-toggle="dropdown" role="button" aria-expanded="false">
            User conectado: {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" data-toggle="modal" data-target="#mzodal-usuario">Mis datos</a></li>
            <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Cerrar sesion
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
          
        </li>
        <li class="dropdown">
        </li>
        @endguest
      </ul>
      
    </div>
  </div>
</nav>
