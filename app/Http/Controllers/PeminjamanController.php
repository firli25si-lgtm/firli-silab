<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\PeminjamanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $query = Peminjaman::with(['user', 'details.alat']);

        // If regular user, only show their own peminjaman
        if (!$user->is_admin) {
            $query->where('user_id', $user->id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('dari_tanggal')) {
            $query->where('tanggal_pinjam', '>=', $request->dari_tanggal);
        }
        if ($request->filled('sampai_tanggal')) {
            $query->where('tanggal_pinjam', '<=', $request->sampai_tanggal);
        }

        $peminjamen = $query->latest()->paginate(10);

        return view('peminjaman.index', compact('peminjamen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $alats = Alat::with('kategori')
            ->where('stok_tersedia', '>', 0)
            ->where('kondisi', '!=', 'rusak_berat')
            ->get();
        
        return view('peminjaman.create', compact('alats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali_rencana' => 'required|date|after:tanggal_pinjam',
            'keperluan' => 'required|string|max:500',
            'alat_id' => 'required|array|min:1',
            'alat_id.*' => 'required|exists:alats,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Create peminjaman
            $peminjaman = Peminjaman::create([
                'kode_peminjaman' => Peminjaman::generateKodePeminjaman(),
                'user_id' => Auth::id(),
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali_rencana' => $validated['tanggal_kembali_rencana'],
                'keperluan' => $validated['keperluan'],
                'status' => 'menunggu',
            ]);

            // Create peminjaman details
            foreach ($validated['alat_id'] as $index => $alatId) {
                $alat = Alat::findOrFail($alatId);
                
                // Check stock availability
                if ($alat->stok_tersedia < $validated['jumlah'][$index]) {
                    throw new \Exception("Stok {$alat->nama_alat} tidak mencukupi.");
                }

                PeminjamanDetail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $alatId,
                    'jumlah' => $validated['jumlah'][$index],
                    'kondisi_sebelum' => $alat->kondisi,
                ]);
            }

            DB::commit();

            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil diajukan. Menunggu persetujuan.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        $peminjaman->load(['user', 'approver', 'details.alat.kategori']);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        if (!$peminjaman->canBeEdited()) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Peminjaman tidak dapat diedit.');
        }

        $alats = Alat::with('kategori')
            ->where('stok_tersedia', '>', 0)
            ->where('kondisi', '!=', 'rusak_berat')
            ->get();

        $peminjaman->load('details.alat');

        return view('peminjaman.edit', compact('peminjaman', 'alats'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        if (!$peminjaman->canBeEdited()) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Peminjaman tidak dapat diedit.');
        }

        $validated = $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali_rencana' => 'required|date|after:tanggal_pinjam',
            'keperluan' => 'required|string|max:500',
            'alat_id' => 'required|array|min:1',
            'alat_id.*' => 'required|exists:alats,id',
            'jumlah' => 'required|array|min:1',
            'jumlah.*' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Update peminjaman
            $peminjaman->update([
                'tanggal_pinjam' => $validated['tanggal_pinjam'],
                'tanggal_kembali_rencana' => $validated['tanggal_kembali_rencana'],
                'keperluan' => $validated['keperluan'],
            ]);

            // Delete old details
            $peminjaman->details()->delete();

            // Create new details
            foreach ($validated['alat_id'] as $index => $alatId) {
                $alat = Alat::findOrFail($alatId);
                
                if ($alat->stok_tersedia < $validated['jumlah'][$index]) {
                    throw new \Exception("Stok {$alat->nama_alat} tidak mencukupi.");
                }

                PeminjamanDetail::create([
                    'peminjaman_id' => $peminjaman->id,
                    'alat_id' => $alatId,
                    'jumlah' => $validated['jumlah'][$index],
                    'kondisi_sebelum' => $alat->kondisi,
                ]);
            }

            DB::commit();

            return redirect()->route('peminjaman.index')
                ->with('success', 'Peminjaman berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        if (!$peminjaman->canBeCancelled()) {
            return redirect()->route('peminjaman.index')
                ->with('error', 'Peminjaman tidak dapat dibatalkan.');
        }

        $peminjaman->details()->delete();
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')
            ->with('success', 'Peminjaman berhasil dibatalkan.');
    }

    /**
     * Approve peminjaman (Admin only)
     */
    public function approve(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman tidak dapat disetujui.');
        }

        DB::beginTransaction();
        try {
            // Update stok tersedia
            foreach ($peminjaman->details as $detail) {
                $alat = $detail->alat;
                if ($alat->stok_tersedia < $detail->jumlah) {
                    throw new \Exception("Stok {$alat->nama_alat} tidak mencukupi.");
                }
                $alat->decrement('stok_tersedia', $detail->jumlah);
            }

            $peminjaman->update([
                'status' => 'disetujui',
                'approved_by' => Auth::id(),
                'approved_at' => now(),
            ]);

            DB::commit();

            return back()->with('success', 'Peminjaman berhasil disetujui.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Reject peminjaman (Admin only)
     */
    public function reject(Request $request, Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'menunggu') {
            return back()->with('error', 'Peminjaman tidak dapat ditolak.');
        }

        $validated = $request->validate([
            'catatan' => 'nullable|string|max:500',
        ]);

        $peminjaman->update([
            'status' => 'ditolak',
            'catatan' => $validated['catatan'] ?? null,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Peminjaman berhasil ditolak.');
    }

    /**
     * Mark as borrowed (Admin only)
     */
    public function markAsBorrowed(Peminjaman $peminjaman)
    {
        if ($peminjaman->status !== 'disetujui') {
            return back()->with('error', 'Peminjaman tidak dapat diproses.');
        }

        $peminjaman->update(['status' => 'dipinjam']);

        return back()->with('success', 'Status peminjaman berhasil diubah menjadi dipinjam.');
    }

    /**
     * Return peminjaman (Admin only)
     */
    public function returnItem(Request $request, Peminjaman $peminjaman)
    {
        if (!in_array($peminjaman->status, ['dipinjam', 'terlambat'])) {
            return back()->with('error', 'Peminjaman tidak dapat dikembalikan.');
        }

        $validated = $request->validate([
            'kondisi_sesudah' => 'required|array',
            'kondisi_sesudah.*' => 'required|in:baik,rusak_ringan,rusak_berat',
            'catatan_item' => 'nullable|array',
            'catatan_item.*' => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {
            // Update details
            foreach ($peminjaman->details as $detail) {
                $detail->update([
                    'kondisi_sesudah' => $validated['kondisi_sesudah'][$detail->id] ?? 'baik',
                    'catatan' => $validated['catatan_item'][$detail->id] ?? null,
                ]);

                // Return stock
                $detail->alat->increment('stok_tersedia', $detail->jumlah);

                // Update alat condition if needed
                if ($validated['kondisi_sesudah'][$detail->id] !== 'baik') {
                    $detail->alat->update(['kondisi' => $validated['kondisi_sesudah'][$detail->id]]);
                }
            }

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_kembali_aktual' => now(),
            ]);

            DB::commit();

            return back()->with('success', 'Alat berhasil dikembalikan.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }
}
