<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;

    protected $fillable = ['acara_id', 'siswa_id', 'ekskul_id', 'keterangan'];

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }
    public function siswa_ekskul()
    {
        return $this->belongsTo(SiswaEkskul::class);
    }

}