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
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Pencarian data</h3>
                            </div>
                            <div class="card-body">
                                <form class="" action="{{route('add_backend_unm')}}" method="get">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label">NIM</label>
                                                <div class="col-sm-10">
                                                    <input type="number" name="nim" class="form-control"  placeholder="Masukan NIM yang dicari"  required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="mb-3">
                                                <button class="btn btn-primary" type="submit">Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection