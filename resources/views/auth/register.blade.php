<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Livestock Management</title>
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

    <!-- Card Register Form -->
    <div class="card w-full max-w-md p-4">
        <div class="card-header text-center">
            <h2 class="text-4xl font-bold">Register</h2>
            <p class="text-sm mt-2">Daftar untuk memulai manajemen ternak Anda</p>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <!-- Name Input -->
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-3 mt-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 input-field"
                        placeholder="Nama Lengkap Anda" />
                </div>
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
                <!-- Password Confirmation -->
                <div class="mb-5">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full px-4 py-3 mt-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 input-field"
                        placeholder="Konfirmasi Kata Sandi" />
                </div>
                <!-- Role Selection -->
                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-700">Pilih Role</label>
                    <select id="role" name="role" required
                        class="w-full px-4 py-3 mt-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 input-field">
                        <option value="">Pilih Role Anda</option>
                        <option value="investor">Investor</option>
                        <option value="petani">Peternak</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="btn-primary w-full py-3 rounded-md text-lg font-semibold transition duration-200 ease-in-out hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Daftar
                </button>
            </form>
            <!-- Login Link -->
            <div class="text-center mt-4">
                <p class="text-sm text-gray-600">Sudah punya akun? <a href="{{ route('login') }}"
                        class="text-green-600 hover:text-green-700 font-medium">Login di sini</a></p>
            </div>
        </div>
    </div>

</body>

</html>