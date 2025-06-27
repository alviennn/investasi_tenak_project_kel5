<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livestock Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .status-active {
            background-color: #bbf7d0;
            color: #166534;
        }

        .status-inactive {
            background-color: #fecaca;
            color: #991b1b;
        }

        .status-pending {
            background-color: #fef08a;
            color: #854d0e;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">

        <!-- Header Section -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Manajemen Ternak</h1>
                <p class="text-gray-600">Kelola semua hewan ternak Anda di satu tempat</p>
            </div>
            <div class="flex items-center gap-4">
                <!-- Perkebambangan Ternak Button -->
                <a href="{{ route('petani-laporan')}}" class="btn-primary px-4 py-2 rounded-lg flex items-center gap-2 transition-all duration-200">Perkembangan Ternak
                </a>
                <!-- Tambah Ternak Baru Button -->
                <a href="{{ route('petani.tambah') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center gap-2 transition-all duration-200">
                    <i class="fas fa-plus"></i> Tambah Ternak Baru
                </a>
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary px-4 py-2 rounded-lg flex items-center gap-2 transition-all duration-200">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-white rounded-lg shadow p-4 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <form method="GET" action="{{ route('petani-dashboard') }}" class="w-full md:w-1/3">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Ternak</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            placeholder="Nama ternak atau ID..."
                            class="pl-10 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <button type="submit" class="hidden"></button>
                    </div>
                </form>

                <!-- <div class="w-full md:w-1/3">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>
                <div class="w-full md:w-1/3">
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Jenis Ternak</label>
                    <select id="type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="">Semua Jenis</option>
                        <option value="ayam">Ayam</option>
                        <option value="sapi">Sapi</option>
                        <option value="kambing">Kambing</option>
                        <option value="bebek">Bebek</option>
                        <option value="ikan">Ikan</option>
                    </select>
                </div> -->
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total Ternak</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $total }}</h3>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-cow text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Aktif</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $aktif }}</h3>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Nonaktif</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $nonaktif }}</h3>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-times-circle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Pending</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $pending }}</h3>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-hourglass-half text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>

        </div>


        <!-- Livestock Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ternak</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($ternaks as $ternak)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 align-middle">{{ $ternak->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-middle">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @php
                                        $icons = [
                                        'ayam' => 'fas fa-egg text-yellow-500',
                                        'sapi' => 'fas fa-cow text-brown-500',
                                        'kambing' => 'fas fa-horse-head text-gray-500',
                                        'bebek' => 'fas fa-drumstick-bite text-green-500',
                                        'ikan' => 'fas fa-fish text-blue-500',
                                        ];
                                        $iconClass = $icons[$ternak->jenis] ?? 'fas fa-question-circle text-gray-400';
                                        @endphp
                                        <i class="{{ $iconClass }} text-2xl"></i>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $ternak->nama }}</div>
                                        <div class="text-sm text-gray-500">ID #{{ $ternak->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 capitalize align-middle">{{ $ternak->jenis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 align-middle">{{ $ternak->lokasi }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center align-middle">
                                @php
                                $statusClasses = [
                                'active' => 'status-active',
                                'inactive' => 'status-inactive',
                                'pending' => 'status-pending',
                                ];
                                $statusClass = $statusClasses[$ternak->status] ?? 'bg-gray-200 text-gray-600';
                                @endphp
                                <span class="{{ $statusClass }} px-2 py-1 text-xs font-semibold rounded-full">
                                    {{ ucfirst($ternak->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium align-middle">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('petani.detail', $ternak->id) }}" class="text-blue-600 hover:text-blue-900" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('petani.edit', $ternak->id) }}" class="text-yellow-600 hover:text-yellow-900" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <form action="{{ route('petani.delete', $ternak->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data ternak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex items-center justify-between mt-6">
            <!-- <div class="text-sm text-gray-700">
                Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">4</span> dari <span class="font-medium">142</span> ternak
            </div> -->
            <div class="px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
                {{ $ternaks->links('pagination::tailwind') }}
            </div>
        </div>
    </div>


    @if(session('success'))
    <div id="toast-success" class="fixed top-5 left-1/2 transform -translate-x-1/2 z-50 flex items-center w-fit max-w-xs p-4 mb-4 text-sm text-white bg-green-600 rounded-lg shadow transition-opacity duration-300" role="alert">
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