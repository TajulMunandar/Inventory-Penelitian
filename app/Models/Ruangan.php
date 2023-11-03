<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function Unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }

    public function Aset()
    {
        return $this->hasMany(Aset::class, 'idRuangan')->orderBy('id', 'DESC');
    }
}
