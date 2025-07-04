<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Form Investasi Ternak</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">
            Investasi ke Ternak: {{ $ternak->nama ?? 'Ternak #' . $ternak->id }}
        </h1>

        {{-- Flash message --}}
        @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
            {{ session('success') }}
        </div>
        @endif

        {{-- Validation error --}}
        @if($errors->any())
        <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
            <ul class="mb-0 list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form --}}
        <form action="{{ route('investasi.store', $ternak->id) }}" method="POST" class="space-y-6">
            @csrf

            <!-- ID Investor -->
            <div>
                <label class="block text-sm font-medium text-gray-700">ID Investor:</label>
                <input type="text" value="{{ Auth::id() }}" readonly
                    class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- ID Ternak -->
            <div>
                <label class="block text-sm font-medium text-gray-700">ID Ternak:</label>
                <input type="text" value="{{ $ternak->id }}" readonly
                    class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Tanggal Investasi -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Investasi:</label>
                <input type="text" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly
                    class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Pilih Bank -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Pilih Bank:</label>
                <select name="id_bank" required
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-indigo-500">
                    <option value="">-- Pilih Bank --</option>
                    @foreach($bank as $b)
                    <option value="{{ $b->id }}" {{ old('id_bank') == $b->id ? 'selected' : '' }}>
                        {{ $b->nama_bank }}
                    </option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah Dana -->
            <div>
                <label for="dana_investasi" class="block text-sm font-medium text-gray-700">Jumlah Dana Investasi (min Rp50.000):</label>
                <input type="number" name="dana_investasi" id="dana_investasi" min="50000"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2 focus:ring-2 focus:ring-indigo-500"
                    required value="{{ old('dana_investasi') }}">
            </div>

            <!-- Tombol -->
            <div class="flex justify-between items-center pt-6">
                <button type="submit"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-md hover:bg-indigo-700 transition focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Investasikan Sekarang
                </button>
                <a href="{{ url()->previous() }}" class="text-indigo-600 hover:underline">← Kembali</a>
            </div>
        </form>
    </div>

</body>

</html>
