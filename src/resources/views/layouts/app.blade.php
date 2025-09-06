<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>mogitate</title>
        <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
        <link rel="stylesheet" href="{{asset('css/common.css')}}">
        @yield('css')

        <!-- Webフォント -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Aref+Ruqaa&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

        <!-- Bootstrap 4 CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>

    <body>
        <header class="header">
            <div class="header__inner">
                <a class="header__logo" href="">
                    mogitate
                </a>
            </div>
        </header>

        <main>
            @yield('content')
        </main>

    </body>
</html>