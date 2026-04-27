<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User | Coming Soon</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/Icon.png') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            font-family: 'Bebas Neue', sans-serif;
            overflow: hidden;
            color: #f1fff1;
            background: linear-gradient(-45deg, #0f9b0f, #004d00, #1b5e20, #0f9b0f);
            background-size: 400% 400%;
            animation: backgroundShift 20s ease-in-out infinite;
        }

        .container {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .logo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;
            margin-bottom: 30px;
            border: 5px solid #66ff66;
            box-shadow: 0 0 30px rgba(102, 255, 102, 0.7);
            animation: pulse 4s ease-in-out infinite;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .wave-text {
            display: flex;
            justify-content: center;
            font-size: 4rem;
            letter-spacing: 10px;
            text-transform: uppercase;
            color: #aaffaa;
            text-shadow: 2px 2px #003300;
            flex-wrap: wrap;
        }

        .wave-text span {
            display: inline-block;
            animation: wave 3s cubic-bezier(0.68, -0.6, 0.32, 1.6) infinite;
        }

        .wave-text span:nth-child(n) {
            animation-delay: calc(0.1s * var(--i));
        }

        .subtext {
            margin-top: 15px;
            font-size: 1.3rem;
            color: #ccffcc;
            font-weight: 300;
            text-shadow: 1px 1px #003300;
        }

        .bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .bubbles span {
            position: absolute;
            display: block;
            width: 20px;
            height: 20px;
            background: rgba(102, 255, 102, 0.08);
            border-radius: 50%;
            animation: floatBubble 18s linear infinite;
            bottom: -100px;
        }

        .bubbles span:nth-child(odd) {
            background: rgba(102, 255, 102, 0.2);
        }

        .logout-button {
            position: absolute;
            top: 20px;
            right: 25px;
            padding: 8px 16px;
            font-size: 14px;
            background-color: rgba(0, 80, 0, 0.7);
            color: #ccffcc;
            border: 1px solid #66ff66;
            border-radius: 25px;
            cursor: pointer;
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 1px;
            z-index: 999;
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            background-color: #66ff66;
            color: #003300;
            box-shadow: 0 0 10px #66ff66;
        }

        @keyframes wave {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px) rotate(-2deg);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                box-shadow: 0 0 20px rgba(102, 255, 102, 0.6);
            }

            50% {
                transform: scale(1.1);
                box-shadow: 0 0 40px rgba(102, 255, 102, 1);
            }
        }

        @keyframes floatBubble {
            0% {
                transform: translateY(0) scale(1);
            }

            100% {
                transform: translateY(-1200px) scale(0.5);
            }
        }

        @keyframes backgroundShift {
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

        @media (max-width: 768px) {
            .wave-text {
                font-size: 2.4rem;
                letter-spacing: 5px;
            }

            .logo {
                width: 90px;
                height: 90px;
            }
        }
    </style>
</head>

<body>

    <!-- Tombol Logout -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        <button class="logout-button" type="submit">Logout</button>
    </form>

    <div class="container">
        <div class="logo">
            <img src="{{ asset('img/Icon.png') }}" alt="Logo Perusahaan">
        </div>

        <div class="wave-text" id="waveText">
            <!-- JavaScript akan isi huruf di sini -->
        </div>

        <div class="subtext">
            Halaman user sedang dalam kontruksi. Doakan kami agar kontruksi cepat selesai😊
        </div>

        <div class="bubbles">
            <!-- Bubbles -->
            <span style="left:10%; width:15px;"></span>
            <span style="left:20%; width:18px;"></span>
            <span style="left:35%; width:12px;"></span>
            <span style="left:50%; width:20px;"></span>
            <span style="left:65%; width:14px;"></span>
            <span style="left:80%; width:19px;"></span>
            <span style="left:90%; width:16px;"></span>
        </div>
    </div>

    {{-- <div id="changePasswordModal"
      class="fixed inset-0 z-50 hidden items-center justify-center backdrop-blur-sm bg-black/60">
      <div
          class="bg-[#1e2227] w-full max-w-2xl rounded-xl shadow-2xl 
              flex flex-col max-h-[90vh] p-6">

          <div class="flex justify-between items-center border-b-2 border-white shrink-0 pb-4">
              <h2 class="text-xl font-semibold text-white">Ganti Password</h2>
          </div>

          <div class="overflow-y-auto no-scrollbar px-6 py-4">
              <form action="" method="POST"
                  class="mt-4 space-y-3">
                  @csrf
                  @method('PUT')

                  <div class="space-y-4">
                      <div class="mb-3">
                          <label for="name" class="text-gray-400 text-sm">Nama</label>
                          <br>
                          <input type="text" name="name"
                              class="w-full mt-1 px-3 py-2 bg-gray-800 text-gray-300 rounded-lg border border-gray-700"
                              placeholder="Nama">
                      </div>

                      <div class="flex justify-end gap-3 mt-6">
                          <button type="submit"
                              class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg transition duration-200 hover:cursor-pointer">
                              Update
                          </button>
                      </div>
                  </div>

              </form>
          </div>

      </div>
  </div> --}}
    <script>
        // Animasi huruf bergelombang
        const waveText = document.getElementById('waveText');
        const text = 'COMING SOON';
        [...text].forEach((char, i) => {
            const span = document.createElement('span');
            span.innerHTML = char === ' ' ? '&nbsp;' : char;
            span.style.setProperty('--i', i + 1);
            waveText.appendChild(span);
        });
    </script>
    @if (session('force_change_password'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('changePasswordModal').classList.remove('hidden');
            });
        </script>
    @endif

</body>

</html>
