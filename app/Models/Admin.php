<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'admins';
    protected $primaryKey = 'id_admin';

    protected $fillable = ['nama_admin', 'username', 'password'];
    protected $hidden = ['password'];

    protected function casts(): array
    {
        return ['password' => 'hashed'];
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_admin', 'id_admin');
    }

    public function kontens()
    {
        return $this->hasMany(Konten::class, 'id_admin', 'id_admin');
    }
}