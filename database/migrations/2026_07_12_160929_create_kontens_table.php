<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kontens', function (Blueprint $table) {
            $table->id('id_konten');
            $table->foreignId('id_admin')->constrained('admins', 'id_admin')->onDelete('cascade');
            $table->string('judul_konten', 255);
            $table->enum('jenis_konten', ['E-kliping', 'Newsletter', 'Kegiatan']);
            $table->text('isi_konten')->nullable();
            $table->date('tanggal_publikasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kontens');
    }
};