<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\JadwalUtm;
use App\Models\MataKuliah;
use App\Models\LokasiUjian;
use App\Models\TempatUjian;
use App\Models\UnmMahasiswa;
use App\Models\WilayahUjian;
use Illuminate\Http\Request;
use App\Models\UnmMahasiswaDetail;
use App\Models\Tmp_proses_d20an_pesut_tunggal;

class UjianBackendController extends Controller
{
    public function index_unm(){
        $masa = $this->getAktifNamaMasa();
        return view('utm.backend.index_backend_unm', compact('masa'));
    }

    public function add_unm(Request $request)
    {
        $nim = $request->get('nim');
        $masa = $this->getIdAktifMasa(); 
        $jadwal_utm = JadwalUtm::where('masa_id', $masa)->first();
        $NumpangMasukMahasiswa = UnmMahasiswa::where('nim', $nim)->where('masa_id',$masa)->first();
        
        //api
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MjAxODY3LCJuYW1hIjoiU3VrYWVsYW4iLCJncm91cF91c2VyIjoiT3BlcmF0b3IgVVBCSkoiLCJpYXQiOjE3MzMwMTk2NjYsImV4cCI6MTczNTYxMTY2Nn0.6HIGN7-Ky5bLbMBSdIIY48CNuTUoK_GTEnRhcTxj62E';
        $client = new Client();
        $response = $client->request('GET', 'https://api-srs-dev.ut.ac.id/api-srs-mahasiswa/v1/data-pribadi/'. $nim, [
            'headers'   => [
               'Accept'        => 'application/json',
                'Authorization' => 'Bearer ' . $token, 
            ],
        ]);
        $mahasiswa = json_decode($response->getBody()->getContents())->data;

        if($NumpangMasukMahasiswa)
        {
          $notification = array(
            'message' => 'Mahasiswa numpang masuk UTM sudah terdaftar',
            'alert-type' => 'warning'
          ); 
          return redirect()->route('show_backend_unm', $NumpangMasukMahasiswa->id)->with($notification);
        }

        if($mahasiswa == null){
            $notification = array(
                'message' => 'Data tidak ditemukan',
                'alert-type' => 'error'
            ); 
            return redirect()->route('index_backend_unm')->with($notification);
        }
        
        $mahasiswa1 = Tmp_proses_d20an_pesut_tunggal::where('tmp_proses_d20an_pesut_tunggal.nim', $nim)
        ->where('tmp_proses_d20an_pesut_tunggal.hari','1') //h1
        ->join('tmp_proses_d20an_biner_tunggal', function($join)
              {
                  $join->on('tmp_proses_d20an_biner_tunggal.nim','tmp_proses_d20an_pesut_tunggal.nim')
                      ->on('tmp_proses_d20an_biner_tunggal.hari','tmp_proses_d20an_pesut_tunggal.hari');   
              })
        ->select( 'tmp_proses_d20an_pesut_tunggal.ruang',
                'tmp_proses_d20an_pesut_tunggal.kursi',
                'tmp_proses_d20an_pesut_tunggal.kode_tempat_ujian',
                'tmp_proses_d20an_biner_tunggal.kode_mtk_1','tmp_proses_d20an_biner_tunggal.kode_mtk_2','tmp_proses_d20an_biner_tunggal.kode_mtk_3','tmp_proses_d20an_biner_tunggal.kode_mtk_4','tmp_proses_d20an_biner_tunggal.kode_mtk_5')->first();
    
        $mahasiswa2 = Tmp_proses_d20an_pesut_tunggal::where('tmp_proses_d20an_pesut_tunggal.nim', $nim)
            ->where('tmp_proses_d20an_pesut_tunggal.hari','2') //h2
            ->join('tmp_proses_d20an_biner_tunggal', function($join)
                  {
                      $join->on('tmp_proses_d20an_biner_tunggal.nim','tmp_proses_d20an_pesut_tunggal.nim')
                          ->on('tmp_proses_d20an_biner_tunggal.hari','tmp_proses_d20an_pesut_tunggal.hari');   
                  })
            ->select( 'tmp_proses_d20an_pesut_tunggal.ruang',
                    'tmp_proses_d20an_pesut_tunggal.kursi',
                    'tmp_proses_d20an_pesut_tunggal.kode_tempat_ujian',
                    'tmp_proses_d20an_biner_tunggal.kode_mtk_1','tmp_proses_d20an_biner_tunggal.kode_mtk_2','tmp_proses_d20an_biner_tunggal.kode_mtk_3','tmp_proses_d20an_biner_tunggal.kode_mtk_4','tmp_proses_d20an_biner_tunggal.kode_mtk_5')->first();            

        if($mahasiswa1 != null){
                $kode_tempat_ujian = $mahasiswa1->kode_tempat_ujian;
        }elseif($mahasiswa2 != null){
                $kode_tempat_ujian = $mahasiswa2->kode_tempat_ujian;
        }

        $tempat_ujian = WilayahUjian::join('upbjj','upbjj.kode_upbjj','=','wilayah_ujians.kode_upbjj')->where('kode_wilayah_ujian', $kode_tempat_ujian)
                        ->select('kode_wilayah_ujian','nama_wilayah_ujian','wilayah_ujians.kode_upbjj','nama_upbjj')->first();
        
        $mahasiswa1_mtk1=MataKuliah::where('kode_mtk',$mahasiswa1?->kode_mtk_1)->pluck('nama_mtk_singkat')->first();
        $mahasiswa1_mtk2=MataKuliah::where('kode_mtk',$mahasiswa1?->kode_mtk_2)->pluck('nama_mtk_singkat')->first();
        $mahasiswa1_mtk3=MataKuliah::where('kode_mtk',$mahasiswa1?->kode_mtk_3)->pluck('nama_mtk_singkat')->first();
        $mahasiswa1_mtk4=MataKuliah::where('kode_mtk',$mahasiswa1?->kode_mtk_4)->pluck('nama_mtk_singkat')->first();
        $mahasiswa1_mtk5=MataKuliah::where('kode_mtk',$mahasiswa1?->kode_mtk_5)->pluck('nama_mtk_singkat')->first();

        $mahasiswa2_mtk1=MataKuliah::where('kode_mtk',$mahasiswa2?->kode_mtk_1)->pluck('nama_mtk_singkat')->first();
        $mahasiswa2_mtk2=MataKuliah::where('kode_mtk',$mahasiswa2?->kode_mtk_2)->pluck('nama_mtk_singkat')->first();
        $mahasiswa2_mtk3=MataKuliah::where('kode_mtk',$mahasiswa2?->kode_mtk_3)->pluck('nama_mtk_singkat')->first();
        $mahasiswa2_mtk4=MataKuliah::where('kode_mtk',$mahasiswa2?->kode_mtk_4)->pluck('nama_mtk_singkat')->first();
        $mahasiswa2_mtk5=MataKuliah::where('kode_mtk',$mahasiswa2?->kode_mtk_5)->pluck('nama_mtk_singkat')->first();

        return view('utm.backend.add_backend_unm', compact('tempat_ujian','jadwal_utm','masa','mahasiswa','mahasiswa1','mahasiswa2','mahasiswa1_mtk1','mahasiswa1_mtk2',
        'mahasiswa1_mtk3','mahasiswa1_mtk4','mahasiswa1_mtk5','mahasiswa2_mtk1','mahasiswa2_mtk2','mahasiswa2_mtk3','mahasiswa2_mtk4','mahasiswa2_mtk5'));

    }

