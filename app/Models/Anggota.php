<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Anggota extends Authenticatable
{
    use Notifiable;

    protected $table = 'anggotas';
    protected $primaryKey = 'id_anggota';

    protected $fillable = ['nama_anggota', 'email', 'password', 'status_keanggotaan'];
    protected $hidden = ['password'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_anggota', 'id_anggota');
    }
}