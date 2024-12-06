@extends('layouts.lte.main')
@section('title') UTM @endsection

@section('content')

@section('link')
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Informasi Numpang UTM</h1>
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
                                <div class="card-body">
                                    <form class="" action="{{route('show_all_backend_unm')}}" method="get">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row mb-3">
                                                    <label class="col-sm-4 col-form-label">Tempat Ujian</label>
                                                    <div class="col-sm-8">
                                                    <select class="form-control select2" name="tempat_ujian_id" required style="width: 100%;">
                                                        <option value="" selected="selected">Pilih Tempat Ujian</option>
                                                        @foreach(\App\Models\TempatUjian::all() as $item)
                                                            <option value="{{ $item->id }}">{{$item->id}} / {{$item->nama_tempat_ujian}} </option>
                                                        @endforeach
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="mb-2">
                                                    <button class="btn btn-primary" type="submit">Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                   
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive ">
                                        <table class="table table-striped" id="example1">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" class="text-center">No</th>
                                                    <th rowspan="2" class="text-center">Masa</th> 
                                                    <th rowspan="2" class="text-center">NIM</th>
                                                    <th rowspan="2" class="text-center" >Nama Mahasiswa</th>
                                                    <th rowspan="2" class="text-center">UPBJJ</th>
                                                    <th rowspan="2" class="text-center">Program Studi</th>
                                                    <th rowspan="2" class="text-center">Tempat Ujian</th>
                                                    <th rowspan="2" class="text-center">Lokasi Ujian</th>
                                                    <th colspan="10"class="text-center">Matakuliah</th> 
                                                </tr>
                                                <tr>
                                                    <th class="text-center">11</th>
                                                    <th class="text-center">12</th>
                                                    <th class="text-center">13</th>
                                                    <th class="text-center">14</th>
                                                    <th class="text-center">15</th>
                                                    <th class="text-center">21</th>
                                                    <th class="text-center">22</th>
                                                    <th class="text-center">23</th>
                                                    <th class="text-center">24</th>
                                                    <th class="text-center">25</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($mahasiswa as $key => $item)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$item->masa_id}}</td>
                                                    <td>{{$item->nim}}</td>
                                                    <td>{{$item->nama_mahasiswa}}</td>
                                                    <td>{{ $item->kode_upbjj }} / {{ $item->nama_upbjj }}</td>
                                                    <td>{{ $item->kode_program_studi }} / {{ $item->nama_program_studi }}</td>
                                                    <td>{{$item->tempat_ujian->nama_tempat_ujian}}</td>
                                                    <td>{{$item->lokasi_ujian->nama_lokasi_ujian}}</td>
                                                    <td>{{$item->kode_mtk_11}} {{$item->nama_mtk_11}}</td>
                                                    <td>{{$item->kode_mtk_12}} {{$item->nama_mtk_12}}</td>
                                                    <td>{{$item->kode_mtk_13}} {{$item->nama_mtk_13}}</td>
                                                    <td>{{$item->kode_mtk_14}} {{$item->nama_mtk_14}}</td>
                                                    <td>{{$item->kode_mtk_15}} {{$item->nama_mtk_15}}</td>
                                                    <td>{{$item->kode_mtk_21}} {{$item->nama_mtk_21}}</td>
                                                    <td>{{$item->kode_mtk_22}} {{$item->nama_mtk_22}}</td>
                                                    <td>{{$item->kode_mtk_23}} {{$item->nama_mtk_23}}</td>
                                                    <td>{{$item->kode_mtk_24}} {{$item->nama_mtk_24}}</td>
                                                    <td>{{$item->kode_mtk_25}} {{$item->nama_mtk_25}}</td>
                                                    
                                                </tr>
                                                @endforeach
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

</script>
@section('script')
<script src="{{ asset('asset/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<!-- <script src="{{ asset('asset/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script> -->
<script src="{{ asset('asset/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('asset/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('asset/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script>
  $(function () {
    $("#example1").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });




</script>
@endsection
@endsection