<?php

namespace App\Http\Controllers;

use App\Models\Masa;

abstract class Controller
{
    public function getAktifNamaMasa()
    {
        return Masa::where('status_masa','1')->first()->nama_masa;
    }

    public function getIdAktifMasa()
    {
        return Masa::where('status_masa','1')->first()->id;
    } 

    public function getAktifSemesterMasa()
    {
        return Masa::where('status_masa','1')->first()->semester_masa;
    }
}
