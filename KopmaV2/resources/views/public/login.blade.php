<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset("img/Icon.png") }}">
    <title>SI-KOPMA UPNVY</title>

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

        .floating-error {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 300px;
            z-index: 9999;
        }

        .alert-box {
            background-color: #ffd9d5d3;
            border-left: 5px solid #f44336;
            color: #ff0000;
            padding: 12px 16px;
            margin-bottom: 10px;
            border-radius: 5px;
            font-size: 14px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: slideDown 0.4s ease-out;
        }

        @keyframes slideDown {
            from {
                transform: translateX(-20px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
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

        .login-container {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 300px;
            box-shadow: 15px 15px 15px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            text-align: center;
        }

        .login-container h2 {
            margin-bottom: 50px;
            color: #fff;
        }

        .input-group {
            position: relative;
            margin: 30px 0;
        }

        .input-group input {
            width: calc(100% - 20px);
            padding: 12px 10px;
            border: none;
            border-radius: 5px;
            outline: none;
            font-size: 16px;
            background: rgba(255, 255, 255, 0.8);
            color: #333;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .input-group input:focus {
            background: rgba(255, 255, 255, 1);
            box-shadow: 0 10px 10px rgba(0, 0, 0, 0.2);
        }

        .input-group label {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #777;
            pointer-events: none;
            transition: all 0.3s ease;
        }

        .input-group input:focus+label,
        .input-group input:valid+label {
            top: -10px;
            left: 10px;
            font-size: 12px;
            color: #000;
        }

        .input-group .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #777;
        }

        /* ===== LUPA PASSWORD STYLE ===== */
        .forgot-password {
            text-align: right;
            margin-top: -20px;
            margin-bottom: 20px;
        }

        .forgot-password a {
            font-size: 13px;
            color: #fff;
            text-decoration: none;
            opacity: 0.8;
            transition: 0.3s;
        }

        .forgot-password a:hover {
            opacity: 1;
            text-decoration: underline;
        }

        button {
            background: #059212;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s ease;
            padding: 10px;
            margin: 30px 0px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
        }

        button[name='user'] {
            margin-top: 5px;
            margin-bottom: 15px;
        }

        button[name='admin'] {
            margin-bottom: 5px;
        }

        button:hover {
            background: rgba(255, 255, 255, 0.5);
            color: #059212;
        }

        @media (max-width: 600px) {
            .login-container {
                padding: 15px;
            }

            .input-group input {
                padding: 10px 8px;
                font-size: 14px;
            }

            .input-group label {
                left: 10px;
            }
        }
    </style>
</head>

<body>

    @if ($errors->any())
        <div class="floating-error">
            @foreach ($errors->all() as $error)
                <div class="alert-box">
                    {{ $error }}
                </div>
            @endforeach
        </div>
    @endif

    @if (session('error'))
        <div class="floating-error">
            <div class="alert-box">
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="login-container">
        <h2>Selamat Datang</h2>

        <form id="loginForm">
            @csrf

            <div class="input-group">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
            </div>

            <div class="input-group">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
                <span class="toggle-password" onclick="togglePassword()">
                    <i class="bi bi-eye" id="toggleIcon"></i>
                </span>
            </div>

            <!-- LUPA PASSWORD -->
            <div class="forgot-password">
                <a href="/lupa-password">Lupa password?</a>
            </div>

            <button type="submit" name="admin" onclick="loginAs('admin')">Login Admin</button>
            <button type="submit" name="user" onclick="loginAs('user')">Login User</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var passwordIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.remove('bi-eye');
                passwordIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.remove('bi-eye-slash');
                passwordIcon.classList.add('bi-eye');
            }
        }
    </script>

    <script>
        function loginAs(userType) {
            const form = document.getElementById('loginForm');

            if (userType === 'user') {
                form.action = "{{ route('login.user') }}";
            } else {
                form.action = "{{ route('login.admin') }}";
            }

            form.method = 'POST';
            form.submit();
        }
    </script>

</body>

</html>