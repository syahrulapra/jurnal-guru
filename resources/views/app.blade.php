<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width='device-width', initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Jurnal Guru</title>
        <link rel="stylesheet" type="text/css" href="{{ asset('../css/bootstrap.css') }}">
        <script type="text/javascript" src="{{ asset('../js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ asset('../js/popper.js') }}"></script>
        <script type="text/javascript" src="{{ asset('../js/bootstrap.bundle.js') }}"></script>
    </head>
    <body class="vh-100 d-flex flex-column">
        @yield('body')
    </body>
</html>