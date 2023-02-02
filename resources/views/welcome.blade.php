<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IntexSoft Test App</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            p {
                margin-bottom: 0px;
                margin-top: 0px
            }
            .table td, .table th{
                vertical-align: middle;
            }
        </style>
    </head>
    <body class="antialiased container">
        <header class="row" style="display: flex; gap: 1em; margin: 1em 0">
            <a class="btn btn-primary" href="/" role="button">Организации</a>
            <a class="btn btn-primary" href="/users" role="button">Сотрудники</a>
            <a class="btn btn-primary" href="/xml" role="button">Upload xml</a>
        </header>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>
