@extends('layouts.lte.main')
@section('title') UTM @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Informasi KTPU UTM Masa {{ $masa }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active">UTM</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- <div class="row"> -->
                    
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Pencarian data</h3>
                            </div>
                            
                                <div class="card-body">
                                    <form class="row gy-2 gx-3 align-items-center" action="{{route('store_backend_unm')}}" method="POST">
                                    @csrf
                                        <div class="col-auto">
                                            <label>Tempat Ujian</label>
                                            <select class="form-control" name="tempat_ujian_id" id="tempat_ujian_id" required style="width: 100%;">
                                                <option value="" selected="selected" disabled>Pilih Tempat Ujian</option>
                                                @foreach(\App\Models\TempatUjian::all() as $item)
                                                <option value="{{ $item->id }}">{{$item->id}} / {{$item->nama_tempat_ujian}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <label>Lokasi Ujian</label>
                                            <select class="form-control select2" name="lokasi_ujian_id" id="lokasi_ujian_id" style="width: 100%;">
                                                <option value="" selected="selected" disabled>Pilih Lokasi Ujian</option>
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <label for="autoSizingSelect">No HP</label>
                                            <input type="text" name="hp" class="form-control" placeholder="masukan HP">
                                        </div>
                                        <div class="col-auto">
                                        <label for="autoSizingSelect">Ruang</label>
                                            <select class="form-control select2" style="width: 100%;" name="ruang_ujian">
                                                <option value="Numpang 1">Numpang 1</option>
                                                <option value="Numpang 2">Numpang 2</option>
                                                <option value="Numpang 3">Numpang 3</option>
                                                <option value="Numpang 4">Numpang 4</option>
                                                <option value="Numpang 5">Numpang 5</option>
                                                <option value="Khusus">Khusus</option>
                                            </select>
                                        </div>
                                        <div class="col-auto" >
                                            <label for="autoSizingSelect"></label>
                                            <button type="submit" class="btn btn-primary" style="margin-top:33px;" >Simpan</button>
                                        </div>
                                </div>
                            

                            <div class="card">
                                <div class="card-body">
                                <div class="table-responsive">
                                        <table class="table table-borderless table-sm m-0 mb-0">

                                            <thead>
                                                <tr>
                                                    <!-- <th>#</th>
                                                    <th>Username</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            <tr>
                                                <td width="10%">NIM / Nama</td>
                                                <td width="1%">:</td>
                                                <td width="30%">{{ $mahasiswa->nim }}/ {{ $mahasiswa->nama_mahasiswa }}</td>
                                                <td width="10%">UPBJJ-UT</td>
                                                <td>: {{ $mahasiswa->info_ut->upbjj->kode_upbjj }} / {{ $mahasiswa->info_ut->upbjj->nama_upbjj }}</td>
                                            </tr>
                                            
                                            <tr>
                                                <td>Tempat Ujian</td>
                                                <td>:</td>
                                                <td>{{$tempat_ujian->kode_wilayah_ujian ?? ''}}/{{$tempat_ujian->nama_wilayah_ujian ?? ''}} - {{$tempat_ujian->kode_upbjj ?? ''}}/{{$tempat_ujian->nama_upbjj ?? ''}}
                                                <td width="10%">Program Studi</td>
                                                <td>: {{ $mahasiswa->info_ut->program_studi->kode_program_studi }} / {{ $mahasiswa->info_ut->program_studi->nama_program_studi }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    <br>
                                    <div class="col-10">
                                            <table class="table table-striped table-sm m-0">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" colspan="2" style="vertical-align : middle;text-align:center;"><center>WAKTU UJIAN</center></th>
                                                    <th><center>HARI PERTAMA</center></th>
                                                    <th><center>HARI KEDUA</center></th>
                                                </tr>
                                                <tr>
                                                    <th>{{$jadwal_utm->h1}}</th>
                                                    <th>{{$jadwal_utm->h2}}</th>
                                                </tr>
                                                <tr>
                                                    <th rowspan="2" style="vertical-align : middle;text-align:center;">JAM</th>
                                                    <th rowspan="2" style="vertical-align : middle;text-align:center;">PUKUL</th>
                                                </tr>
                                                    <tr>
                                                    <th>Ruang/Kursi : {{ $mahasiswa1->ruang ?? "-"}}/{{ $mahasiswa1->kursi ?? "-"}}</th>
                                                    <th>Ruang/Kursi : {{ $mahasiswa2->ruang ?? "-"?? "-"}}/{{ $mahasiswa2->kursi ?? "-"}}</th>
                                                </tr>
                                            </thead>
                                            <tr>
                                                    <td width="5%">KE-1</td>
                                                    <td width="15%">07:00-08:30 WIB</td>
                                                    <td>{{ $mahasiswa1->kode_mtk_1 ?? "-"}}  {{ $mahasiswa1_mtk1 ?? ""}}</td>
                                                    <td>{{ $mahasiswa2->kode_mtk_1 ?? "-"}}  {{ $mahasiswa2_mtk1 ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td>KE-2</td>
                                                    <td>08:45-10:15 WIB</td>
                                                    <td>{{ $mahasiswa1->kode_mtk_2 ?? "-"}} {{ $mahasiswa1_mtk2 ?? ""}}</td>
                                                    <td>{{ $mahasiswa2->kode_mtk_2 ?? "-"}} {{ $mahasiswa2_mtk2 ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td>KE-3</td>
                                                    <td>10:30-12:00 WIB</td>
                                                    <td>{{ $mahasiswa1->kode_mtk_3 ?? "-"}} {{ $mahasiswa1_mtk3 ?? ""}}</td>
                                                    <td>{{ $mahasiswa2->kode_mtk_3 ?? "-"}} {{ $mahasiswa2_mtk3 ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td>KE-4</td>
                                                    <td>12:45-14:15 WIB</td>
                                                    <td>{{ $mahasiswa1->kode_mtk_4 ?? "-"}} {{ $mahasiswa1_mtk4 ?? ""}}</td>
                                                    <td>{{ $mahasiswa2->kode_mtk_4 ?? "-"}} {{ $mahasiswa2_mtk4 ?? ""}}</td>
                                                </tr>
                                                <tr>
                                                    <td>KE-5</td>
                                                    <td>14:30-16:00 WIB</td>
                                                    <td>{{ $mahasiswa1->kode_mtk_5 ?? "-"}} {{ $mahasiswa1_mtk5 ?? ""}}</td>
                                                    <td>{{ $mahasiswa2->kode_mtk_5 ?? "-"}} {{ $mahasiswa2_mtk5 ?? ""}}</td>
                                                </tr>
                                            <tbody>

                                            </tbody>
                                            </table>
                                        </div>
                                </div>
                            </div>
                        </div>
                    
                <!-- </div> -->
            </div>
        </div>
    </div>
    <input type="hidden" name="masa_id" value="{{ $masa }}">
    <input type="hidden" name="nim" value="{{ $mahasiswa->nim }}">
    <input type="hidden" name="nama_mahasiswa" value="{{ $mahasiswa->nama_mahasiswa }}">
    <input type="hidden" name="kode_upbjj" value="{{ $mahasiswa->info_ut->upbjj->kode_upbjj }}">
    <input type="hidden" name="nama_upbjj" value="{{ $mahasiswa->info_ut->upbjj->nama_upbjj }}">
    <input type="hidden" name="kode_program_studi" value="{{ $mahasiswa->info_ut->program_studi->kode_program_studi }}">
    <input type="hidden" name="nama_program_studi" value="{{ $mahasiswa->info_ut->program_studi->nama_program_studi }}">
    <input type="hidden" name="kode_mtk_11" value="{{ $mahasiswa1->kode_mtk_1  ?? ""}}">
    <input type="hidden" name="kode_mtk_12" value="{{ $mahasiswa1->kode_mtk_2  ?? ""}}">
    <input type="hidden" name="kode_mtk_13" value="{{ $mahasiswa1->kode_mtk_3  ?? ""}}">
    <input type="hidden" name="kode_mtk_14" value="{{ $mahasiswa1->kode_mtk_4  ?? ""}}">
    <input type="hidden" name="kode_mtk_15" value="{{ $mahasiswa1->kode_mtk_5  ?? ""}}">
    <input type="hidden" name="kode_mtk_21" value="{{ $mahasiswa2->kode_mtk_1  ?? ""}}">
    <input type="hidden" name="kode_mtk_22" value="{{ $mahasiswa2->kode_mtk_2  ?? ""}}">
    <input type="hidden" name="kode_mtk_23" value="{{ $mahasiswa2->kode_mtk_3  ?? ""}}">
    <input type="hidden" name="kode_mtk_24" value="{{ $mahasiswa2->kode_mtk_4  ?? ""}}">
    <input type="hidden" name="kode_mtk_25" value="{{ $mahasiswa2->kode_mtk_5  ?? ""}}">
    <input type="hidden" name="nama_mtk_11" value="{{ $mahasiswa1_mtk1 ?? ""}}">
    <input type="hidden" name="nama_mtk_12" value="{{ $mahasiswa1_mtk2 ?? ""}}">
    <input type="hidden" name="nama_mtk_13" value="{{ $mahasiswa1_mtk3 ?? ""}}">
    <input type="hidden" name="nama_mtk_14" value="{{ $mahasiswa1_mtk4 ?? ""}}">
    <input type="hidden" name="nama_mtk_15" value="{{ $mahasiswa1_mtk5 ?? ""}}">
    <input type="hidden" name="nama_mtk_21" value="{{ $mahasiswa2_mtk1 ?? ""}}">
    <input type="hidden" name="nama_mtk_22" value="{{ $mahasiswa2_mtk2 ?? ""}}">
    <input type="hidden" name="nama_mtk_23" value="{{ $mahasiswa2_mtk3 ?? ""}}">
    <input type="hidden" name="nama_mtk_24" value="{{ $mahasiswa2_mtk4 ?? ""}}">
    <input type="hidden" name="nama_mtk_25" value="{{ $mahasiswa2_mtk5 ?? ""}}">

</form> 

<!-- JAVASCRIPT -->
<script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>

<script type="text/javascript">
    $(function(){
        $(document).on('change','#tempat_ujian_id',function(){
            var tempat_ujian_id = $(this).val();
            $.ajax({
                url:"{{ route('get_tempat_ujian') }}",
                type: "GET",
                data:{tempat_ujian_id:tempat_ujian_id},
                success:function(data){
                    var html = '<option value="">Pilih Lokasi Ujian</option>';
                    $.each(data,function(key,v){
                        html += '<option value=" '+v.id+' "> '+v.nama_lokasi_ujian+'</option>';
                    });
                    $('#lokasi_ujian_id').html(html);
                }
            })
        });
    });

</script>
@endsection