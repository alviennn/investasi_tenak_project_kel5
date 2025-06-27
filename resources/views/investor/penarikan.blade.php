<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Penarikan Dana</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-md p-8 w-full max-w-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Penarikan Dana</h2>

        {{-- Flash Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ url('/penarikan') }}">
            @csrf

            {{-- Nama Bank --}}
            <div class="mb-4">
                <label for="nama_bank" class="block text-gray-700 font-medium mb-2">Pilih Bank</label>
                <select name="nama_bank" id="nama_bank" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option value="">-- Pilih Bank --</option>
                    @foreach($bank as $b)
                        <option value="{{ $b->nama_bank }}" {{ old('nama_bank') == $b->nama_bank ? 'selected' : '' }}>
                            {{ $b->nama_bank }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Nomor Rekening --}}
            <div class="mb-4">
                <label for="nomor_rekening" class="block text-gray-700 font-medium mb-2">Nomor Rekening</label>
                <input type="text" name="nomor_rekening" id="nomor_rekening" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Masukkan nomor rekening" value="{{ old('nomor_rekening') }}">
            </div>

            {{-- Jumlah Penarikan --}}
            <div class="mb-4">
                <label for="jumlah_penarikan" class="block text-gray-700 font-medium mb-2">Jumlah Penarikan (Rp)</label>
                <input type="number" name="jumlah_penarikan" id="jumlah_penarikan" min="1" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                    placeholder="Masukkan jumlah penarikan" value="{{ old('jumlah_penarikan') }}">
            </div>

            {{-- Submit --}}
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded-lg transition">
                    Tarik Dana
                </button>
            </div>
        </form>
    </div>
</body>
</html>
