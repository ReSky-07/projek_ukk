<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{

    protected $fillable = [
        'judul',
        'stok',
        'gambar'
    ];
    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'buku_kategori');
    }
    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
