@extends('layouts.lte.main')
@section('title') UTM @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Informasi KTPU UTM</h1>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Pencarian data</h3>
                            </div>

                        <div class="card">
                            <div class="card-body">
                                <form class="row gy-2 gx-3 align-items-center" action="{{route('update_backend_unm', $mahasiswa->id)}}" method="POST">
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
                                        <input type="text" name="hp" value= "{{ $mahasiswa->hp }}" class="form-control" placeholder="masukan HP">
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
                                            <td width="10%">Masa</td>
                                            <td width="1%">:</td>
                                            <td width="25%">{{ $masa }}</td><td></td><td></td><td></td>
                                            <td width="10%">UPBJJ-UT</td>
                                            <td>: {{ $mahasiswa->kode_upbjj }} / {{ $mahasiswa->nama_upbjj }}</td>
                                        </tr>
                                        
                                        <tr>
                                            <td>NIM / Nama</td>
                                            <td>:</td>
                                            <td> {{ $mahasiswa->nim }}/ {{ $mahasiswa->nama_mahasiswa }}</td><td></td><td></td><td></td>
                                            <td width="10%">Program Studi</td>
                                            <td>: {{ $mahasiswa->kode_program_studi }} / {{ $mahasiswa->nama_program_studi }}</td>
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
                                                <th>Ruang/Kursi : {{ $mahasiswa->ruang ?? "-"}}/{{ $mahasiswa->kursi ?? "-"}}</th>
                                                <th>Ruang/Kursi : {{ $mahasiswa->ruang ?? "-"?? "-"}}/{{ $mahasiswa->kursi ?? "-"}}</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                                <td width="5%">KE-1</td>
                                                <td width="13%">07:00-08:30 WIB</td>
                                                <td>{{ $mahasiswa->kode_mtk_11 ?? "-"}}  {{ $mahasiswa->nama_mtk_11 ?? ""}}</td>
                                                <td>{{ $mahasiswa->kode_mtk_21 ?? "-"}}  {{ $mahasiswa->nama_mtk_21 ?? ""}}</td>
                                            </tr>
                                            <tr>
                                                <td>KE-2</td>
                                                <td>08:45-10:15 WIB</td>
                                                <td>{{ $mahasiswa->kode_mtk_12 ?? "-"}} {{ $mahasiswa->nama_mtk_12 ?? ""}}</td>
                                                <td>{{ $mahasiswa->kode_mtk_22 ?? "-"}} {{ $mahasiswa->nama_mtk_22 ?? ""}}</td>
                                            </tr>
                                            <tr>
                                                <td>KE-3</td>
                                                <td>10:30-12:00 WIB</td>
                                                <td>{{ $mahasiswa->kode_mtk_13 ?? "-"}} {{ $mahasiswa->nama_mtk_13 ?? ""}}</td>
                                                <td>{{ $mahasiswa->kode_mtk_23 ?? "-"}} {{ $mahasiswa->nama_mtk_23 ?? ""}}</td>
                                            </tr>
                                            <tr>
                                                <td>KE-4</td>
                                                <td>12:45-14:15 WIB</td>
                                                <td>{{ $mahasiswa->kode_mtk_14 ?? "-"}} {{ $mahasiswa->nama_mtk_14 ?? ""}}</td>
                                                <td>{{ $mahasiswa->kode_mtk_24 ?? "-"}} {{ $mahasiswa->nama_mtk_24 ?? ""}}</td>
                                            </tr>
                                            <tr>
                                                <td>KE-5</td>
                                                <td>14:30-16:00 WIB</td>
                                                <td>{{ $mahasiswa->kode_mtk_15 ?? "-"}} {{ $mahasiswa->nama_mtk_15 ?? ""}}</td>
                                                <td>{{ $mahasiswa->kode_mtk_25 ?? "-"}} {{ $mahasiswa->nama_mtk_25 ?? ""}}</td>
                                            </tr>
                                        <tbody>

                                        </tbody>
                                        </table>
                                    </div>
                            </div>
                        </div>


                        </form> 

                    </div>
                </div>
            </div>
        </div>
    </div>

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