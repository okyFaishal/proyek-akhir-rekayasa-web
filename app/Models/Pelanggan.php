<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    protected $fillable = [
        'nama_pelanggan',
        'email_pelanggan',
        'no_telepon_pelanggan',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_pelanggan', 'id_pelanggan');
    }
}
