<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="icon" href="{{ asset("img/Icon.png") }}">
    {{-- @vite('resources/css/app.css') --}}
    <title>KOPMA UPNVY</title>
</head>

<body>
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg bg-success w-100 fixed-top">
        <div class="container">
            <a class="navbar-brand" href="https://www.kopma.upnyk.ac.id/">
                <img src="{{ asset("img/Logo.png") }}" alt="Kopma UPNVY" width="200px"class="d-inline-block align-text-top">
            </a>
            <nav class="navbar navbar-expand-lg bg-success">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/pendaftaran">Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/pengumuman">Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/cek-no-anggota">Cek No. Anggota</a>
                        </li>
                        <li class="nav-item">
                            <a class="vl nav-link">|</a>
                        </li>
                        <li class="nav-item">
                            <a href="/login" class="log nav-link">Login</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </nav>
    <!--Batas Navbar-->
    <!-- Konten -->
    <div class="konten">
        <center>
            <video src="{{ asset("img/bg.mp4") }}" width="50%" alt="Kopma" autoplay muted loop></video>
        </center>
    </div>
    <!-- Batas Konten -->

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>
<footer>
    <div class="fixed-bottom bg-success h-5 footer-text">
        <p>Hak Cipta &copy; {{ date('Y') }} Kopma UPN "Veteran" Yogyakata. All rights reserved.</p>
    </div>
</footer>

</html>
