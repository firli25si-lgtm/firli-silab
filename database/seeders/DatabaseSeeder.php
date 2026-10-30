<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name' => 'Admin SiLab',
            'email' => 'admin@silab.com',
            'is_admin' => true,
        ]);

        // Create test user
        User::factory()->create([
            'name' => 'User Test',
            'email' => 'user@silab.com',
            'is_admin' => false,
        ]);

        // Create kategoris
        $kategoris = [
            ['nama_kategori' => 'Elektronik', 'deskripsi' => 'Alat-alat elektronik laboratorium'],
            ['nama_kategori' => 'Optik', 'deskripsi' => 'Alat-alat optik dan mikroskop'],
            ['nama_kategori' => 'Kimia', 'deskripsi' => 'Peralatan dan bahan kimia'],
            ['nama_kategori' => 'Fisika', 'deskripsi' => 'Alat-alat eksperimen fisika'],
            ['nama_kategori' => 'Biologi', 'deskripsi' => 'Peralatan laboratorium biologi'],
        ];

        foreach ($kategoris as $kategori) {
            \App\Models\Kategori::create($kategori);
        }

        // Create sample alats
        $alats = [
            ['kode_alat' => 'ELE-0001', 'nama_alat' => 'Multimeter Digital', 'kategori_id' => 1, 'stok' => 10, 'stok_tersedia' => 10, 'kondisi' => 'baik', 'lokasi' => 'Rak A1'],
            ['kode_alat' => 'ELE-0002', 'nama_alat' => 'Oscilloscope', 'kategori_id' => 1, 'stok' => 5, 'stok_tersedia' => 5, 'kondisi' => 'baik', 'lokasi' => 'Rak A2'],
            ['kode_alat' => 'OPT-0001', 'nama_alat' => 'Mikroskop Monokuler', 'kategori_id' => 2, 'stok' => 15, 'stok_tersedia' => 15, 'kondisi' => 'baik', 'lokasi' => 'Rak B1'],
            ['kode_alat' => 'OPT-0002', 'nama_alat' => 'Mikroskop Binokuler', 'kategori_id' => 2, 'stok' => 8, 'stok_tersedia' => 8, 'kondisi' => 'baik', 'lokasi' => 'Rak B2'],
            ['kode_alat' => 'KIM-0001', 'nama_alat' => 'Bunsen Burner', 'kategori_id' => 3, 'stok' => 20, 'stok_tersedia' => 20, 'kondisi' => 'baik', 'lokasi' => 'Rak C1'],
            ['kode_alat' => 'KIM-0002', 'nama_alat' => 'Tabung Reaksi', 'kategori_id' => 3, 'stok' => 100, 'stok_tersedia' => 100, 'kondisi' => 'baik', 'lokasi' => 'Rak C2'],
            ['kode_alat' => 'FIS-0001', 'nama_alat' => 'Neraca Digital', 'kategori_id' => 4, 'stok' => 6, 'stok_tersedia' => 6, 'kondisi' => 'baik', 'lokasi' => 'Rak D1'],
            ['kode_alat' => 'FIS-0002', 'nama_alat' => 'Stopwatch Digital', 'kategori_id' => 4, 'stok' => 25, 'stok_tersedia' => 25, 'kondisi' => 'baik', 'lokasi' => 'Rak D2'],
            ['kode_alat' => 'BIO-0001', 'nama_alat' => 'Pipet Tetes', 'kategori_id' => 5, 'stok' => 50, 'stok_tersedia' => 50, 'kondisi' => 'baik', 'lokasi' => 'Rak E1'],
            ['kode_alat' => 'BIO-0002', 'nama_alat' => 'Cawan Petri', 'kategori_id' => 5, 'stok' => 40, 'stok_tersedia' => 40, 'kondisi' => 'baik', 'lokasi' => 'Rak E2'],
        ];

        foreach ($alats as $alat) {
            \App\Models\Alat::create($alat);
        }
    }
}
