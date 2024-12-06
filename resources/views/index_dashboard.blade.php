@extends('layouts.lte.main')
@section('title') UTM @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Pencarian data</h3>
                            </div>
                            <div class="card-body">
                                


                            
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Informasi Mahasiswa Numpang Ujian</h5>
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th style="text-align:center;">No</th>
                                            <th style="text-align:center;">NIM</th>
                                            <th >Nama Mahasiswa</th>
                                            <th >Tempat Ujian</th>
                                            <th >Lokasi Ujian</th>
                                            <th style="text-align:center;">Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        
                                        <tr>
                                            <td style="vertical-align : middle;text-align:center;">1.</td>
                                            <td style="vertical-align : middle;text-align:center;">{{ $mahasiswa->nim }}</td>
                                            <td style="vertical-align : middle">{{ $mahasiswa->nama_mahasiswa }}</td>
                                            <td style="vertical-align : middle">{{ $mahasiswa->tempat_ujian->id }} / {{ $mahasiswa->tempat_ujian->nama_tempat_ujian }}</td>
                                            <td style="vertical-align : middle">{{ $mahasiswa->lokasi_ujian->nama_lokasi_ujian }}</td>
                                            <td style="vertical-align : middle;text-align:center;">
                                                <a href="{{ route('edit_backend_unm',$mahasiswa->id) }}" class="btn btn-primary sm" title="Edit KTPU Numpang" >  <i class="fa fa-pencil"></i> Edit</a>
                                                <a href="{{ route('print_ktpu_backend_unm',$mahasiswa->id) }}" target="_blank" class="btn btn-primary sm" title="Print KTPU Numpang" >  <i class="fa fa-print"></i> Cetak</a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Matakuliah - {{ $mahasiswa->tempat_ujian->id }} / {{ $mahasiswa->tempat_ujian->nama_tempat_ujian }} - 
                                            {{ $mahasiswa->lokasi_ujian->nama_lokasi_ujian }} </h5>
                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="text-align:center;">Ruang</th>
                                            <th style="text-align:center;">MTK 11</th>
                                            <th style="text-align:center;">MTK 12</th>
                                            <th style="text-align:center;">MTK 13</th>
                                            <th style="text-align:center;">MTK 14</th>
                                            <th style="text-align:center;">MTK 15</th>
                                            <th style="text-align:center;">MTK 21</th>
                                            <th style="text-align:center;">MTK 22</th>
                                            <th style="text-align:center;">MTK 23</th>
                                            <th style="text-align:center;">MTK 24</th>
                                            <th style="text-align:center;">MTK 25</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>Ruang 1</th>
                                                <th class="text-center">{{$mtk_11_r1}}</th>
                                                <th class="text-center">{{$mtk_12_r1}}</th> 
                                                <th class="text-center">{{$mtk_13_r1}}</th> 
                                                <th class="text-center">{{$mtk_14_r1}}</th> 
                                                <th class="text-center">{{$mtk_15_r1}}</th>
                                                <th class="text-center">{{$mtk_21_r1}}</th>  
                                                <th class="text-center">{{$mtk_22_r1}}</th> 
                                                <th class="text-center">{{$mtk_23_r1}}</th> 
                                                <th class="text-center">{{$mtk_24_r1}}</th> 
                                                <th class="text-center">{{$mtk_25_r1}}</th>  
                                            </tr>
                                            <tr>
                                                <th>Ruang 2</th>
                                                <th class="text-center">{{$mtk_11_r2}}</th>
                                                <th class="text-center">{{$mtk_12_r2}}</th> 
                                                <th class="text-center">{{$mtk_13_r2}}</th> 
                                                <th class="text-center">{{$mtk_14_r2}}</th> 
                                                <th class="text-center">{{$mtk_15_r2}}</th>
                                                <th class="text-center">{{$mtk_21_r2}}</th>  
                                                <th class="text-center">{{$mtk_22_r2}}</th> 
                                                <th class="text-center">{{$mtk_23_r2}}</th> 
                                                <th class="text-center">{{$mtk_24_r2}}</th> 
                                                <th class="text-center">{{$mtk_25_r2}}</th>  
                                            </tr>
                                            <tr>
                                                <th>Ruang 3</th>
                                                <th class="text-center">{{$mtk_11_r3}}</th>
                                                <th class="text-center">{{$mtk_12_r3}}</th> 
                                                <th class="text-center">{{$mtk_13_r3}}</th> 
                                                <th class="text-center">{{$mtk_14_r3}}</th> 
                                                <th class="text-center">{{$mtk_15_r3}}</th>
                                                <th class="text-center">{{$mtk_21_r3}}</th>  
                                                <th class="text-center">{{$mtk_22_r3}}</th> 
                                                <th class="text-center">{{$mtk_23_r3}}</th> 
                                                <th class="text-center">{{$mtk_24_r3}}</th> 
                                                <th class="text-center">{{$mtk_25_r3}}</th>  
                                            </tr>
                                            <tr>
                                                <th>Ruang 4</th>
                                                <th class="text-center">{{$mtk_11_r4}}</th>
                                                <th class="text-center">{{$mtk_12_r4}}</th> 
                                                <th class="text-center">{{$mtk_13_r4}}</th> 
                                                <th class="text-center">{{$mtk_14_r4}}</th> 
                                                <th class="text-center">{{$mtk_15_r4}}</th>
                                                <th class="text-center">{{$mtk_21_r4}}</th>  
                                                <th class="text-center">{{$mtk_22_r4}}</th> 
                                                <th class="text-center">{{$mtk_23_r4}}</th> 
                                                <th class="text-center">{{$mtk_24_r4}}</th> 
                                                <th class="text-center">{{$mtk_25_r4}}</th>  
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <th class="text-center">{{$mtk_11}}</th>
                                                <th class="text-center">{{$mtk_12}}</th> 
                                                <th class="text-center">{{$mtk_13}}</th> 
                                                <th class="text-center">{{$mtk_14}}</th> 
                                                <th class="text-center">{{$mtk_15}}</th>
                                                <th class="text-center">{{$mtk_21}}</th>  
                                                <th class="text-center">{{$mtk_22}}</th> 
                                                <th class="text-center">{{$mtk_23}}</th> 
                                                <th class="text-center">{{$mtk_24}}</th> 
                                                <th class="text-center">{{$mtk_25}}</th>  
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection