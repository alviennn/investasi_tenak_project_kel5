<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Investasi Ternak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out forwards;
        }

        .status-active {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #dc2626;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-600 to-indigo-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user-shield text-2xl"></i>
                    <h1 class="text-2xl font-bold">Dashboard Admin</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative group">
                        <!-- Tombol Profil -->
                        <div class="flex items-center space-x-2 px-3 py-2 cursor-pointer hover:bg-purple-700 rounded-lg transition">
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-user-circle text-xl"></i>
                        </div>

                        <!-- Dropdown muncul saat hover di group -->
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-150 z-50">
                            <a href="{{ route('admin.profile.edit')}}" class="block px-4 py-2 text-gray-800 hover:bg-purple-100">Profil</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">
                                    Keluar <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </header>

    <!-- Konten -->
    <main class="container mx-auto px-4 py-8">
        <div class="fade-in">
            <!-- Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white shadow rounded-lg p-6 flex justify-between items-center border-l-4 border-indigo-500">
                    <div>
                        <h2 class="text-gray-500 font-medium">Total Investor</h2>
                        <p class="text-2xl font-bold">{{ $totalInvestor }}</p>
                    </div>
                    <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6 flex justify-between items-center border-l-4 border-green-500">
                    <div>
                        <h2 class="text-gray-500 font-medium">Total Investasi</h2>
                        <p class="text-2xl font-bold">Rp {{ number_format($totalInvestasi, 0, ',', '.') }}</p>
                    </div>
                    <div class="bg-green-100 text-green-600 p-3 rounded-full">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6 flex justify-between items-center border-l-4 border-purple-500">
                    <div>
                        <h2 class="text-gray-500 font-medium">Total Ternak</h2>
                        <p class="text-2xl font-bold">{{ $totalTernak }}</p>
                    </div>
                    <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                        <i class="fas fa-cow"></i>
                    </div>
                </div>
                <div class="bg-white shadow rounded-lg p-6 flex justify-between items-center border-l-4 border-yellow-500">
                    <div>
                        <h2 class="text-gray-500 font-medium">Bank Collaborator</h2>
                        <p class="text-2xl font-bold">{{ $totalBank }}</p>
                    </div>
                    <div class="bg-yellow-100 text-yellow-600 p-3 rounded-full">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
            </div>

            <!-- Tabel Investasi Terbaru -->
            <h2 class="text-xl font-bold mb-4 text-gray-800">Investasi Terbaru</h2>
            <div class="bg-white rounded-lg shadow overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Investor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ternak</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dana Investasi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($investasiTerbaru as $investasi)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $investasi->investor->user->name ?? 'Tidak Ada Nama' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $investasi->ternaks->nama ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">Rp {{ number_format($investasi->dana_investasi, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $investasi->tanggal_investasi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                        {{ $investasi->status == 'Aktif' ? 'status-active' : 'status-inactive' }}">
                                    {{ $investasi->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data investasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    @if(session('success'))
    <div id="toast-success" class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 flex items-center w-fit max-w-xs p-4 text-sm text-white bg-green-600 rounded-lg shadow transition-opacity duration-300" role="alert">
        <svg class="w-5 h-5 mr-2 text-white" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z" clip-rule="evenodd"></path>
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