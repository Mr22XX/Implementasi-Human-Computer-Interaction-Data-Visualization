<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | SIP-KBI</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'sipkbi-green': '#16a34a',
                        'sipkbi-dark': '#064e3b',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 transition duration-500">

    <button id="theme-toggle" class="absolute top-0 right-0 m-5 text-xl p-2 rounded-md border hover:bg-gray-200 dark:hover:bg-gray-700">
        🌞
    </button>

    <div class="min-h-screen flex flex-col items-center justify-center">

        <h1 class="text-2xl font-bold text-sipkbi-green mb-6">SIP-KBI</h1>

        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 w-80 md:w-96">
            <h2 class="text-xl font-semibold mb-4 text-center">Masuk ke Akun</h2>

            <!-- 🔥 PESAN ERROR LOGIN -->
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                    <strong>Login gagal!</strong> Email atau password yang Anda masukkan salah.
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 text-green-600 dark:text-green-400 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm mb-1">Email</label>
                    <input id="email" type="email" placeholder="Email"
                        class="w-full px-3 py-2 border rounded-lg bg-gray-50 dark:bg-gray-700
                        border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-sipkbi-green"
                        name="email" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm mb-1">Password</label>

                    <div class="relative">
                        <input id="password" placeholder="Password" type="password" name="password" required
                            class="w-full px-3 py-2 pr-10 border rounded-lg bg-gray-50 dark:bg-gray-700 
                                border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-sipkbi-green">

                        <!-- Tombol Show/Hide -->
                        <button type="button" id="togglePassword"
                            class="absolute inset-y-0 right-3 flex items-center text-gray-500 dark:text-gray-300">
                            <i id="togglePasswordIcon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                </div>

                <p class="text-sm my-4">
                    <a href="{{ route('password.request') }}" class="text-blue-500 hover:underline">
                        Lupa Password ?
                    </a>
                </p>

                <button type="submit"
                    class="w-full bg-sipkbi-green text-white py-2 rounded-lg hover:bg-green-700 transition">
                    Login
                </button>
            </form>

            <p class="text-center text-sm mt-4">
                Belum punya akun? <a href="{{ route('register') }}" class="text-sipkbi-green hover:underline">Daftar</a>
            </p>
        </div>
    </div>

    <!-- Dark Mode Script -->
    <script>
        const toggle = document.getElementById('theme-toggle');
        const html = document.documentElement;

        if (localStorage.theme === 'dark') {
            html.classList.add('dark');
            toggle.textContent = '🌙';
        }

        toggle.addEventListener('click', () => {
            html.classList.toggle('dark');
            const isDark = html.classList.contains('dark');
            toggle.textContent = isDark ? '🌙' : '🌞';
            localStorage.theme = isDark ? 'dark' : 'light';
        });

    const togglePassword = document.getElementById('togglePassword');
    const icon = document.getElementById('togglePasswordIcon');
    const password = document.getElementById('password');

    togglePassword.addEventListener('click', () => {
        const isPassword = password.type === "password";

        password.type = isPassword ? "text" : "password";

        // Ganti icon
        icon.classList.toggle("fa-eye");
        icon.classList.toggle("fa-eye-slash");
    });


    </script>

</body>
</html>
