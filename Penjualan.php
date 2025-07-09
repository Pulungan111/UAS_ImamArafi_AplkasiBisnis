<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = ['buku_id', 'tanggal', 'eksemplar'];

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}