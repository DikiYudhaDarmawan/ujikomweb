<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gelombang_belajar extends Model
{
    use HasFactory;
     protected $fillable = ['gelombang'];
    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'gelombang_belajar_id');
    }
}