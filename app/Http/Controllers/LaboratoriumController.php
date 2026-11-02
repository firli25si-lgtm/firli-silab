<?php

namespace App\Http\Controllers;

use App\Models\Laboratorium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * CRUD 1 — Laboratorium menggunakan ELOQUENT ORM
 * Juga menangani tampilan Guest halaman laboratorium
 */
class LaboratoriumController extends Controller
{
    // ============================================================
    // ADMIN — ELOQUENT ORM
    // ============================================================

    /**
     * Tampilkan semua laboratorium (admin)
     * Eloquent: withCount, latest, paginate
     */
    public function index()
    {
        $laboratoriums = Laboratorium::withCount('jadwals')
            ->latest()
            ->paginate(10);

        return view('laboratorium.index', compact('laboratoriums'));
    }

    /**
     * Form tambah laboratorium baru
     */
    public function create()
    {
        $kode = Laboratorium::generateKodeLab();
        return view('laboratorium.create', compact('kode'));
    }

    /**
     * Simpan laboratorium baru ke database
     * Eloquent: create()
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_lab'         => 'required|string|max:20|unique:laboratoriums,kode_lab',
            'nama_lab'         => 'required|string|max:255',
            'kapasitas'        => 'required|integer|min:1',
            'lokasi'           => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'status'           => 'required|in:aktif,maintenance,nonaktif',
            'deskripsi'        => 'nullable|string',
        ]);

        Laboratorium::create($validated);

        return redirect()->route('laboratorium.index')
            ->with('success', 'Laboratorium berhasil ditambahkan.');
    }

    /**
     * Detail satu laboratorium beserta jadwalnya
     * Eloquent: findOrFail, with (eager loading)
     */
    public function show(string $id)
    {
        $laboratorium = Laboratorium::with(['jadwals' => function ($query) {
            $query->orderBy('hari')->orderBy('jam_mulai');
        }])->findOrFail($id);

        return view('laboratorium.show', compact('laboratorium'));
    }

    /**
     * Form edit laboratorium
     * Eloquent: findOrFail
     */
    public function edit(string $id)
    {
        $laboratorium = Laboratorium::findOrFail($id);
        return view('laboratorium.edit', compact('laboratorium'));
    }

    /**
     * Update data laboratorium
     * Eloquent: $model->update()
     */
    public function update(Request $request, string $id)
    {
        $laboratorium = Laboratorium::findOrFail($id);

        $validated = $request->validate([
            'kode_lab'         => 'required|string|max:20|unique:laboratoriums,kode_lab,' . $id,
            'nama_lab'         => 'required|string|max:255',
            'kapasitas'        => 'required|integer|min:1',
            'lokasi'           => 'required|string|max:255',
            'penanggung_jawab' => 'required|string|max:255',
            'status'           => 'required|in:aktif,maintenance,nonaktif',
            'deskripsi'        => 'nullable|string',
        ]);

        $laboratorium->update($validated);

        return redirect()->route('laboratorium.index')
            ->with('success', 'Data laboratorium berhasil diperbarui.');
    }

    /**
     * Hapus laboratorium (cascade ke jadwal otomatis)
     * Eloquent: $model->delete()
     */
    public function destroy(string $id)
    {
        $laboratorium = Laboratorium::findOrFail($id);
        $laboratorium->delete();

        return redirect()->route('laboratorium.index')
            ->with('success', 'Laboratorium berhasil dihapus.');
    }

    // ============================================================
    // GUEST — Halaman Publik (tanpa login)
    // ============================================================

    /**
     * Halaman guest: daftar semua lab yang aktif/maintenance
     * Eloquent: where, withCount, get
     */
    public function indexGuest()
    {
        $laboratoriums = Laboratorium::withCount('jadwals')
            ->where('status', '!=', 'nonaktif')
            ->orderBy('nama_lab')
            ->get();

        return view('guest.laboratorium', compact('laboratoriums'));
    }

    /**
     * Halaman guest: detail satu lab + jadwal (pakai Query Builder untuk join)
     */
    public function showGuest(string $id)
    {
        // Ambil data lab pakai Eloquent
        $laboratorium = Laboratorium::findOrFail($id);

        // Ambil jadwal pakai Query Builder (leftJoin agar terbaca nama lab)
        $jadwals = DB::table('jadwal_praktikums')
            ->leftJoin('laboratoriums', 'jadwal_praktikums.laboratorium_id', '=', 'laboratoriums.id')
            ->select(
                'jadwal_praktikums.*',
                'laboratoriums.nama_lab',
                'laboratoriums.lokasi'
            )
            ->where('jadwal_praktikums.laboratorium_id', $id)
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('guest.laboratorium-detail', compact('laboratorium', 'jadwals'));
    }
}
