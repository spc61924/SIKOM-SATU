@extends('Template-back.layout')
@section('title', 'Form Edit Buku')
@section('content')
<!-- container opened -->
<div class="container">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">FORM EDIT BUKU</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('data-buku') }}">Data Buku</a></li>
                    <li class="breadcrumb-item text-white active">Form Edit Buku</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /breadcrumb -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="main-content-label mg-b-5">
                        Form Edit Buku
                    </div>
                    <p class="mg-b-20">Silahkan isi form di bawah ini dengan lengkap.</p>
                    <!-- message info -->
                    @include('Komponen.message')
                    <div class="pd-30 pd-sm-40 bg-gray-100">
                        <form action="{{ route('update-buku', $data->id) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">JUDUL</label>
                                </div>
                                <div class="col-md-9 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="" type="text" name="judul" value="{{ $data->judul }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">PENULIS</label>
                                </div>
                                <div class="col-md-9 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="" type="text" name="penulis" value="{{ $data->penulis }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">PENERBIT</label>
                                </div>
                                <div class="col-md-9 mg-t-5 mg-md-t-0">
                                    <input class="form-control" placeholder="" type="text" name="penerbit" value="{{ $data->penerbit }}">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">TAHTER</label>
                                </div>
                                <div class="col-md-9 mg-t-5 mg-md-t-0">
                                    <select class="form-control select2" name="tahun_terbit">
                                        @php
                                            $startYear = date("Y") - 2023; // Tahun awal (misalnya 100 tahun yang lalu)
                                            $currentYear = date("Y"); // Tahun saat ini
                                        @endphp
                                            <option value="{{ $data->tahun_terbit }}">{{ $data->tahun_terbit }}</option>
                                            <option disabled value>Pilih Tahun</option>
                                        @for ($year = $currentYear; $year >= $startYear; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="float-right btn btn-primary pd-x-30 mg-e-5 mg-t-5"><i class='fa fa-save'></i> Update</button>
                            <a href="{{ route('data-buku') }}" class="btn btn-secondary pd-x-30 mg-t-5"><i class='fa fa-chevron-left'></i> Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /container -->
@include('Komponen.script')

@endsection
