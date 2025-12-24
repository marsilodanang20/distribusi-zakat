<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Muzakki extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'muzakki';

    /**
     * Relasi ke tabel PengumpulanZakat
     * Satu Muzakki bisa memiliki banyak PengumpulanZakat
     */
    public function pengumpulanZakat()
    {
        return $this->hasMany(PengumpulanZakat::class, 'muzakki_id', 'id');
    }
}
