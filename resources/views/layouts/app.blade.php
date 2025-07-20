<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Kanha Creation') }}</title>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

  <!-- Bootstrap CSS (CDN) -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >

  <!-- Your Custom Styles -->
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
  <div id="app">
    {{-- Primary Navbar --}}
    @include('partials.navbar')

    {{-- Hero Section (if defined in a child view) --}}
    @hasSection('hero')
      @yield('hero')
    @endif

    {{-- Main Content --}}
    <main>
      <div class="container py-4">
        @yield('content')
      </div>
    </main>

    {{-- Footer --}}
    @include('partials.footer')
  </div>

  <!-- Bootstrap JS Bundle (CDN) -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    defer
  ></script>
</body>
</html>