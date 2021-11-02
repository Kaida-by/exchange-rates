<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Currencies</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script defer src="{{ asset('js/app.js') }}"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar bg-light mr-auto ml-auto mt-4 mb-4 justify-content-between w-50">
            <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
            <form class="form-inline" action="/">
                @csrf
                <input class="form-control" name="search" type="search" placeholder="Search" aria-label="Search"
                       value="{{ request('search') }}">
                <input class="form-control" type="date" name="date" value="{{ request('date') }}">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </nav>
        <div class="container">
            @yield('content')
        </div>
    </div>
</body>
</html>
