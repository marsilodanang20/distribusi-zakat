<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mustahik extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'mustahik';

    /**
     * Relasi ke tabel DistribusiZakat
     * Satu Mustahik bisa memiliki banyak DistribusiZakat
     */
    public function distribusiZakat()
    {
        return $this->hasMany(DistribusiZakat::class, 'mustahik_id', 'id');
    }
}
