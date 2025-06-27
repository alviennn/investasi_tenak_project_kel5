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
        $laporan = LaporanPertumbuhan::with(['petani', 'ternak'])->latest()->paginate(10);

        return view('petani.laporan', compact('laporan'));
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

    /**
     * Form untuk membuat laporan baru.
     */
    public function create()
    {
        $ternaks = Ternak::all();

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

        // Validasi input 
        $request->validate([
            'id_ternaks' => 'required|exists:ternaks,id',
            'nama' => 'required|string|max:100',
            'jenis' => 'required|in:ayam,sapi,kambing,bebek,ikan',
            'tanggal_laporan' => 'required|date',
            'berat_rerata' => 'required|string|max:50',
            'pertumbuhan_persen' => 'required|numeric',
            'status' => 'required|in:Excellent,Good,Average,Poor',
            // 'id_petani' => 'required|exists:petani,id',
        ]);

        // Menambahkan user_id (id_petani) ke request data
        $data = $request->all();
        $data['id_petani'] = Auth::id();  // Menambahkan ID pengguna yang sedang login ke kolom id_petani

        // Menyimpan laporan dengan id_petani yang ditambahkan
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
}
