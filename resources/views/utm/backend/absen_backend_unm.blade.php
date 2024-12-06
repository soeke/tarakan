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
                        <div class="card-body">
                          <form class="" action="{{route('absen_backend_unm')}}" method="get">
                              <div class="row">
                                  <div class="col-md-4">
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
                                          <label class="col-sm-4 col-form-label">Ruang Ujian</label>
                                          <div class="col-sm-8">
                                          <select class="form-control select2" name="ruang_ujian" style="width: 100%;">
                                              <option value="" selected="selected">Pilih Ruang Ujian</option>
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
                        <ul class="nav nav-tabs" id="custom-content-above-tab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="false">H1-{{$tempat_ujian_id}}</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="true">H2-{{$tempat_ujian_id}}</a>
                          </li>
                        </ul>  

                        <div class="tab-content" id="custom-content-above-tabContent">
                          <div class="tab-pane fade active show" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
                              <!-- h1 --> <br>
                              <div class="table-responsive ">
                                  <table class="table table-striped" id="example1">
                                      <thead>
                                          <tr>
                                              <th class="text-center">No</th>
                                              <th class="text-center">11</th>
                                              <th class="text-center">12</th>
                                              <th class="text-center">13</th>
                                              <th class="text-center">14</th>
                                              <th class="text-center">15</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @foreach($mahasiswa as $key => $item)
                                          <tr>
                                              <td>{{$key+1}}</td>
                                              <td>@if(isset($item->kode_mtk_11))
                                                  {{$item->nama_mahasiswa}}<br>
                                                  {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_11}}
                                                  <br><br>
                                                  TTD ...............................
                                                  @endif
                                              </td>
                                              <td>@if(isset($item->kode_mtk_12))
                                                  {{$item->nama_mahasiswa}}<br>
                                                  {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_12}}
                                                  <br><br>
                                                  TTD ...............................
                                                  @endif
                                              </td>
                                              <td>@if(isset($item->kode_mtk_13))
                                                  {{$item->nama_mahasiswa}}<br>
                                                  {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_13}}
                                                  <br><br>
                                                  TTD ...............................
                                                  @endif
                                              </td>
                                              <td>@if(isset($item->kode_mtk_14))
                                                  {{$item->nama_mahasiswa}}<br>
                                                  {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_14}}
                                                  <br><br>
                                                  TTD ...............................
                                                  @endif
                                              </td>
                                              <td>@if(isset($item->kode_mtk_15))
                                                  {{$item->nama_mahasiswa}}<br>
                                                  {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_15}}
                                                  <br><br>
                                                  TTD ...............................
                                                  @endif
                                              </td>
                                              
                                          </tr>
                                          @endforeach
                                      </tbody>
                                  </table>
                              </div>  
                          </div>
                          <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                            <!-- h2 --> <br>
                            <div class="table-responsive ">
                                <table class="table table-striped" id="example2">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
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
                                            <td>@if(isset($item->kode_mtk_21))
                                                {{$item->nama_mahasiswa}}<br>
                                                {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_21}}
                                                <br><br>
                                                TTD ...............................
                                                @endif
                                            </td>
                                            <td>@if(isset($item->kode_mtk_22))
                                                {{$item->nama_mahasiswa}}<br>
                                                {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_22}}
                                                <br><br>
                                                TTD ...............................
                                                @endif
                                            </td>
                                            <td>@if(isset($item->kode_mtk_23))
                                                {{$item->nama_mahasiswa}}<br>
                                                {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_23}}
                                                <br><br>
                                                TTD ...............................
                                                @endif
                                            </td>
                                            <td>@if(isset($item->kode_mtk_24))
                                                {{$item->nama_mahasiswa}}<br>
                                                {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_24}}
                                                <br><br>
                                                TTD ...............................
                                                @endif
                                            </td>
                                            <td>@if(isset($item->kode_mtk_25))
                                                {{$item->nama_mahasiswa}}<br>
                                                {{$item->nim}}&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$item->kode_mtk_25}}
                                                <br><br>
                                                TTD ...............................
                                                @endif
                                            </td>
                                            
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
    </div>
</div>

@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection
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

    $("#example2").DataTable({
    //   "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "excel", "print", "colvis"]
    }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
  });
</script>


@endsection