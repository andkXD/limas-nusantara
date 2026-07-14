<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    protected $table = 'kontens';
    protected $primaryKey = 'id_konten';

    protected $fillable = ['id_admin', 'judul_konten', 'jenis_konten', 'isi_konten', 'tanggal_publikasi'];

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}