<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Ternak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Custom colors for the green and brown theme */
        .bg-green-custom {
            background-color: #6B8E23;
            /* Olive Green */
        }

        .bg-brown-custom {
            background-color: #8B4513;
            /* Saddle Brown */
        }

        .text-green-custom {
            color: #6B8E23;
            /* Olive Green */
        }

        .text-brown-custom {
            color: #8B4513;
            /* Saddle Brown */
        }

        /* Custom status colors */
        .status-active {
            color: #28a745;
            /* Green for active */
        }

        .status-inactive {
            color: #dc3545;
            /* Red for inactive */
        }

        .status-pending {
            color: #ffc107;
            /* Yellow for pending */
        }

        /* Custom animal icons */
        .icon-ayam {
            color: #f59e0b;
            /* Orange for ayam */
        }

        .icon-sapi {
            color: #d97706;
            /* Darker yellow for sapi */
        }

        .icon-kambing {
            color: #10b981;
            /* Green for kambing */
        }

        .icon-bebek {
            color: #3b82f6;
            /* Blue for bebek */
        }

        .icon-ikan {
            color: #38bdf8;
            /* Light blue for ikan */
        }
    </style>
</head>

<body class="bg-gray-100 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-semibold text-green-custom">Detail Ternak</h2>
            <a href="{{ route('petani-dashboard') }}" class="text-blue-600 hover:underline flex items-center gap-1">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- ID -->
            <div>
                <p class="text-gray-600 text-sm">ID Ternak</p>
                <p class="text-lg font-semibold text-brown-custom">{{ $ternak->id }}</p>
            </div>
            <!-- Nama Ternak -->
            <div>
                <p class="text-gray-600 text-sm">Nama Ternak</p>
                <p class="text-lg font-semibold text-brown-custom">{{ $ternak->nama }}</p>
            </div>
            <!-- Jenis Ternak with icon -->
            <div class="flex items-center">
                <p class="text-gray-600 text-sm">Jenis</p>
                <p class="text-lg font-semibold text-brown-custom capitalize ml-2">
                    @if($ternak->jenis === 'ayam')
                    <i class="fas fa-egg icon-ayam mr-2"></i> Ayam
                    @elseif($ternak->jenis === 'sapi')
                    <i class="fas fa-cow icon-sapi mr-2"></i> Sapi
                    @elseif($ternak->jenis === 'kambing')
                    <i class="fas fa-sheep icon-kambing mr-2"></i> Kambing
                    @elseif($ternak->jenis === 'bebek')
                    <i class="fas fa-duck icon-bebek mr-2"></i> Bebek
                    @else
                    <i class="fas fa-fish icon-ikan mr-2"></i> Ikan
                    @endif
                </p>
            </div>
            <!-- Lokasi Ternak -->
            <div>
                <p class="text-gray-600 text-sm">Lokasi</p>
                <p class="text-lg font-semibold text-brown-custom">{{ $ternak->lokasi }}</p>
            </div>
            <!-- Status Ternak with color codes -->
            <div>
                <p class="text-gray-600 text-sm">Status</p>
                <p class="text-lg font-semibold">
                    @if($ternak->status === 'active')
                    <span class="status-active">Aktif</span>
                    @elseif($ternak->status === 'inactive')
                    <span class="status-inactive">Nonaktif</span>
                    @else
                    <span class="status-pending">Pending</span>
                    @endif
                </p>
            </div>
        </div>

        <!-- Foto Ternak (jika ada) -->
        @if($ternak->foto_ternak)
        <div class="mt-6">
            <p class="text-gray-600 text-sm">Foto Ternak</p>
            <img src="{{ asset('storage/' . $ternak->foto_ternak) }}" alt="Foto Ternak" class="rounded-lg shadow-xl w-full h-72 object-cover mt-4">
        </div>
        @endif

    </div>
</body>

</html>