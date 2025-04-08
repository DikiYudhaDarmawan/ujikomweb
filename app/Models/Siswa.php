<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['id_user', 'jenis_kelamin', 'kelas_id', 'jurusan_id', 'gelombang_belajar_id', 'nomor_telp'];

    public function siswa_ekskul()
    {
        return $this->hasMany(SiswaEkskul::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
    public function gelombang()
    {
        return $this->belongsTo(Gelombang_belajar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function ekskuls()
    {
        return $this->belongsToMany(Ekskul::class, 'siswa_ekskuls', 'siswa_id', 'ekskul_id')
            ->withPivot('joined_at')
            ->withTimestamps();
    }
}