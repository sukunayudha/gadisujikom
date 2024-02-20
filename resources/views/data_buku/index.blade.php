@extends('_template_back.layout')

@section('content')
    	<!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div>
                <h4 class="content-title mb-2">Hi, welcome back!</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a   href="javascript:void(0);">Tables</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Basic Tables</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- /breadcrumb -->

        <!-- row opened -->
        <div class="row row-sm">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex my-auto btn-list justify-content-end">
                         <a href="{{ route('buku.create') }}" class="btn btn-primary">Tambah Data</a>
                         <a href="{{ route('export_pdf_buku') }}" class="btn btn-danger">Export PDF</a>
                         <a href="{{ route('export_pdf_buku') }}" class="btn btn-primary">Export Excel</a>
                        </div>
                    </div>
                    <div class="card-body mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Penulis</th>
                                        <th>Penerbit</th>
                                        <th>Tahun Terbit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($buku as $dt)
                                        
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $dt->judul }}</td>
                                        <td>{{ $dt->penulis }}</td>
                                        <td>{{ $dt->penerbit }}</td>
                                        <td>{{ $dt->tahun_terbit }}</td>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!--/div-->

@endsection