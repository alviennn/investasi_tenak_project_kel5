<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Detail Ternak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>

<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Ternak</h1>
            <p class="text-gray-600">Perbarui informasi ternak Anda</p>
        </div>
        <a href="{{ route('petani-dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow border border-gray-300 p-6">
        <form action="{{ route('petani.update', $ternak->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Ternak</label>
                <input type="text" name="nama" value="{{ old('nama', $ternak->nama) }}"
                    class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-500 p-2">
                @error('nama')
                <p class="text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Ternak</label>
                <select name="jenis" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-500 p-2">
                    <option value="ayam" {{ $ternak->jenis == 'ayam' ? 'selected' : '' }}>Ayam</option>
                    <option value="sapi" {{ $ternak->jenis == 'sapi' ? 'selected' : '' }}>Sapi</option>
                    <option value="kambing" {{ $ternak->jenis == 'kambing' ? 'selected' : '' }}>Kambing</option>
                    <option value="bebek" {{ $ternak->jenis == 'bebek' ? 'selected' : '' }}>Bebek</option>
                    <option value="ikan" {{ $ternak->jenis == 'ikan' ? 'selected' : '' }}>Ikan</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi / Kandang</label>
                <input type="text" name="lokasi" value="{{ old('lokasi', $ternak->lokasi) }}"
                    class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-500 p-2">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-500 rounded-md bg-white text-gray-900 shadow-sm focus:border-blue-600 focus:ring-blue-500 p-2">
                    <option value="active" {{ $ternak->status == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ $ternak->status == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="pending" {{ $ternak->status == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

</html>