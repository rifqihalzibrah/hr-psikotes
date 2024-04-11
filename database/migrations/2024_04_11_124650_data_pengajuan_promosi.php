<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_pengajuan_promosi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('nik')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('posisi')->nullable();
            $table->string('unit_divisi')->nullable();
            $table->string('departemen')->nullable();
            $table->date('tanggal_join')->nullable();
            $table->string('jabatan_saat_ini')->nullable();
            $table->string('jabatan_tujuan')->nullable();
            $table->string('golongan_saat_ini')->nullable();
            $table->string('golongan_tujuan')->nullable();
            $table->decimal('gaji_saat_ini', 10, 2)->nullable();
            $table->decimal('gaji_tujuan', 10, 2)->nullable();
            $table->text('alasan_promosi')->nullable();
            $table->text('evaluasi_atasan')->nullable();
            $table->text('rewards_prestasi')->nullable();
            $table->text('punishment_sanksi')->nullable();
            $table->string('riwayat_performance_tahun_pertama')->nullable();
            $table->string('riwayat_performance_tahun_kedua')->nullable();
            $table->string('riwayat_performance_tahun_ketiga')->nullable();
            $table->string('user_pengusul')->nullable();
            $table->string('atasan_pengusul')->nullable();
            $table->string('direktur_unit')->nullable();
            $table->string('hrd')->nullable();
            $table->string('pm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pengajuan_promosi');
    }
};
