<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Livestock Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Green and Brown Gradient Background */
        .background-gradient {
            background: linear-gradient(135deg, #4CAF50, #8B4513);
        }

        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }

        .btn-primary:hover {
            background-color: #388E3C;
        }

        .input-field:focus {
            border-color: #8B4513;
            box-shadow: 0 0 5px rgba(139, 69, 19, 0.5);
        }

        /* Card shadow and corner radius */
        .card {
            background: white;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border-radius: 1rem;
        }

        .card-header {
            background-color: #4CAF50;
            color: white;
            padding: 2rem;
            border-radius: 1rem 1rem 0 0;
        }

        .card-body {
            padding: 2rem;
        }
    </style>
</head>

<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <!-- Card Login Form -->
    <div class="card w-full max-w-md p-4">
        <div class="card-header text-center">
            <h2 class="text-4xl font-bold">Login</h2>
            <p class="text-sm mt-2">Masukkan email dan kata sandi Anda untuk masuk ke sistem</p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Input -->
                <div class="mb-5">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-3 mt-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 input-field"
                        placeholder="Email Anda" />
                </div>
                <!-- Password Input -->
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-3 mt-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 input-field"
                        placeholder="Kata Sandi Anda" />
                </div>
                <!-- Remember Me Checkbox -->
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-600">Ingat Saya</label>
                    </div>
                    <a href="#" class="text-sm text-green-600 hover:text-green-700">Lupa Kata Sandi?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="btn-primary w-full py-3 rounded-md text-lg font-semibold transition duration-200 ease-in-out hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Masuk
                </button>
            </form>
            <!-- Register Link -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">Belum punya akun?
                    <a href="{{ route('register') }}" class="text-green-600 hover:text-green-700 font-medium">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>


    @if(session('success'))
    <div id="toast-success"
        class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 flex items-center w-fit max-w-xs p-4 mb-4 text-sm text-white bg-green-600 rounded-lg shadow transition-opacity duration-300"
        role="alert">
        <svg class="w-5 h-5 mr-2 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span>{{ session('success') }}</span>
    </div>

    <script>
        setTimeout(() => {
            const toast = document.getElementById('toast-success');
            if (toast) toast.style.opacity = '0';
            setTimeout(() => toast?.remove(), 300);
        }, 3000);
    </script>
    @endif

</body>

</html>