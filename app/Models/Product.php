<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama',
        'deskripsi',
        'harga',
        'stok',
        'foto',
    ];

    /**
     * Relasi dengan model Category (setiap produk milik satu kategori)
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id');
    }
}
