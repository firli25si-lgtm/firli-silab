<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Alat::with('kategori');

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Filter by kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_alat', 'like', "%{$search}%")
                  ->orWhere('kode_alat', 'like', "%{$search}%");
            });
        }

        $alats = $query->latest()->paginate(12);
        $kategoris = Kategori::all();

        return view('alat.index', compact('alats', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('alat.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate kode alat
        $validated['kode_alat'] = Alat::generateKodeAlat($validated['kategori_id']);
        $validated['stok_tersedia'] = $validated['stok'];

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        Alat::create($validated);

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Alat $alat)
    {
        $alat->load(['kategori', 'peminjamanDetails.peminjaman.user']);
        return view('alat.show', compact('alat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Alat $alat)
    {
        $kategoris = Kategori::all();
        return view('alat.edit', compact('alat', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'lokasi' => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle gambar upload
        if ($request->hasFile('gambar')) {
            // Delete old gambar
            if ($alat->gambar) {
                Storage::disk('public')->delete($alat->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('alat', 'public');
        }

        $alat->update($validated);

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alat $alat)
    {
        // Check if alat is being used in peminjaman
        if ($alat->peminjamanDetails()->whereHas('peminjaman', function ($q) {
            $q->whereIn('status', ['menunggu', 'disetujui', 'dipinjam']);
        })->exists()) {
            return redirect()->route('alat.index')
                ->with('error', 'Alat tidak dapat dihapus karena sedang digunakan dalam peminjaman.');
        }

        // Delete gambar
        if ($alat->gambar) {
            Storage::disk('public')->delete($alat->gambar);
        }

        $alat->delete();

        return redirect()->route('alat.index')
            ->with('success', 'Alat berhasil dihapus.');
    }

    /**
     * Update stock
     */
    public function updateStock(Request $request, Alat $alat)
    {
        $validated = $request->validate([
            'stok' => 'required|integer|min:0',
            'stok_tersedia' => 'required|integer|min:0|lte:stok',
        ]);

        $alat->update($validated);

        return redirect()->route('alat.show', $alat)
            ->with('success', 'Stok alat berhasil diperbarui.');
    }
}
