<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanPertumbuhanRequest;
use App\Models\LaporanPertumbuhan;
use App\Models\Ternak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LaporanPertumbuhanController extends Controller
{
    /**
     * Menampilkan daftar semua laporan pertumbuhan ternak.
     */
    public function index()
    {
        // Cek apakah pengguna yang sedang login adalah petani
        if (Auth::user()->role !== 'petani') {
            return redirect('/');
        }

        // Ambil petani yang sedang login
        $petani = Auth::user()->petani;

        // Ambil laporan pertumbuhan dengan relasi petani dan ternak terkait
        $laporan = LaporanPertumbuhan::with(['petani', 'ternak'])
            ->where('id_petani', $petani->id) // Menambahkan filter berdasarkan id_petani
            ->latest()
            ->paginate(10); // Menampilkan 10 laporan per halaman

        // // Jika tidak ada laporan, pastikan kita mengirimkan koleksi kosong
        // if ($laporan->isEmpty()) {
        //     $laporan = collect(); // Mengirim koleksi kosong agar tidak ada error di view
        // }

        return view('petani.laporan', compact('laporan'));
    }

    public function indexInvestor()
    {
        if (Auth::user()->role !== 'investor') {
            return redirect('/');
        }

        // Ambil semua laporan pertumbuhan dengan relasi ternak & petani
        $laporan = LaporanPertumbuhan::with(['ternak', 'petani.user'])
            ->latest()
            ->paginate(10);

        return view('investor.laporan', compact('laporan'));
    }


    /**
     * Menampilkan detail satu laporan pertumbuhan ternak.
     */
    public function show($id)
    {
        // Ambil laporan berdasarkan ID
        $laporan = LaporanPertumbuhan::findOrFail($id);

        // Tampilkan laporan (bisa ke view atau mengembalikan data)
        return view('petani.laporan', compact('laporan'));
    }

    public function showdetaillaporan($id)
    {
        $laporan = LaporanPertumbuhan::with('ternak')->findOrFail($id);

        if (Auth::user()->role === 'investor') {
            return view('petani.laporandetail', compact('laporan'));
        }
        return view('petani.laporandetail', compact('laporan'));
    }


    /**
     * Form untuk membuat laporan baru.
     */
    /**
     * Form untuk membuat laporan baru.
     */
    public function create()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil ternak yang terkait dengan petani yang sedang login
        $ternaks = Ternak::where('id_petani', $user->id)->get(); // Memastikan petani_id yang benar


        // Kirimkan data ternaks ke view
        return view('petani.tambah_laporan', compact('ternaks'));
    }


    /**
     * Simpan laporan baru.
     */

    public function store(Request $request)
    {
        // Cek apakah pengguna yang sedang login memiliki role petani
        if (Auth::user()->role !== 'petani') {
            return redirect()->route('petani-laporan')->with('error', 'Hanya petani yang bisa membuat laporan.');
        }

        // Periksa apakah user memiliki petani
        $petani = Auth::user()->petani;

        if (!$petani) {
            return redirect()->route('petani-laporan')->with('error', 'User ini tidak terdaftar sebagai petani.');
        }

        // Mengambil id_petani dari petani yang sedang login
        $id_petani = $petani->id;

        // Validasi input
        $request->validate([
            'id_ternaks' => 'required|exists:ternaks,id',
            'nama' => 'required|string|max:100',
            'jenis' => 'required|in:ayam,sapi,kambing,bebek,ikan',
            'tanggal_laporan' => 'required|date',
            'berat_rerata' => 'required|string|max:50',
            'pertumbuhan_persen' => 'required|numeric',
            'status' => 'required|in:Excellent,Good,Average,Poor',
        ]);

        // Menambahkan id_petani ke request data
        $data = $request->all();
        $data['id_petani'] = $id_petani;

        // Menyimpan laporan pertumbuhan
        LaporanPertumbuhan::create($data);

        // Redirect ke halaman tambah laporan dengan pesan sukses
        return redirect()->route('petani-laporan')->with('success', 'Laporan pertumbuhan berhasil disimpan.');
    }

    // public function store(LaporanPertumbuhanRequest $request, $ternak_id)
    // {
    //     $laporanpertumbuhan = LaporanPertumbuhan::create([
    //         'id_petani' => Auth::id(),
    //         'id_ternak' => $ternak_id,
    //         'nama' => $request->nama,
    //         'tanggal_laporan' => $request->tanggal_laporan,
    //         'status' => 'pending',
    //     ]);

    //     return redirect()->route('investor-dashboard')->with('success', 'Investasi berhasil dikirim.');
    // }

    public function showForm($id)
    {
        $ternak = Ternak::findOrFail($id);
        return view('investasi.form', compact('ternak'));
    }

    //update
    public function edit($id)
    {
        // Ambil laporan yang ingin diedit
        $laporan = LaporanPertumbuhan::findOrFail($id);

        // Cek apakah user yang login adalah petani yang memiliki laporan ini
        if (Auth::user()->role !== 'petani' || Auth::user()->petani->id !== $laporan->id_petani) {
            return redirect()->route('petani-laporan')->with('error', 'Akses ditolak.');
        }

        // Ambil daftar ternak milik petani ini
        $ternaks = Ternak::where('id_petani', Auth::user()->id)->get();

        return view('petani.edit_laporan', compact('laporan', 'ternaks'));
    }

    /**
     * Memproses update laporan pertumbuhan.
     */
    public function update(Request $request, $id)
    {
        $laporan = LaporanPertumbuhan::findOrFail($id);

        // Cek apakah user adalah petani pemilik laporan
        if (Auth::user()->role !== 'petani' || Auth::user()->petani->id !== $laporan->id_petani) {
            return redirect()->route('petani-laporan')->with('error', 'Akses ditolak.');
        }

        // Validasi input
        $request->validate([
            'id_ternaks' => 'required|exists:ternaks,id',
            'nama' => 'required|string|max:100',
            'jenis' => 'required|in:ayam,sapi,kambing,bebek,ikan',
            'tanggal_laporan' => 'required|date',
            'berat_rerata' => 'required|string|max:50',
            'pertumbuhan_persen' => 'required|numeric',
            'status' => 'required|in:Excellent,Good,Average,Poor',
        ]);

        // Update data
        $laporan->update($request->all());

        return redirect()->route('petani-laporan')->with('success', 'Laporan berhasil diperbarui.');
    }
}
