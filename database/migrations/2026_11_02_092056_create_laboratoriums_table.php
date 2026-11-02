<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laboratoriums', function (Blueprint $table) {
            $table->id();
            $table->string('kode_lab', 20)->unique();
            $table->string('nama_lab');
            $table->integer('kapasitas')->default(0);
            $table->string('lokasi');
            $table->string('penanggung_jawab');
            $table->enum('status', ['aktif', 'maintenance', 'nonaktif'])->default('aktif');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laboratoriums');
    }
};
