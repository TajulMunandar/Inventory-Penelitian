<?php

namespace App\Models;

use App\Models\DetailPeminjaman;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Variant()
    {
        return $this->belongsTo(variant::class, 'idVariant');
    }

    public function Aset()
    {
        return $this->hasMany(Aset::class, 'idBarang')->orderBy('id', 'DESC');
    }
}
