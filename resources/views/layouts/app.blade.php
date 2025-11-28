<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','AYNTRACK')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css','resources/css/custom-auth.css'])
    @stack('styles')
  </head>
  <body>
    <nav class="navbar navbar-expand-lg ayn-navbar">
      <div class="container">
        <a class="navbar-brand" href="{{ route('app.dashboard') }}">
          <img src="{{ asset('public\build\image\1.png') }}" alt="AYNLYTICS" style="height:42px;margin-right:8px;vertical-align:middle;">
          <span class="align-middle">AYNLYTICS</spangit>
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

          <ul class="navbar-nav ms-auto">
            @auth
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userMenu" data-bs-toggle="dropdown">{{ auth()->user()->name }}</a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                  <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                  @if(auth()->user()->isAdmin())
                    <li><a class="dropdown-item" href="{{ route('admin.users.index') }}">Admin</a></li>
                  @endif
                  <li>
                    <form method="POST" action="{{ route('logout') }}">@csrf<button class="dropdown-item">Logout</button></form>
                  </li>
                </ul>
              </li>
            @else
              <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
              @if (Route::has('register'))
                <li class="nav-item"><a class="nav-link ayn-cta" href="{{ route('register') }}">Register</a></li>
              @endif
            @endauth
          </ul>
        </div>

        <div id="menu" class="menu-open hidden">
            <nav class="menu-nav">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z">
        </path>
    </svg>
    <span>Dashboard</span>
</a>
                <!-- Set Goals -->
    <a class="nav-link menu-item" 
       href="" 
       onclick="setActive(1)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>Set Goals</span>
    </a>

    <!-- Analytics -->
    <a class="nav-link menu-item" 
       href="" 
       onclick="setActive(2)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
        </svg>
        <span>Analytics</span>
    </a>

    <!-- Budget -->
    <a class="nav-link menu-item" 
       href="{{ route('budgets.index') }}" 
       onclick="setActive(3)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span>Budget</span>
    </a>

    <!-- Expenses -->
    <a class="nav-link menu-item" 
       href="{{ route('expenses.index') }}" 
       onclick="setActive(4)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7l6 6 4-4 8 8"/>
        </svg>
        <span>Expenses</span>
    </a>

    <!-- Categories -->
    <a class="nav-link menu-item" 
       href="{{ route('categories.index') }}" 
       onclick="setActive(5)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M3 11l8.586 8.586a2 2 0 002.828 0L21 13l-8-8H5a2 2 0 00-2 2v4z"/>
        </svg>
        <span>Categories</span>
    </a>

    <!-- Income -->
    <a class="nav-link menu-item" 
       href="{{ route('incomes.index') }}" 
       onclick="setActive(6)">
        <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>Income</span>
    </a>
    <a href="{{ route('profile.edit') }}" class="menu-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z"></path>
    </svg>
    <span>Edit Profile</span>
</a>
            </nav>
        </div>
    </header>

<main class="container py-4">
  @include('partials.alerts')
  @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    function toggleMenu() {
        const menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    }
</script>
@stack('scripts')
</body>

</html>
