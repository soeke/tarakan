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
                                <form class="" action="{{route('rekap_backend_unm')}}" method="get">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label">Tempat Ujian</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" name="tempat_ujian_id" id="tempat_ujian_id" required style="width: 100%;">
                                                        <option value="" selected="selected">Pilih Tempat Ujian</option>
                                                        @foreach(\App\Models\TempatUjian::all() as $item)
                                                            <option value="{{ $item->id }}">{{$item->id}} / {{$item->nama_tempat_ujian}} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label">Lokasi Ujian</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" name="lokasi_ujian_id" id="lokasi_ujian_id" style="width: 100%;">
                                                                <option>Pilih Lokasi Ujian</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-4 col-form-label">Lokasi Ujian</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select2" style="width: 100%;" name="ruang_ujian">
                                                        <option value="">Pilih Ruang</option>
                                                        <option value="Numpang 1">Numpang 1</option>
                                                        <option value="Numpang 2">Numpang 2</option>
                                                        <option value="Numpang 3">Numpang 3</option>
                                                        <option value="Numpang 4">Numpang 4</option>
                                                        <option value="Numpang 5">Numpang 5</option>
                                                        <option value="Khusus">Khusus</option>
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
                                <h5 class="card-title">Informasi Mahasiswa Numpang Ujian</h5>
                                <div class="table-responsive ">
                                    <table class="table table-striped" id="example1">
                                    <thead>
                                    <tr>
                                            <th class="text-center">mtk_11</th>
                                            <th class="text-center">mtk_12</th> 
                                            <th class="text-center">mtk_13</th> 
                                            <th class="text-center">mtk_14</th> 
                                            <th class="text-center">mtk_15</th> 
                                            <th class="text-center">mtk_21</th>  
                                            <th class="text-center">mtk_22</th> 
                                            <th class="text-center">mtk_23</th> 
                                            <th class="text-center">mtk_24</th> 
                                            <th class="text-center">mtk_25</th>         
                                        </tr>
                                    </thead>
                                    <tr>
                                            <th>
                                            @foreach($mtk_11_detail as $mtk)
                                                {{$mtk->kode_mtk_11}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_12_detail as $mtk)
                                                {{$mtk->kode_mtk_12}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_13_detail as $mtk)
                                                {{$mtk->kode_mtk_13}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_14_detail as $mtk)
                                                {{$mtk->kode_mtk_14}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_15_detail as $mtk)
                                                {{$mtk->kode_mtk_15}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_21_detail as $mtk)
                                                {{$mtk->kode_mtk_21}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_22_detail as $mtk)
                                                {{$mtk->kode_mtk_22}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_23_detail as $mtk)
                                                {{$mtk->kode_mtk_23}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_24_detail as $mtk)
                                                {{$mtk->kode_mtk_24}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                            <th>
                                            @foreach($mtk_25_detail as $mtk)
                                                {{$mtk->kode_mtk_25}} = {{$mtk->total}} <br>
                                            @endforeach
                                            </th>
                                    
                                        </tr>
                                        <tr>

                                            <th class="text-center">mtk_11 = {{$mtk_11}}</th>
                                            <th class="text-center">mtk_12 = {{$mtk_12}}</th> 
                                            <th class="text-center">mtk_13 = {{$mtk_13}}</th> 
                                            <th class="text-center">mtk_14 = {{$mtk_14}}</th> 
                                            <th class="text-center">mtk_15 = {{$mtk_15}}</th> 
                                            <th class="text-center">mtk_21 = {{$mtk_21}}</th>  
                                            <th class="text-center">mtk_22 = {{$mtk_22}}</th> 
                                            <th class="text-center">mtk_23 = {{$mtk_23}}</th> 
                                            <th class="text-center">mtk_24 = {{$mtk_24}}</th> 
                                            <th class="text-center">mtk_25 = {{$mtk_25}}</th>         
                                        </tr>
                                    <tbody>
                                    <!--  -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</script>
@section('script')
    <!-- JAVASCRIPT -->
    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>

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