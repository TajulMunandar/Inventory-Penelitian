<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class aset extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Barang()
    {
        return $this->belongsTo(Barang::class, 'idBarang');
    }

    public function Ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'idRuangan');
    }
}
