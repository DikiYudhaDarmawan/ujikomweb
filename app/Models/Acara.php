<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    protected $fillable = ['ekskul_id', 'nama', 'tanggal'];

    public function presensis()
    {
        return $this->hasMany(Presensi::class);
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class);
    }
}