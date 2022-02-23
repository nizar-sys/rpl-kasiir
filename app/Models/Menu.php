<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['nama_menu', 'harga', 'deskripsi', 'stok', 'created_by'];
    protected $appends = ['harga_rp'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getHargaRpAttribute()
    {
        return 'Rp. ' . number_format($this->harga, 0, ',', '.');
    }
}
