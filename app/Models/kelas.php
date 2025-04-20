<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
 protected $fillable = [
    'tingkat',
    'jurusan_id',
    'gelombang_belajar_id'
];

public function jurusan()
{
    return $this->belongsTo(Jurusan::class);
}

public function gelombang()
{
    return $this->belongsTo(Gelombang_belajar::class);
}

}