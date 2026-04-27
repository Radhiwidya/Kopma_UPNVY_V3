<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/Icon.png') }}">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>

<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(135deg, #1abc9c, #16a085, #27ae60, #2ecc71);
        background-size: 400% 400%;
        animation: gradientBackground 10s ease infinite;
    }

    @keyframes gradientBackground {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }
</style>

<body>
    @yield('content')
</body>

</html>
