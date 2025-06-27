<?php

namespace App\Http\Controllers;

use App\Models\Ternak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;


class TernakController extends Controller
{


    public function index(Request $request)
    {
        $query = Ternak::query();

        // Jika user adalah petani, batasi hanya data miliknya
        if (Auth::user()->role === 'petani') {
            $query->where('id_petani', Auth::id());
        }

        // Search by nama atau ID
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }


        // Hitung total & status
        $ternaks = $query->latest()->paginate(10);
        $total = $query->count();
        $aktif = $query->clone()->where('status', 'active')->count();
        $nonaktif = $query->clone()->where('status', 'inactive')->count();
        $pending = $query->clone()->where('status', 'pending')->count();


        return view('petani.index', compact('ternaks', 'total', 'aktif', 'nonaktif', 'pending'));
    }

    public function show($id)
    {
        $ternak = Ternak::findOrFail($id);
        return view('petani.detail', compact('ternak'));
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            if (!$user || $user->role !== 'petani') {
                return response()->json(['message' => 'Tidak diizinkan'], 403);
            }

            $ternak = Ternak::create([
                'id_petani' => $user->id,
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'status' => $request->status,
                'lokasi' => $request->lokasi,
                'deskripsi' => $request->deskripsi
            ]);

            return redirect()->route('petani-dashboard')->with('success', 'Data ternak berhasil ditambahkan.');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal membuat ternak',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        return view('petani.tambah');
    }

    public function update(Request $request, $id)
    {
        try {
            $ternak = Ternak::find($id);
            $ternak->update($request->all());

            return redirect()->route('petani-dashboard')->with('success', 'Ternak berhasil diperbarui');
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui ternak',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $ternak = Ternak::find($id);
        return view('petani.edit', compact('ternak'));
    }

    // public function edit($id)
    // {
    //     $ternak = Ternak::
    //     return view('petani.edit', compact('ternak'));
    // }

    public function destroy($id)
    {
        $ternak = Ternak::findOrFail($id);
        $ternak->delete();

        return redirect()->route('petani-dashboard')->with('success', 'Data ternak berhasil dihapus.');
    }
}
