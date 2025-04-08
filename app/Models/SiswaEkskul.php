<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaEkskul extends Model
{
    use HasFactory;
   protected $fillable = ['siswa_id', 'ekskul_id', 'joined_at'];

   public function siswa()
   {
       return $this->belongsTo(Siswa::class, 'siswa_id');
   }

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }

    public function presensi()
{
    return $this->hasOne(Presensi::class, 'siswa_id', 'siswa_id');
}


}