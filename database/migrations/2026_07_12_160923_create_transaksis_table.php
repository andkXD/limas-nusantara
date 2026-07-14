<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->foreignId('id_anggota')->constrained('anggotas', 'id_anggota')->onDelete('cascade');
            $table->foreignId('id_buku')->constrained('bukus', 'id_buku')->onDelete('cascade');
            $table->foreignId('id_admin')->nullable()->constrained('admins', 'id_admin')->onDelete('set null');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_kembali')->nullable();
            $table->enum('status_transaksi', ['Dipinjam', 'Dikembalikan', 'Terlambat'])->default('Dipinjam');
            $table->decimal('denda', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};