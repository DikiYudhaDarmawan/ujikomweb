<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = ['tingkat'];
    public function siswa()
    {
        return $this->hasOne(related: Siswa::class);
    }
}