<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Investor - Investasi Ternak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Animasi kustom */
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

        /* Status badge */
        .status-active {
            background-color: #dcfce7;
            color: #16a34a;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #dc2626;
        }

        /* Badge tipe ternak */
        .type-livestock {
            background-color: #ede9fe;
            color: #7c3aed;
        }

        .type-poultry {
            background-color: #fce7f3;
            color: #db2777;
        }

        .type-dairy {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        /* Transisi modal */
        .modal {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .modal-overlay {
            transition: opacity 0.3s ease;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-gradient-to-r from-purple-600 to-indigo-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-6">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-piggy-bank text-2xl"></i>
                    <h1 class="text-2xl font-bold">InvesTernak</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Dropdown Button (Investor) -->
                    <div class="relative group">
                        <button class="flex items-center space-x-2 hover:bg-purple-700 px-3 py-2 rounded-lg transition">
                            <span class="font-medium">{{ Auth::user()->name }}</span>
                            <i class="fas fa-user-circle text-xl"></i>
                        </button>

                        <!-- Dropdown content, visible on hover -->
                        <div id="profileMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ route('profile.edit')}}" class="block px-4 py-2 text-gray-800 hover:bg-purple-100">Profil</a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block px-4 py-2 text-red-600 hover:bg-red-100">
                                    Keluar <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="container mx-auto px-4 py-8">
        <div class="fade-in">

            <!-- Flash message success -->
            @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-8">
                <p>{{ session('success') }}</p>
            </div>
            @endif

            <!-- Judul dan Kontrol -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-2xl font-bold text-gray-800">Ternak Tersedia</h2>
                    <p class="text-gray-600">Jelajahi dan investasikan pada berbagai komoditas ternak</p>
                </div>
                <!-- <div class="flex space-x-3 w-full md:w-auto">
                    <div class="relative w-full md:w-64">
                        <input type="text" placeholder="Cari ternak..." class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                    <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition whitespace-nowrap flex items-center">
                        <i class="fas fa-filter mr-2"></i> Filter
                    </button>
                </div> -->
            </div>

            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                <!-- Total Ternak -->
                <a href="" class="block bg-white rounded-lg shadow hover:shadow-lg transition duration-200 border-l-4 border-purple-500">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-gray-500 font-medium">Total Peternakan</h3>
                                <p class="text-2xl font-bold">{{ $totalternak }}</p>
                            </div>
                            <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                                <i class="fas fa-cow"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Investasi Aktif -->
                <a href="{{ route('penarikan') }}" class="block bg-white rounded-lg shadow hover:shadow-lg transition duration-200 border-l-4 border-green-500">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-gray-500 font-medium">penarikan</h3>
                                <p class="text-2xl font-bold">{{ $penarikan }}</p>
                            </div>
                            <div class="bg-green-100 text-green-600 p-3 rounded-full">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Perkembangan Ternak -->
                <a href="{{route ('investor.laporan')}}" class="block bg-white rounded-lg shadow hover:shadow-lg transition duration-200 border-l-4 border-indigo-500">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-gray-500 font-medium">Perkembangan ternak</h3>
                                <p class="text-2xl font-bold">{{ $total }}</p>
                            </div>
                            <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Perkiraan Pengembalian -->
                <a href="" class="block bg-white rounded-lg shadow hover:shadow-lg transition duration-200 border-l-4 border-indigo-500">
                    <div class="p-5">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-gray-500 font-medium">Saldo</h3>
                                <p class="text-2xl font-bold">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                            </div>
                            <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
                                <i class="fas fa-coins"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <!-- Tabel Ternak -->
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
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $ternak->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ternak->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ternak->jenis }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ternak->lokasi }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm">{{ $ternak->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('investasi.index', $ternak->id) }}" class="text-blue-600 hover:text-blue-900">Lihat</a>
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
            <div class="flex items-center justify-between mt-5">
                <div class="text-sm text-gray-500">
                    Menampilkan <span class="font-medium">{{ $ternaks->count() }}</span> dari <span class="font-medium">{{ $ternaks->total() }}</span> ternak
                </div>
                <div class="flex space-x-2">
                    {{ $ternaks->links() }}
                </div>
            </div>

            <!-- Tabel Investasi -->
            <div class="mt-12 bg-white rounded-lg shadow overflow-hidden">
                <h2 class="text-xl font-bold text-gray-800 px-6 pt-6">Daftar Investasi Anda</h2>

                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Ternak</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Bank</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Dana Investasi</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($investasi as $item)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $item->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->ternak ? $item->ternak->nama : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $item->bank ? $item->bank->nama_bank : '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Rp {{ number_format($item->dana_investasi, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($item->tanggal_investasi)->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold
                            {{ $item->status === 'pending' ? 'bg-yellow-100 text-yellow-700' :
                               ($item->status === 'approved' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada investasi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4">
                    {{ $investasi->links() }}
                </div>
            </div>

            <!-- Pagination -->
            <!-- <div class="flex items-center justify-between mt-5">
                <div class="text-sm text-gray-500">
                    Menampilkan <span class="font-medium">1</span> sampai <span class="font-medium">{{ $ternaks->count() }}</span> dari <span class="font-medium">{{ $ternaks->total() }}</span> ternak
                </div>
                <div class="flex space-x-2">
                    {{ $ternaks->links() }}
                </div>
            </div> -->
        </div>

        </div>
    </main>

    <!-- Invest Modal -->
    <div id="investModal" class="fixed z-50 inset-0 overflow-y-auto hidden modal-overlay">
        <!-- Modal Content here -->
    </div>

    <script>
        // // Toggle profile menu visibility
        // document.getElementById("profileButton").addEventListener("click", function(event) {
        //     event.stopPropagation();
        //     const menu = document.getElementById("profileMenu");
        //     menu.classList.toggle("hidden");
        // });

        // // Close the profile menu if clicking outside
        // window.addEventListener("click", function(event) {
        //     const menu = document.getElementById("profileMenu");
        //     if (!menu.contains(event.target) && !event.target.matches("#profileButton")) {
        //         menu.classList.add("hidden");
        //     }
        // });

        function openInvestModal(id, name) {
            document.getElementById('modalTitle').innerText = `Investasikan di ${name}`;
            document.getElementById('modalDescription').innerText = `Apakah Anda yakin ingin berinvestasi pada ${name} (${id})?`;
            document.getElementById('investModal').classList.remove('hidden');
        }

        function closeInvestModal() {
            document.getElementById('investModal').classList.add('hidden');
        }

        function confirmInvestment() {
            alert('Investasi berhasil!');
            closeInvestModal();
        }
    </script>
</body>

</html>