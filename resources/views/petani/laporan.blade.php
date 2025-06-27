<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pertumbuhan Ternak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div class="space-y-2">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium transition-colors duration-300
          border border-blue-200 hover:border-blue-400 rounded-md px-3 py-1.5 shadow-sm hover:shadow-md bg-white">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali</span>
                </a>
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Laporan Pertumbuhan Ternak</h1>
                    <p class="text-gray-600">Pantau dan analisis laporan pertumbuhan ternak Anda</p>
                </div>
            </div>

            <a href="{{ route('petani.tambah_laporan') }}"
                class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm md:text-base">
                <i class="fas fa-plus"></i> Tambah Laporan
            </a>

        </div>

        <!-- Tabel Data Laporan -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Data Detail Pertumbuhan</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Laporan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID Petani</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Ternak</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Laporan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Berat Rata-rata</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pertumbuhan (%)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($laporan as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-700">{{ optional($item->petani)->id ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ optional($item->ternak)->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $item->nama }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700 capitalize">{{ $item->jenis }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_laporan)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-700">{{ $item->berat_rerata }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-green-600">{{ $item->pertumbuhan_persen }}%</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if($item->status === 'Excellent') bg-green-100 text-green-800
                                    @elseif($item->status === 'Good') bg-blue-100 text-blue-800
                                    @elseif($item->status === 'Average') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <a href="{{ route('petani.laporandetail', $item->id) }}" class="text-blue-600 hover:underline">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-6 py-4 text-center text-gray-500">Data laporan tidak tersedia.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Paginasi -->
        <div class="px-6 py-4">
            {{ $laporan->links('pagination::tailwind') }}
        </div>

    </div>
</body>

</html>