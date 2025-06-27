<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Laporan Pertumbuhan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-semibold text-green-700">Detail Laporan Pertumbuhan</h2>
            <a href="{{ url()->previous() }}" class="text-blue-600 hover:underline flex items-center gap-1">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-gray-600 text-sm">Nama Laporan</p>
                <p class="text-lg font-semibold">{{ $laporan->nama }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Tanggal Laporan</p>
                <p class="text-lg font-semibold">{{ \Carbon\Carbon::parse($laporan->tanggal_laporan)->format('d M Y') }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Jenis Ternak</p>
                <p class="text-lg font-semibold capitalize">{{ $laporan->jenis }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Berat Rata-rata</p>
                <p class="text-lg font-semibold">{{ $laporan->berat_rerata }} kg</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Pertumbuhan (%)</p>
                <p class="text-lg font-semibold">{{ $laporan->pertumbuhan_persen }}%</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Status Pertumbuhan</p>
                <p class="text-lg font-semibold">
                    @php
                        $statusColor = match($laporan->status) {
                            'Excellent' => 'text-green-600',
                            'Good' => 'text-blue-500',
                            'Average' => 'text-yellow-500',
                            'Poor' => 'text-red-500',
                            default => 'text-gray-600',
                        };
                    @endphp
                    <span class="{{ $statusColor }}">{{ $laporan->status }}</span>
                </p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Nama Petani</p>
                <p class="text-lg font-semibold">{{ $laporan->petani->user->name ?? 'Tidak diketahui' }}</p>
            </div>

            <div>
                <p class="text-gray-600 text-sm">Nama Ternak</p>
                <p class="text-lg font-semibold">{{ $laporan->ternak->nama ?? '-' }}</p>
            </div>
        </div>
    </div>
</body>
</html>
