<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','AYNTRACK')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="{{ route('app.dashboard') }}">AYNTRACK</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="{{ route('app.dashboard') }}">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('expenses.index') }}">Expenses</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('incomes.index') }}">Incomes</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('budgets.index') }}">Budgets</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('reports.index') }}">Reports</a></li>
          </ul>

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
                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
              @endif
            @endauth
          </ul>
        </div>
      </div>
    </nav>

    <main class="container py-4">
      @include('partials.alerts')
      @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    @stack('scripts')
    </body>
  </html>
