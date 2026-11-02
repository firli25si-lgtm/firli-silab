<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * CRUD 2 — Jadwal Praktikum menggunakan QUERY BUILDER (DB::table)
 * Tidak menggunakan Eloquent Model untuk operasi CRUD
 */
class JadwalPraktikumController extends Controller
{
    /**
     * Tampilkan semua jadwal praktikum
     * Query Builder: leftJoin, select, paginate
     */
    public function index(Request $request)
    {
        $query = DB::table('jadwal_praktikums')
            ->leftJoin('laboratoriums', 'jadwal_praktikums.laboratorium_id', '=', 'laboratoriums.id')
            ->select(
                'jadwal_praktikums.*',
                'laboratoriums.nama_lab',
                'laboratoriums.kode_lab',
                'laboratoriums.lokasi'
            );

        // Filter by hari (nested where contoh)
        if ($request->filled('hari')) {
            $query->where('jadwal_praktikums.hari', $request->hari);
        }

        // Filter by laboratorium
        if ($request->filled('lab')) {
            $query->where('jadwal_praktikums.laboratorium_id', $request->lab);
        }

        // Search mata kuliah
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('jadwal_praktikums.mata_kuliah', 'like', "%{$search}%")
                  ->orWhere('jadwal_praktikums.dosen_pengampu', 'like', "%{$search}%")
                  ->orWhere('laboratoriums.nama_lab', 'like', "%{$search}%");
            });
        }

        $jadwals = $query->orderByRaw("FIELD(jadwal_praktikums.hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jadwal_praktikums.jam_mulai')
            ->paginate(10)
            ->withQueryString();

        // Ambil list lab untuk dropdown filter
        $labs = DB::table('laboratoriums')->select('id', 'nama_lab', 'kode_lab')->orderBy('nama_lab')->get();

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('jadwal-praktikum.index', compact('jadwals', 'labs', 'hariList'));
    }

    /**
     * Form tambah jadwal baru
     */
    public function create()
    {
        // Query Builder: ambil semua lab untuk dropdown
        $labs = DB::table('laboratoriums')
            ->where('status', 'aktif')
            ->select('id', 'nama_lab', 'kode_lab')
            ->orderBy('nama_lab')
            ->get();

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('jadwal-praktikum.create', compact('labs', 'hariList'));
    }

    /**
     * Simpan jadwal baru
     * Query Builder: insert()
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'laboratorium_id'  => 'required|exists:laboratoriums,id',
            'mata_kuliah'      => 'required|string|max:255',
            'dosen_pengampu'   => 'required|string|max:255',
            'hari'             => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'        => 'required|date_format:H:i',
            'jam_selesai'      => 'required|date_format:H:i|after:jam_mulai',
            'kapasitas_peserta'=> 'required|integer|min:1',
            'keterangan'       => 'nullable|string',
        ]);

        DB::table('jadwal_praktikums')->insert([
            ...$validated,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('jadwal-praktikum.index')
            ->with('success', 'Jadwal praktikum berhasil ditambahkan.');
    }

    /**
     * Form edit jadwal
     * Query Builder: where, first()
     */
    public function edit(string $id)
    {
        $jadwal = DB::table('jadwal_praktikums')->where('id', $id)->first();

        if (!$jadwal) {
            abort(404, 'Jadwal tidak ditemukan.');
        }

        $labs = DB::table('laboratoriums')
            ->select('id', 'nama_lab', 'kode_lab')
            ->orderBy('nama_lab')
            ->get();

        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        return view('jadwal-praktikum.edit', compact('jadwal', 'labs', 'hariList'));
    }

    /**
     * Update jadwal
     * Query Builder: where()->update()
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'laboratorium_id'  => 'required|exists:laboratoriums,id',
            'mata_kuliah'      => 'required|string|max:255',
            'dosen_pengampu'   => 'required|string|max:255',
            'hari'             => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'        => 'required|date_format:H:i',
            'jam_selesai'      => 'required|date_format:H:i|after:jam_mulai',
            'kapasitas_peserta'=> 'required|integer|min:1',
            'keterangan'       => 'nullable|string',
        ]);

        DB::table('jadwal_praktikums')
            ->where('id', $id)
            ->update([
                ...$validated,
                'updated_at' => now(),
            ]);

        return redirect()->route('jadwal-praktikum.index')
            ->with('success', 'Jadwal praktikum berhasil diperbarui.');
    }

    /**
     * Hapus jadwal
     * Query Builder: where()->delete()
     */
    public function destroy(string $id)
    {
        DB::table('jadwal_praktikums')->where('id', $id)->delete();

        return redirect()->route('jadwal-praktikum.index')
            ->with('success', 'Jadwal praktikum berhasil dihapus.');
    }
}
