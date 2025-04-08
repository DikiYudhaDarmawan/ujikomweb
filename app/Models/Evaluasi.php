<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluasi extends Model
{
    use HasFactory;
    protected $fillable = ['siswa_id', 'pembina_id', 'ekskul_id', 'grade', 'description'];

    public function ekskul()
    {
        return $this->belongsTo(Ekskul::class, 'ekskul_id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
    public function pembina()
    {
        return $this->belongsTo(User::class, 'pembina_id');
    }

}