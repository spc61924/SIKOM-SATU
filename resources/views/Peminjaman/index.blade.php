@extends('Template-back.layout')
@section('title', 'Data Peminjaman')
@section('content')
<!-- container opened -->
<div class="container">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div>
            <h4 class="content-title mb-2">DATA PEMINJAMAN</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item text-white active">Data Peminjaman</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- /breadcrumb -->

    <div class="row row-sm">
        <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12">
            <div class="card">
                <div class="pd-t-10 pd-s-10 pd-e-10 bg-white bd-b">
                    <div class="row">
                        <div class="col-md-6">
                            <p>DATA PEMINJAMAN</p>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex my-auto btn-list justify-content-end">
                                <a href="{{ route('create-peminjaman') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah</a>
                                <button data-bs-toggle="modal" data-bs-target="#ModalImportBuku" class="btn btn-sm btn-secondary"><i class="fa fa-upload me-2"></i> Import</button>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-sm btn-success dropdown-toggle" data-bs-toggle="dropdown">
                                        <i class="fa fa-download me-2"></i>Export
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#">Excel</a>
                                        <a class="dropdown-item" href="#">PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                <!-- message info -->
                @include('Komponen.message')
                    <div class="table-responsive mt-3">
                        <table
                         id="tbl_list" class="table table-sm table-striped table-bordered tx-14" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pengguna</th>
                                    <th>Buku</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Pengembalian</th>
                                    <th>Status Peminjaman</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $no=1; @endphp
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <th>{{ $item->user->username }}</th>
                                    <th>{{ $item->buku->judul }}</th>
                                    <th>{{ \Carbon\Carbon::parse($item->tanggal_peminjaman)->format('d/m/Y') }}</th>
                                    <th>{{ \Carbon\Carbon::parse($item->tanggal_pengembalian)->format('d/m/Y') }}</th>
                                    <td>{{ $item->status_peminjaman }}</td>
                                    <td>
                                        <a href="#" class="btn btn-info btn-sm" title="Edit"><i class="fe fe-edit"></i></a>
                                        <a href="#" class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')"><i class="fe fe-trash"></i></a>
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
<!-- /container -->
@include('Komponen.script')

@endsection
