<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ternak Baru</title>
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

<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah Ternak Baru</h1>
                <p class="text-gray-600">Lengkapi informasi berikut untuk menambahkan ternak</p>
            </div>
            <a href="{{ url()->previous()}}" class="btn-primary px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow border border-gray-300 p-6">
            <form action="{{ route('petani.create') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Ternak</label>
                    <input type="text" name="nama" id="nama" required
                        class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-500 p-2">
                </div>

                <!-- Jenis -->
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Ternak</label>
                    <select name="jenis" id="jenis" required
                        class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-500 p-2">
                        <option value="">Pilih jenis ternak</option>
                        <option value="ayam">Ayam</option>
                        <option value="sapi">Sapi</option>
                        <option value="kambing">Kambing</option>
                        <option value="bebek">Bebek</option>
                        <option value="ikan">Ikan</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi / Kandang</label>
                    <input type="text" name="lokasi" id="lokasi" required
                        class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-500 p-2">
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" required
                        class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-500 p-2">
                        <option value="active">Aktif</option>
                        <option value="inactive">Nonaktif</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-4 pt-4">
                    <a href="{{ route('petani-laporan') }}"
                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">Batal</a>
                    <button type="submit"
                        class="btn-primary px-4 py-2 rounded-md shadow hover:bg-blue-700 transition-all duration-200">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Auto-close success popup after 4 seconds -->
    <script>
        setTimeout(() => {
            const popup = document.getElementById('popup-success');
            if (popup) popup.remove();
        }, 4000);
    </script>
</body>

</html>