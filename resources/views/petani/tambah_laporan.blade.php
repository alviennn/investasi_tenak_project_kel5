<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Laporan Pertumbuhan Ternak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .btn-primary {
            background-color: #3b82f6;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Laporan Pertumbuhan Ternak</h1>
                <p class="text-gray-600">Isi data laporan pertumbuhan ternak secara lengkap</p>
            </div>
            <a href="{{ route('petani-laporan') }}" class="btn-primary px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-lg shadow border border-gray-300 p-6">
            @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('petani.tambah_laporan') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Ternak</label>
                    <select name="id_ternaks" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm p-2 focus:border-blue-600 focus:ring-blue-500" required>
                        <option value="">-- Pilih Ternak --</option>
                        @foreach ($ternaks as $ternak)
                        <option value="{{ $ternak->id }}">{{ $ternak->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Laporan</label>
                    <input type="text" name="nama" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm p-2 focus:border-blue-600 focus:ring-blue-500" placeholder="Nama laporan" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Ternak</label>
                    <select name="jenis" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm p-2 focus:border-blue-600 focus:ring-blue-500" required>
                        <option value="">-- Pilih Jenis --</option>
                        <option value="ayam">Ayam</option>
                        <option value="sapi">Sapi</option>
                        <option value="kambing">Kambing</option>
                        <option value="bebek">Bebek</option>
                        <option value="ikan">Ikan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Laporan</label>
                    <input type="date" name="tanggal_laporan" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm p-2 focus:border-blue-600 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Berat Rata-rata</label>
                    <input type="text" name="berat_rerata" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm p-2 focus:border-blue-600 focus:ring-blue-500" placeholder="Misal: 2.5 kg" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pertumbuhan (%)</label>
                    <input type="number" step="0.01" name="pertumbuhan_persen" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm p-2 focus:border-blue-600 focus:ring-blue-500" placeholder="Misal: 5.6" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm p-2 focus:border-blue-600 focus:ring-blue-500" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Average">Average</option>
                        <option value="Poor">Poor</option>
                    </select>
                </div>

                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('petani-laporan') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</a>
                    <button type="submit" class="btn-primary px-4 py-2 rounded-md shadow hover:bg-blue-700 transition-all duration-200">
                        <i class="fas fa-save mr-1"></i> Simpan Laporan
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
