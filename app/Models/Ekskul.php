<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'pembina_id','activity_date','start_time','end_time','activity_date2','start_time2','end_time2','location'];

     public function user()
    {
        return $this->belongsTo(User::class, 'pembina_id');
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class);
    }
    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class);
    }

    public function siswaekskul()
    {
        return $this->hasMany(SiswaEkskul::class, 'ekskul_id');
    }
        
    public function acara()
{
    return $this->hasMany(Acara::class);
}

public function presensi()
{
    return $this->hasMany(Presensi::class);
}

}