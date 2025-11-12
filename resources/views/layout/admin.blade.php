<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | Admin Panel</title>

    <link rel="icon" href="{{ asset('image/favicon.ico') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <style>
        body {
            background: radial-gradient(circle at top left, #1e1e2f, #121212);
            color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .custom-navbar {
            position: sticky;
            top: 0;
            z-index: 1050;
            background: linear-gradient(135deg, #1e1e2f, #3a3a5c);
            color: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.5);
            transition: 0.4s;
            backdrop-filter: blur(4px);
        }

        .custom-navbar a {
            color: #fff;
            transition: color 0.3s;
        }

        .custom-navbar a:hover {
            color: #ffc107;
        }

        .navbar-scrolled {
            background: linear-gradient(135deg, #2a2a40, #1b1b2f);
            box-shadow: 0 3px 14px rgba(0,0,0,0.45);
        }

        .container-xl {
            padding-top: 80px;
            padding-bottom: 50px;
        }
    </style>
</head>

<body>

{{-- Navbar --}}
<header class="custom-navbar p-2 shadow-sm">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap">
        <a href="{{ route('home') }}" class="d-flex align-items-center text-white text-decoration-none mb-2 mb-md-0">
            <i class="bi bi-book-fill h3 pe-2 text-light"></i>
            <span class="h4 mb-0">Admin Panel</span>
        </a>

        <ul class="nav me-auto ms-4 mb-2 mb-md-0">
            <li><a href="{{ route('home') }}" class="nav-link px-3 fw-semibold">@lang('messages.home')</a></li>
        </ul>

        <div class="d-flex align-items-center gap-2">
            @auth
                <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">@lang('messages.logout')</button>
                </form>
            @else
                <a href="{{ route('admin.login') }}" class="btn btn-outline-light btn-sm">@lang('messages.login')</a>
            @endauth

            {{-- Языковой селектор --}}
            <form action="{{ route('set.language') }}" method="POST">
                @csrf
                <select name="locale" class="form-select form-select-sm bg-dark text-light border-light"
                        onchange="this.form.submit()">
                    <option value="tm" {{ app()->getLocale() === 'tm' ? 'selected' : '' }}>TM</option>
                    <option value="en" {{ app()->getLocale() === 'en' ? 'selected' : '' }}>EN</option>
                    <option value="ru" {{ app()->getLocale() === 'ru' ? 'selected' : '' }}>RU</option>
                </select>
            </form>
        </div>
    </div>
</header>

{{-- Контент --}}
<div class="container-xl">
    @yield('content')
</div>

<script>
    window.addEventListener('scroll', () => {
        const navbar = document.querySelector('.custom-navbar');
        if (window.scrollY > 20) navbar.classList.add('navbar-scrolled');
        else navbar.classList.remove('navbar-scrolled');
    });
</script>

</body>
</html>
