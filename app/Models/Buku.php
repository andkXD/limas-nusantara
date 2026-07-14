<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';
    protected $primaryKey = 'id_buku';

    protected $fillable = ['judul_buku', 'pengarang', 'penerbit', 'tahun_terbit', 'kategori', 'stok'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_buku', 'id_buku');
    }
}