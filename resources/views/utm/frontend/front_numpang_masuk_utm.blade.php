@extends('layouts.lte.main')
@section('title') UTM @endsection

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Cek Lokasi UTM</h1>
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
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Lokasi Ujian Tatap Muka UT Tarakan masa {{ $masa }}</h3>
                            </div>
                            <div class="card-body">
                                <form class="" action="{{ route('front_uas.utm_search') }}" method="GET">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="row mb-3">
                                                <label class="col-sm-3 col-form-label">NIM</label>
                                                <div class="col-sm-9">
                                                    <input type="number" name="nim" value="{{old('nim')}}" class="form-control"  placeholder="Masukan NIM"  required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="row mb-4">
                                                <label class="col-sm-4 col-form-label">Captcha</label>
                                                <div class="col-sm-8">
                                                {!!getCaptchaBox()!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mb-3">
                                                <button class="btn btn-primary" type="submit">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="container">
                                    <div class="text-danger px-2 bg-light ">Catatan: <br>
                                        <ul>
                                            <li><strong>Lokasi UTM SMP 5 Kota Bogor pindah ke SDN Papandayan Kota Bogor</strong></li>
                                            <li>H-1 sebelum UAS silahkan cek kembali, khawatir ada perubahan lokasi ujian</li>
                                            <li>Lokasi ujian yang tertera khusus untuk wilayah ujian UT Bogor, yaitu : Kab/Kota Bogor, Kota Depok, Kab/Kota Sukabumi dan Kab. Cianjur serta sudah disediakan link google map tiap lokasi</li>
                                            <li>Lokasi ujian di luar wilayah kerja UT Bogor silahkan menghubungi UT Daerah sesuai wilayah ujian</li>
                                            <li>Info valid dan detailnya, silahkan cetak KTPU di <a href="https://myut.ut.ac.id/">MYUT</a> sesuai Kalender Akadmik.</li>
                                        </ul>
                                        
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