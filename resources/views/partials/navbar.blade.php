<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">

    {{-- Brand --}}
    <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
      Kanha Creation
    </a>

    {{-- Mobile toggle --}}
    <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNav"
            aria-controls="mainNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Nav links --}}
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}"
             href="{{ route('home') }}">
            Home
          </a>
        </li>

        {{-- Categories Dropdown --}}
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle {{ request('category') ? 'active fw-bold' : '' }}"
             href="#"
             id="catDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="catDropdown">
            {{-- We assume $categories was passed from ProductController@index --}}
            @foreach($categories as $cat)
              <li>
                <a class="dropdown-item {{ request('category') == $cat->id ? 'active' : '' }}"
                   href="{{ route('home', ['category' => $cat->id]) }}">
                  {{ $cat->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </li>
      </ul>

      {{-- Search Form --}}
      <form class="d-flex me-3" method="GET" action="{{ route('home') }}">
        <input class="form-control me-2"
               type="search"
               name="q"
               placeholder="Search furniture…"
               value="{{ request('q') }}">
        @if(request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <button class="btn btn-outline-primary" type="submit">Search</button>
      </form>

      {{-- Right-side buttons --}}
      @auth
        {{-- Cart Button with Badge --}}
        @php $count = count(session('cart', [])); @endphp
        <a href="{{ route('cart.index') }}"
           class="btn btn-outline-secondary me-3 position-relative"
           aria-label="View cart">
          <i class="bi bi-cart3"></i>
          @if($count)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              {{ $count }}
              <span class="visually-hidden">items in cart</span>
            </span>
          @endif
        </a>

        {{-- Optional “My Orders” (only if you define the route) --}}
        @if(Route::has('orders.index'))
          <a href="{{ route('orders.index') }}"
             class="btn btn-outline-primary me-3">
            My Orders
          </a>
        @endif

        {{-- User Dropdown --}}
        <div class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-dark"
             href="#"
             id="userDropdown"
             role="button"
             data-bs-toggle="dropdown"
             aria-expanded="false">
            {{ auth()->user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dropdown-item">
                  Logout
                </button>
              </form>
            </li>
          </ul>
        </div>

      @else
        <a class="btn btn-outline-primary me-2" href="{{ route('login') }}">Login</a>
        <a class="btn btn-primary" href="{{ route('register') }}">Register</a>
      @endauth
    </div>
  </div>
</nav>