    public function store_unm(Request $request)
    {

        $masa = $this->getIdAktifMasa();
        $nim = $request->get('nim');
        $mhs = UnmMahasiswa::where('nim', $nim)->where('masa_id', $masa)->first();
        if($mhs){
          $notification = array(
            'message' => 'Mahasiswa Numpang SUDAH TERDAFTAR',
            'alert-type' => 'warning'
          ); 
          return redirect()->route('show_backend_unm', $mhs->id)->with($notification);    

        }else{
          $data = $request->all();
        //   dd($data);
          UnmMahasiswa::create($data);
          $mhs2 = UnmMahasiswa::where('nim', $nim)->where('masa_id', $masa)->first();

          if(!empty($request->input('kode_mtk_11')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_11;
                $NumpangMahasiswaDetail->jam_ujian = '11';
                $NumpangMahasiswaDetail->save();   
          }
          
          if(!empty($request->input('kode_mtk_12')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_12;
                $NumpangMahasiswaDetail->jam_ujian = '12';
                $NumpangMahasiswaDetail->save();   
          }
          
          if(!empty($request->input('kode_mtk_13')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_13;
                $NumpangMahasiswaDetail->jam_ujian = '13';
                $NumpangMahasiswaDetail->save();   
          }
          
          if(!empty($request->input('kode_mtk_14')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_14;
                $NumpangMahasiswaDetail->jam_ujian = '14';
                $NumpangMahasiswaDetail->save();   
          }
          
          if(!empty($request->input('kode_mtk_15')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_15;
                $NumpangMahasiswaDetail->jam_ujian = '15';
                $NumpangMahasiswaDetail->save();   
          }
          
          if(!empty($request->input('kode_mtk_21')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_21;
                $NumpangMahasiswaDetail->jam_ujian = '21';
                $NumpangMahasiswaDetail->save();   
          }
          
          
          if(!empty($request->input('kode_mtk_22')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_22;
                $NumpangMahasiswaDetail->jam_ujian = '22';
                $NumpangMahasiswaDetail->save();   
          }
          
          if(!empty($request->input('kode_mtk_23')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_23;
                $NumpangMahasiswaDetail->jam_ujian = '23';
                $NumpangMahasiswaDetail->save();   
          }
          
          if(!empty($request->input('kode_mtk_24')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_24;
                $NumpangMahasiswaDetail->jam_ujian = '24';
                $NumpangMahasiswaDetail->save();   
          }
          
          if(!empty($request->input('kode_mtk_25')))
          {
                $NumpangMahasiswaDetail = New UnmMahasiswaDetail();
                $NumpangMahasiswaDetail->unm_mahasiswa_id = $mhs2->id;
                $NumpangMahasiswaDetail->masa_id = $mhs2->masa_id;
                $NumpangMahasiswaDetail->tempat_ujian_id = $mhs2->tempat_ujian_id;
                $NumpangMahasiswaDetail->kode_matakuliah = $mhs2->kode_mtk_25;
                $NumpangMahasiswaDetail->jam_ujian = '25';
                $NumpangMahasiswaDetail->save();   
          }
          

          $notification = array(
            'message' => 'Mahasiswa numpang tersimpan',
            'alert-type' => 'success'
          ); 
          return redirect()->route('show-backend.utm-numpang-masuk', $mhs2->id)->with($notification);
        }
        
    }

    public function show_unm($id)
    {
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

        $mtk_11_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_11', '!=', NULL)->count();    
        $mtk_12_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_12', '!=', NULL)->count();
        $mtk_13_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_13', '!=', NULL)->count();
        $mtk_14_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_14', '!=', NULL)->count();
        $mtk_15_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_15', '!=', NULL)->count();
        $mtk_21_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_21', '!=', NULL)->count();
        $mtk_22_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_22', '!=', NULL)->count();
        $mtk_23_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_23', '!=', NULL)->count();
        $mtk_24_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_24', '!=', NULL)->count();
        $mtk_25_r1 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 1')
                ->where('kode_mtk_25', '!=', NULL)->count();

        $mtk_11_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_11', '!=', NULL)->count();    
        $mtk_12_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_12', '!=', NULL)->count();
        $mtk_13_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_13', '!=', NULL)->count();
        $mtk_14_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_14', '!=', NULL)->count();
        $mtk_15_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_15', '!=', NULL)->count();
        $mtk_21_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_21', '!=', NULL)->count();
        $mtk_22_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_22', '!=', NULL)->count();
        $mtk_23_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_23', '!=', NULL)->count();
        $mtk_24_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_24', '!=', NULL)->count();
        $mtk_25_r2 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 2')
                ->where('kode_mtk_25', '!=', NULL)->count();
        
        $mtk_11_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_11', '!=', NULL)->count();    
        $mtk_12_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_12', '!=', NULL)->count();
        $mtk_13_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_13', '!=', NULL)->count();
        $mtk_14_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_14', '!=', NULL)->count();
        $mtk_15_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_15', '!=', NULL)->count();
        $mtk_21_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_21', '!=', NULL)->count();
        $mtk_22_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_22', '!=', NULL)->count();
        $mtk_23_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_23', '!=', NULL)->count();
        $mtk_24_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_24', '!=', NULL)->count();
        $mtk_25_r3 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 3')
                ->where('kode_mtk_25', '!=', NULL)->count();

        $mtk_11_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_11', '!=', NULL)->count();    
        $mtk_12_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_12', '!=', NULL)->count();
        $mtk_13_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_13', '!=', NULL)->count();
        $mtk_14_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_14', '!=', NULL)->count();
        $mtk_15_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_15', '!=', NULL)->count();
        $mtk_21_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_21', '!=', NULL)->count();
        $mtk_22_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_22', '!=', NULL)->count();
        $mtk_23_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_23', '!=', NULL)->count();
        $mtk_24_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_24', '!=', NULL)->count();
        $mtk_25_r4 = UnmMahasiswa::where('lokasi_ujian_id', $mahasiswa->lokasi_ujian_id)->where('masa_id',$masa)->where('ruang_ujian','Numpang 4')
                ->where('kode_mtk_25', '!=', NULL)->count();
        
        return view('utm.backend.show_backend_unm', compact('mahasiswa','mtk_11','mtk_12','mtk_13','mtk_14','mtk_15','mtk_21','mtk_22','mtk_23','mtk_24','mtk_25',
        'mtk_11_r1','mtk_12_r1','mtk_13_r1','mtk_14_r1','mtk_15_r1','mtk_21_r1','mtk_22_r1','mtk_23_r1','mtk_24_r1','mtk_25_r1',
        'mtk_11_r2','mtk_12_r2','mtk_13_r2','mtk_14_r2','mtk_15_r2','mtk_21_r2','mtk_22_r2','mtk_23_r2','mtk_24_r2','mtk_25_r2',
        'mtk_11_r3','mtk_12_r3','mtk_13_r3','mtk_14_r3','mtk_15_r3','mtk_21_r3','mtk_22_r3','mtk_23_r3','mtk_24_r3','mtk_25_r3',
        'mtk_11_r4','mtk_12_r4','mtk_13_r4','mtk_14_r4','mtk_15_r4','mtk_21_r4','mtk_22_r4','mtk_23_r4','mtk_24_r4','mtk_25_r4'));
    }

    public function edit_unm($id)
    {
        $masa = $this->getIdAktifMasa(); 
        $jadwal_utm = JadwalUtm::where('masa_id', $masa)->first();
        $mahasiswa = UnmMahasiswa::with('tempat_ujian','lokasi_ujian')->where('id',$id)->first();
        return view('utm.backend.edit_backend_unm', compact('mahasiswa','masa','jadwal_utm'));
    }

    public function update_unm(Request $request, $id)
    {
        //   $request->validate([
        //     'old_password' => 'required',
        //     'new_password' => 'required|confirmed',
        // ]);
        $masa = $this->getIdAktifMasa();
        $nim = $request->get('nim');
        $mhs = UnmMahasiswa::where('id', $id)->first();
        $mhs->tempat_ujian_id = $request->tempat_ujian_id;
        $mhs->lokasi_ujian_id = $request->lokasi_ujian_id;
        $mhs->ruang_ujian = $request->ruang_ujian;
        $mhs->save();
        
        $NumpangMahasiswaDetail = UnmMahasiswaDetail::where('unm_mahasiswa_id', $id)
                                ->where('masa_id', $masa)->get();

        foreach($NumpangMahasiswaDetail as $item)
        {
                $nmd = UnmMahasiswaDetail::where('id', $item->id)->first();
                $nmd->tempat_ujian_id = $request->tempat_ujian_id;
                $nmd->save(); 
        }
          
 
        $notification = array(
        'message' => 'Mahasiswa numpang tersimpan',
        'alert-type' => 'success'
        ); 
        return redirect()->route('show_backend_unm', $mhs->id)->with($notification);
        
        
    }

    public function print_ktpu_unm($id)
    {
        $masa = $this->getIdAktifMasa();
        $masa_semester = $this->getAktifSemesterMasa();
        $jadwal_utm = JadwalUtm::where('masa_id', $masa)->first();
        $mahasiswa = UnmMahasiswa::with('tempat_ujian','lokasi_ujian')->where('id',$id)->first();
        return view('utm.backend.print_ktpu_unm', compact('mahasiswa','jadwal_utm','masa_semester'));
    }

    public function show_all_unm(Request $request)
    {
      $masa = $this->getIdAktifMasa();
      $tempat_ujian_id = $request->get('tempat_ujian_id');
      if($tempat_ujian_id){
        $mahasiswa = UnmMahasiswa::with('tempat_ujian','lokasi_ujian')->where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                    ->OrderBy('id', 'DESC')->get();
      }else{
        $mahasiswa = UnmMahasiswa::with('tempat_ujian','lokasi_ujian')->OrderBy('id', 'DESC')->where('masa_id',$masa)->get();
      }
        
  
      return view('utm.backend.show_all_backend_unm', compact('mahasiswa'));
    }

    public function rekap_unm(Request $request){
      $masa = $this->getIdAktifMasa();
      $tempat_ujian_id = $request->get('tempat_ujian_id');
      $lokasi_ujian_id = $request->get('lokasi_ujian_id');
      $ruang_ujian = $request->get('ruang_ujian');

      
      if($tempat_ujian_id)
      {
        $tempat_ujian = TempatUjian::where('id', $tempat_ujian_id)->first()->nama_tempat_ujian;
      }else{
        $tempat_ujian="";
      }

      if($lokasi_ujian_id)
      {
        $lokasi_ujian = LokasiUjian::where('id', $lokasi_ujian_id)->first()->nama_lokasi_ujian;
      }else{
        $lokasi_ujian="";
      }
      
  
      if($ruang_ujian)
      {
        $mtk_11 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
              ->where('ruang_ujian', $ruang_ujian)
              ->where('kode_mtk_11', '!=', NULL)->count();
        $mtk_11_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_11', '!=', NULL)
                ->selectRaw('kode_mtk_11, count(*) as total')
                ->groupBy('kode_mtk_11')->get();      
        $mtk_12 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_12', '!=', NULL)->count();
        $mtk_12_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_12', '!=', NULL)
                ->selectRaw('kode_mtk_12, count(*) as total')
                ->groupBy('kode_mtk_12')->get();
        $mtk_13 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_13', '!=', NULL)->count();
        $mtk_13_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_13', '!=', NULL)
                ->selectRaw('kode_mtk_13, count(*) as total')
                ->groupBy('kode_mtk_13')->get();
        $mtk_14 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_14', '!=', NULL)->count();
        $mtk_14_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_14', '!=', NULL)
                ->selectRaw('kode_mtk_14, count(*) as total')
                ->groupBy('kode_mtk_14')->get();
        $mtk_15 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_15', '!=', NULL)->count();
        $mtk_15_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_15', '!=', NULL)
                ->selectRaw('kode_mtk_15, count(*) as total')
                ->groupBy('kode_mtk_15')->get();
        $mtk_21= UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_21', '!=', NULL)->count();
        $mtk_21_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_21', '!=', NULL)
                ->selectRaw('kode_mtk_21, count(*) as total')
                ->groupBy('kode_mtk_21')->get();
        $mtk_22 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_22', '!=', NULL)->count();
        $mtk_22_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_22', '!=', NULL)
                ->selectRaw('kode_mtk_22, count(*) as total')
                ->groupBy('kode_mtk_22')->get();
        $mtk_23 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_23', '!=', NULL)->count();
        $mtk_23_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_23', '!=', NULL)
                ->selectRaw('kode_mtk_23, count(*) as total')
                ->groupBy('kode_mtk_23')->get();
        $mtk_24 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_24', '!=', NULL)->count();
        $mtk_24_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_24', '!=', NULL)
                ->selectRaw('kode_mtk_24, count(*) as total')
                ->groupBy('kode_mtk_24')->get();
        $mtk_25 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_25', '!=', NULL)->count();
        $mtk_25_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('ruang_ujian', $ruang_ujian)
                ->where('kode_mtk_25', '!=', NULL)
                ->selectRaw('kode_mtk_25, count(*) as total')
                ->groupBy('kode_mtk_25')->get();
      }elseif($lokasi_ujian_id)
      {
        $mtk_11 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
              ->where('kode_mtk_11', '!=', NULL)->count();
        $mtk_11_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_11', '!=', NULL)
                ->selectRaw('kode_mtk_11, count(*) as total')
                ->groupBy('kode_mtk_11')->get();      
        $mtk_12 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_12', '!=', NULL)->count();
        $mtk_12_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_12', '!=', NULL)
                ->selectRaw('kode_mtk_12, count(*) as total')
                ->groupBy('kode_mtk_12')->get();
        $mtk_13 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_13', '!=', NULL)->count();
        $mtk_13_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_13', '!=', NULL)
                ->selectRaw('kode_mtk_13, count(*) as total')
                ->groupBy('kode_mtk_13')->get();
        $mtk_14 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_14', '!=', NULL)->count();
        $mtk_14_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_14', '!=', NULL)
                ->selectRaw('kode_mtk_14, count(*) as total')
                ->groupBy('kode_mtk_14')->get();
        $mtk_15 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_15', '!=', NULL)->count();
        $mtk_15_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_15', '!=', NULL)
                ->selectRaw('kode_mtk_15, count(*) as total')
                ->groupBy('kode_mtk_15')->get();
        $mtk_21= UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_21', '!=', NULL)->count();
        $mtk_21_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_21', '!=', NULL)
                ->selectRaw('kode_mtk_21, count(*) as total')
                ->groupBy('kode_mtk_21')->get();
        $mtk_22 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_22', '!=', NULL)->count();
        $mtk_22_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_22', '!=', NULL)
                ->selectRaw('kode_mtk_22, count(*) as total')
                ->groupBy('kode_mtk_22')->get();
        $mtk_23 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_23', '!=', NULL)->count();
        $mtk_23_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_23', '!=', NULL)
                ->selectRaw('kode_mtk_23, count(*) as total')
                ->groupBy('kode_mtk_23')->get();
        $mtk_24 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_24', '!=', NULL)->count();
        $mtk_24_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_24', '!=', NULL)
                ->selectRaw('kode_mtk_24, count(*) as total')
                ->groupBy('kode_mtk_24')->get();
        $mtk_25 = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_25', '!=', NULL)->count();
        $mtk_25_detail = UnmMahasiswa::where('lokasi_ujian_id', $lokasi_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_25', '!=', NULL)
                ->selectRaw('kode_mtk_25, count(*) as total')
                ->groupBy('kode_mtk_25')->get();
      }else{
        $mtk_11 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_11', '!=', NULL)->count();
        $mtk_11_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_11', '!=', NULL)
                ->selectRaw('kode_mtk_11, count(*) as total')
                ->groupBy('kode_mtk_11')->get();      
        $mtk_12 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_12', '!=', NULL)->count();
        $mtk_12_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_12', '!=', NULL)
                ->selectRaw('kode_mtk_12, count(*) as total')
                ->groupBy('kode_mtk_12')->get();
        $mtk_13 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_13', '!=', NULL)->count();
        $mtk_13_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_13', '!=', NULL)
                ->selectRaw('kode_mtk_13, count(*) as total')
                ->groupBy('kode_mtk_13')->get();
        $mtk_14 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_14', '!=', NULL)->count();
        $mtk_14_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_14', '!=', NULL)
                ->selectRaw('kode_mtk_14, count(*) as total')
                ->groupBy('kode_mtk_14')->get();
        $mtk_15 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_15', '!=', NULL)->count();
        $mtk_15_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_15', '!=', NULL)
                ->selectRaw('kode_mtk_15, count(*) as total')
                ->groupBy('kode_mtk_15')->get();
        $mtk_21= UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_21', '!=', NULL)->count();
        $mtk_21_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_21', '!=', NULL)
                ->selectRaw('kode_mtk_21, count(*) as total')
                ->groupBy('kode_mtk_21')->get();
        $mtk_22 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_22', '!=', NULL)->count();
        $mtk_22_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_22', '!=', NULL)
                ->selectRaw('kode_mtk_22, count(*) as total')
                ->groupBy('kode_mtk_22')->get();
        $mtk_23 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_23', '!=', NULL)->count();
        $mtk_23_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_23', '!=', NULL)
                ->selectRaw('kode_mtk_23, count(*) as total')
                ->groupBy('kode_mtk_23')->get();
        $mtk_24 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_24', '!=', NULL)->count();
        $mtk_24_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_24', '!=', NULL)
                ->selectRaw('kode_mtk_24, count(*) as total')
                ->groupBy('kode_mtk_24')->get();
        $mtk_25 = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_25', '!=', NULL)->count();
        $mtk_25_detail = UnmMahasiswa::where('tempat_ujian_id', $tempat_ujian_id)->where('masa_id',$masa)
                ->where('kode_mtk_25', '!=', NULL)
                ->selectRaw('kode_mtk_25, count(*) as total')
                ->groupBy('kode_mtk_25')->get();
      }
      return view('utm.backend.rekap_backend_unm', compact('ruang_ujian','tempat_ujian','lokasi_ujian','mtk_11','mtk_12','mtk_13','mtk_14','mtk_15','mtk_21','mtk_22','mtk_23','mtk_24','mtk_25',
                    'mtk_11_detail','mtk_12_detail','mtk_13_detail','mtk_14_detail','mtk_15_detail','mtk_25_detail','mtk_21_detail','mtk_22_detail','mtk_23_detail','mtk_24_detail'));
    }

    public function absen_unm(Request $request)
    {
      $masa = $this->getIdAktifMasa();
      $tempat_ujian_id = $request->get('tempat_ujian_id');
      $ruang_ujian = $request->get('ruang_ujian');
      
      if($tempat_ujian_id == !null && $ruang_ujian == null){
        $mahasiswa = UnmMahasiswa::with('tempat_ujian','lokasi_ujian')->where('tempat_ujian_id', $tempat_ujian_id)
                        ->where('masa_id',$masa)
                        ->OrderBy('id', 'ASC')->get();
      }else{
        $mahasiswa = UnmMahasiswa::with('tempat_ujian','lokasi_ujian')->where('tempat_ujian_id', $tempat_ujian_id)
                        ->Where('ruang_ujian', $ruang_ujian)
                        ->where('masa_id',$masa)
                        ->OrderBy('id', 'ASC')->get();
      }
        
  
      return view('utm.backend.absen_backend_unm', compact('mahasiswa','tempat_ujian_id'));
    }


    public function GetTempatUjian(Request $request){
  
        $tempat_ujian_id = $request->tempat_ujian_id; 
        $allLokasiUjian = LokasiUjian::where('tempat_ujian_id',$tempat_ujian_id)->where('status_numpang','1')->get();
        return response()->json($allLokasiUjian);
    }
}
