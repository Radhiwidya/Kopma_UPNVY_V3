<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pendaftaran Berhasil</title>
    <link rel="icon" href="public/img/Icon.png">
    <style>
        :root {
            --green-dark: #1b5e20;
            --green-mid: #388e3c;
            --green-light: #66bb6a;
            --text-light: #ffffff;
            --glass-bg: rgba(255, 255, 255, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1b5e20, #2e7d32, #388e3c, #43a047, #66bb6a);
            background-size: 600% 600%;
            animation: animateGreenGradient 20s ease infinite;
            color: var(--text-light);
            overflow: hidden;
        }

        @keyframes animateGreenGradient {
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

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 20px;
            text-align: center;
        }

        .card {
            background: var(--glass-bg);
            padding: 40px 30px;
            border-radius: 20px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
            max-width: 500px;
            width: 100%;
            animation: fadeInUp 1s ease;
        }

        .icon {
            font-size: 70px;
            color: #ffffff;
            margin-bottom: 20px;
            animation: bounceWiggle 2s infinite ease-in-out;
            display: inline-block;
        }

        @keyframes bounceWiggle {

            0%,
            100% {
                transform: rotate(0deg) scale(1);
            }

            25% {
                transform: rotate(-8deg) scale(1.08);
            }

            50% {
                transform: rotate(8deg) scale(1.1);
            }

            75% {
                transform: rotate(-5deg) scale(1.05);
            }
        }

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #e0f2f1;
        }

        button {
            background: #ffffff22;
            color: #ffffff;
            border: 1px solid #ffffff55;
            padding: 12px 24px;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s ease;
            backdrop-filter: blur(4px);
        }

        button:hover {
            background: #ffffff33;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 22px;
            }

            .icon {
                font-size: 50px;
            }

            button {
                width: 100%;
            }
        }

        #confetti-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            pointer-events: none;
            z-index: 0;
        }
    </style>
</head>

<body>
    <canvas id="confetti-canvas"></canvas>

    <div class="container">
        <div class="card">
            <div class="icon" id="check-icon">✅</div>
            <h1>Presensi Berhasil!</h1>
            <p>Terima kasih! Presensi Anda telah berhasil dikonfirmasi. <br> Selamat menjalani rangkaian Diklat KOPMA UPNVY!
            </p>
            <button onclick="goToHome()">Kembali ke Home</button>
        </div>
    </div>

    <script>
        function goToHome() {
            window.location.href = "https://kopma-upnvy.com/";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>
    <script>
        const canvas = document.getElementById('confetti-canvas');
        const confetti = window.confetti.create(canvas, {
            resize: true,
            useWorker: true
        });

        document.addEventListener('DOMContentLoaded', () => {
            confetti({
                particleCount: 200,
                spread: 120,
                origin: {
                    x: 0.5,
                    y: 0.5
                }
            });
        });

        setInterval(() => {
            confetti({
                particleCount: 10,
                angle: 60,
                spread: 55,
                origin: {
                    x: 0,
                    y: Math.random() * 0.5 + 0.2
                }
            });

            confetti({
                particleCount: 10,
                angle: 120,
                spread: 55,
                origin: {
                    x: 1,
                    y: Math.random() * 0.5 + 0.2
                }
            });
        }, 700);
    </script>
</body>

</html>
