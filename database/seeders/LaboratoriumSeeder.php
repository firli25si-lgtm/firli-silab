<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaboratoriumSeeder extends Seeder
{
    public function run(): void
    {
        // Seed laboratoriums
        $labs = [
            [
                'kode_lab'          => 'LAB-001',
                'nama_lab'          => 'Lab Jaringan Komputer',
                'kapasitas'         => 30,
                'lokasi'            => 'Gedung A, Lantai 2',
                'penanggung_jawab'  => 'Dr. Budi Santoso, M.Kom',
                'status'            => 'aktif',
                'deskripsi'         => 'Laboratorium untuk praktikum jaringan komputer, routing, switching, dan konfigurasi server.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_lab'          => 'LAB-002',
                'nama_lab'          => 'Lab Pemrograman Web',
                'kapasitas'         => 35,
                'lokasi'            => 'Gedung A, Lantai 3',
                'penanggung_jawab'  => 'Ibu Sari Dewi, S.Kom, M.T',
                'status'            => 'aktif',
                'deskripsi'         => 'Laboratorium pengembangan web, meliputi HTML, CSS, JavaScript, PHP, dan framework modern.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_lab'          => 'LAB-003',
                'nama_lab'          => 'Lab Basis Data',
                'kapasitas'         => 25,
                'lokasi'            => 'Gedung B, Lantai 1',
                'penanggung_jawab'  => 'Bpk. Ahmad Fauzi, M.Sc',
                'status'            => 'aktif',
                'deskripsi'         => 'Lab khusus praktikum basis data relasional dan non-relasional.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'kode_lab'          => 'LAB-004',
                'nama_lab'          => 'Lab Kecerdasan Buatan',
                'kapasitas'         => 20,
                'lokasi'            => 'Gedung B, Lantai 2',
                'penanggung_jawab'  => 'Dr. Rina Wulandari, M.Kom',
                'status'            => 'maintenance',
                'deskripsi'         => 'Lab AI dan Machine Learning, sedang dalam proses upgrade hardware GPU.',
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ];

        DB::table('laboratoriums')->insert($labs);

        // Seed jadwal_praktikums (Query Builder style)
        $jadwals = [
            // Lab Jaringan Komputer (id=1)
            ['laboratorium_id' => 1, 'mata_kuliah' => 'Jaringan Komputer I',    'dosen_pengampu' => 'Dr. Budi Santoso',   'hari' => 'Senin',  'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'kapasitas_peserta' => 30, 'keterangan' => 'Kelas A', 'created_at' => now(), 'updated_at' => now()],
            ['laboratorium_id' => 1, 'mata_kuliah' => 'Administrasi Jaringan',   'dosen_pengampu' => 'Bpk. Hendra Kusuma', 'hari' => 'Rabu',   'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'kapasitas_peserta' => 28, 'keterangan' => null,       'created_at' => now(), 'updated_at' => now()],
            ['laboratorium_id' => 1, 'mata_kuliah' => 'Keamanan Jaringan',       'dosen_pengampu' => 'Ibu Maya Puspita',   'hari' => 'Jumat',  'jam_mulai' => '10:00', 'jam_selesai' => '12:00', 'kapasitas_peserta' => 25, 'keterangan' => null,       'created_at' => now(), 'updated_at' => now()],
            // Lab Pemrograman Web (id=2)
            ['laboratorium_id' => 2, 'mata_kuliah' => 'Pemrograman Web Lanjut',  'dosen_pengampu' => 'Ibu Sari Dewi',      'hari' => 'Selasa', 'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'kapasitas_peserta' => 35, 'keterangan' => 'Kelas A & B', 'created_at' => now(), 'updated_at' => now()],
            ['laboratorium_id' => 2, 'mata_kuliah' => 'Framework Laravel',       'dosen_pengampu' => 'Bpk. Dodi Rahmat',   'hari' => 'Kamis',  'jam_mulai' => '13:00', 'jam_selesai' => '16:00', 'kapasitas_peserta' => 30, 'keterangan' => null,          'created_at' => now(), 'updated_at' => now()],
            // Lab Basis Data (id=3)
            ['laboratorium_id' => 3, 'mata_kuliah' => 'Basis Data Lanjut',       'dosen_pengampu' => 'Bpk. Ahmad Fauzi',  'hari' => 'Rabu',   'jam_mulai' => '08:00', 'jam_selesai' => '10:00', 'kapasitas_peserta' => 25, 'keterangan' => null,       'created_at' => now(), 'updated_at' => now()],
            ['laboratorium_id' => 3, 'mata_kuliah' => 'Sistem Basis Data',       'dosen_pengampu' => 'Ibu Lestari Hasan',  'hari' => 'Jumat',  'jam_mulai' => '13:00', 'jam_selesai' => '15:00', 'kapasitas_peserta' => 20, 'keterangan' => null,       'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('jadwal_praktikums')->insert($jadwals);
    }
}
