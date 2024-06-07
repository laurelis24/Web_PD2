<!doctype html>
<html lang="lv">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PD2 - {{ $title }}</title>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous"
        >

        <script defer src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </head>

    <body>
          <nav class="navbar navbar-expand-md bg-dark sticky-top" data-bs-theme="dark">
            
            <div class="container">
                <span class="navbar-brand">
                    <img class="d-inline-block align-top" width="110px" height="50px" src="https://d29fhpw069ctt2.cloudfront.net/clipart/92991/preview/1319388002_preview_d5d5.png" alt="logo">
                </span>
                


                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navBarNav" aria-controls="navBarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                     </button>

                <div class="collapse navbar-collapse" id="navBarNav">
                    <ul class="navbar-nav fs-5">
                        <li class="nav-item">
                            <a class="nav-link" href="/">Sākumlapa</a>
                        </li>
                        @if(Auth::check())

                        <li class="nav-item">
                            <a class="nav-link" href="/manufacturers">Ražotāji</a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link" href="/cars">Automašīnas</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link" href="/categories">Kategorijas</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Beigt darbu</a>
                        </li>
                        
                        @else
                             <li class="nav-item">
                            <a class="nav-link" href="/login">Pieslēgties</a>
                        </li>
                        @endif

                    </ul>
                </div>
            </div>
        </nav>  

          <!-- class="container" -->
        <main>
            <div id="root"></div>
        </main>

        

        <footer class="text-bg-dark border-top">
            <div class="container">
                <div class="row p-4">
                    <div class="col">
                        <p class="">L. Kairo, VeA 2024</p>
                    </div>
                </div>
            </div>
        </footer>

        @viteReactRefresh
        @vite('resources/js/index.jsx')

    </body>

</html>
