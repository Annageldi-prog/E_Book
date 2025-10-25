<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E_books</title>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-icons.min.css') }}" rel="stylesheet">
    <script type="text/javascript" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>
<body class="bg-dark">
<header class="p-3 text-bg-dark">
    <div class="container-lg">
        <div class="d-flex "><a href="/" class="d-flex align-items-center mb-lg-0 text-white text-decoration-none">
            </a>
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <i class="bi-book-fill h1 pe-3 text-start justify-content-center"></i>
                <div class="text-start pe-3 h3 pt-2 text-info">E_Books</div>
                <li><a href="/" class="nav-link px-2 text-white pt-3">Baş sahypa</a></li>
                <li><a href="/product" class="nav-link px-2 text-white pt-3">Kitaplar</a></li>
            </ul>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search"><input type="search"
                                                                                       class="form-control form-control-dark text-bg-dark"
                                                                                       placeholder="Search..."
                                                                                       aria-label="Search"></form>
            <div class="text-end">
                <button type="button" class="btn btn-outline-light me-2">Login</button>
                <button type="button" class="btn btn-warning">Sign-up</button>
            </div>
        </div>
    </div>
    <hr class="text-white display-1">
</header>

@yield('main_content')
</body>
</html>
