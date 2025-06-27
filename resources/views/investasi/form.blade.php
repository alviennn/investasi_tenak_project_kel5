<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Investasi ke Ternak: {{ $ternak->nama ?? 'Ternak #' . $ternak->id }}
        </h2>
    </x-slot>

    <div class="py-6 px-6 max-w-4xl mx-auto bg-white shadow-md rounded-lg">
        {{-- Flash message --}}
        @if(session('success'))
        <div class="alert alert-success bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- Validation error --}}
        @if($errors->any())
        <div class="alert alert-danger bg-red-100 text-red-800 p-4 rounded mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Form Investasi --}}
        <form action="{{ route('investasi.store', $ternak->id) }}" method="POST" class="space-y-6">
            @csrf

            {{-- Info ID Investor --}}
            <div>
                <label class="block font-medium text-sm text-gray-700">ID Investor:</label>
                <input type="text" value="{{ Auth::id() }}" readonly
                    class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm p-2">
            </div>

            {{-- Info ID Ternak --}}
            <div>
                <label class="block font-medium text-sm text-gray-700">ID Ternak:</label>
                <input type="text" value="{{ $ternak->id }}" readonly
                    class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm p-2">
            </div>

            {{-- Info Tanggal Investasi --}}
            <div>
                <label class="block font-medium text-sm text-gray-700">Tanggal Investasi:</label>
                <input type="text" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly
                    class="mt-1 block w-full rounded-md bg-gray-100 border border-gray-300 shadow-sm p-2">
            </div>

            {{-- Input Dana Investasi --}}
            <div>
                <label for="dana_investasi" class="block font-medium text-sm text-gray-700">
                    Jumlah Dana Investasi (min Rp50.000):
                </label>
                <input type="number" name="dana_investasi" id="dana_investasi" min="50000"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm p-2"
                    required value="{{ old('dana_investasi') }}">
            </div>

            {{-- Submit --}}
            <div class="pt-4 flex gap-4 justify-between">
                <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Investasikan Sekarang
                </button>
                <a href="{{ url()->previous() }}" class="text-blue-500 hover:underline mt-2 self-center">← Kembali</a>
            </div>
        </form>
    </div>
</x-app-layout>