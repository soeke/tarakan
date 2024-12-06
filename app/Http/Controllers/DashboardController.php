<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index_dashboard(){
        $masa = $this->getIdAktifMasa();
        $mahasiswa = UnmMahasiswa::with('tempat_ujian','lokasi_ujian')->where('id',$id)->where('masa_id',$masa)->first();
        //count info
        $mtk_11 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
              ->where('kode_mtk_11', '!=', NULL)->count();    
        $mtk_12 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_12', '!=', NULL)->count();
        $mtk_13 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_13', '!=', NULL)->count();
        $mtk_14 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_14', '!=', NULL)->count();
        $mtk_15 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_15', '!=', NULL)->count();
        $mtk_21= UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_21', '!=', NULL)->count();
        $mtk_22 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_22', '!=', NULL)->count();
        $mtk_23 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_23', '!=', NULL)->count();
        $mtk_24 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_24', '!=', NULL)->count();
        $mtk_25 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_25', '!=', NULL)->count();
        return view('index_dashboard', compact('masa'));
    }
}
