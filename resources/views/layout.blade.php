<!doctype html>
<html lang="lv">

    <head>
        <meta charset="utf-8">
        <title>PD 2 - {{ $title }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>

    <body>

        <nav class="navbar navbar-expand-md bg-primary mb-3" data-bs-theme="dark">
            <div class="container">
                <span class="navbar-brand mb-0 h1">PD2</span>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Sākumlapa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/manufacturers">Izgatavotaji</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="container">
            <div class="row">
                <div class="col">

                @yield('content')

                </div>
            </div>
        </main>

        <footer class="text-bg-dark mt-3">
            <div class="container">
                <div class="row py-5">
                    <div class="col">
                        L. Kairo, 2024
                    </div>
                </div>
            </div>
        </footer>

    </body>

</html>
