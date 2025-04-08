<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';

    protected $fillable = ['ekskul_id', 'judul', 'description','foto'];

    // Relasi ke Ekskul
    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class);
    }
}