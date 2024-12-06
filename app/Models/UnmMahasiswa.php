<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnmMahasiswa extends Model
{
    protected $guarded=[];

    public function lokasi_ujian()
    {
        return $this->belongsTo(LokasiUjian::class);
    }

    public function tempat_ujian()
    {
        return $this->belongsTo(TempatUjian::class);
    }
}
