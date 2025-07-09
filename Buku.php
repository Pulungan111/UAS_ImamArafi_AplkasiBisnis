<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'pengarang', 'kategori'];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function getTerjualAttribute()
    {
        return $this->penjualans->sum('eksemplar');
    }
}