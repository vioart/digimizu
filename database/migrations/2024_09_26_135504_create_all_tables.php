<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Modify existing users table instead of creating a new one
        Schema::table('users', function (Blueprint $table) {
            $table->string('asal_instansi')->nullable();
            $table->string('image')->nullable();
            $table->enum('role', ['admin', 'anggota_magang'])->default('anggota_magang');
            $table->boolean('is_active')->default(true);
        });

        Schema::create('calon_magang', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('asal_instansi');
            $table->string('image')->nullable();
            $table->integer('test_score')->nullable();
            $table->timestamp('test_date')->nullable();
            $table->timestamps();
        });

        Schema::create('soal_test', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->string('pilihan_a');
            $table->string('pilihan_b');
            $table->string('pilihan_c');
            $table->string('pilihan_d');
            $table->string('jawaban_benar');
            $table->timestamps();
        });

        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('foto');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

        Schema::create('izin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tanggal');
            $table->text('alasan');
            $table->string('bukti')->nullable();
            $table->enum('status', ['pending', 'disetujui', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('izin');
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('soal_test');
        Schema::dropIfExists('calon_magang');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['asal_instansi', 'image', 'role', 'is_active']);
        });
    }
};