<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <!-- Container wrapper -->
  <div class="container">
    <!-- Navbar brand -->
    <a class="navbar-brand me-2" href="https://mdbgo.com/">
      <img
        src="https://mdbcdn.b-cdn.net/img/logo/mdb-transaprent-noshadows.webp"
        height="16"
        alt="MDB Logo"
        loading="lazy"
        style="margin-top: -1px;"
      />
    </a>

    <!-- Toggle button -->
    <button
      data-mdb-collapse-init
      class="navbar-toggler"
      type="button"
      data-mdb-target="#navbarButtonsExample"
      aria-controls="navbarButtonsExample"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>

    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarButtonsExample">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/lession">Lessions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/game">Game</a>
        </li>
      </ul>
      
      <!-- Left links -->
        
        
        @if(Auth::check())
        <div class="d-flex align-items-center">
        <a  data-mdb-ripple-init href="/profile" type="button" class="btn btn-link px-3 me-2">
          {{Auth::user()->UserName}}
        </a>
        <a  data-mdb-ripple-init href='/logout' class="btn btn-primary me-3">
          Log out
        </a>
        
         </div>

        @else
        <div  class="d-flex align-items-center">
        <a href="/login" data-mdb-ripple-init class="btn btn-link px-3 me-2">
          Login
        </a>
        <a href="/register" data-mdb-ripple-init type="button" class="btn btn-primary me-3">
          Sign up for free
        </a>
       
      </div>
        @endif()
      
      
    </div>
    <!-- Collapsible wrapper -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->