<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    protected $table = 'transaksis';
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        'id_anggota', 'id_buku', 'id_admin',
        'tanggal_pinjam', 'tanggal_jatuh_tempo', 'tanggal_kembali',
        'status_transaksi', 'denda',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pinjam' => 'date',
            'tanggal_jatuh_tempo' => 'date',
            'tanggal_kembali' => 'date',
        ];
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota', 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

    // Method hitungDenda() sesuai class diagram Bab 7 — Rp2.000/hari keterlambatan
    public function hitungDenda(): float
    {
        if (!$this->tanggal_kembali || !$this->tanggal_jatuh_tempo) {
            return 0;
        }
        $telat = Carbon::parse($this->tanggal_jatuh_tempo)->diffInDays(Carbon::parse($this->tanggal_kembali), false);
        return $telat > 0 ? $telat * 2000 : 0;
    }
}