@extends('layouts.app')

@section('pageTitle')
  Realisasi Keuangan
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Realisasi Keuangan</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
        <li class="breadcrumb-item"><a href="{{ url('realisasi-keuangan') }}">Realisasi Keuangan</a></li>
        <li class="breadcrumb-item active">Index</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Realisasi Keuangan</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 7%; text-align: center;">#</th>
                  <th>Jenis Kegiatan</th>
                  <th>Jumlah Pengajuan</th>
                  <th>Jumlah Realisasi</th>
                  <th>Selisih</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <div class="card-footer clearfix"></div>
      </div>
    </div>
  </div>

@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      var table = $('#table').DataTable({
        processing :true,
        serverSide : true,
        ajax : '{!! url('realisasi-keuangan/datatables') !!}',
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'judul_jenis_surat_tugas', name: 'pengajuan_keuangan.jenis_surat_tugas.judul'},
          {data: 'jumlah_pengajuan', name: 'pengajuan_keuangan.jumlah_pengajuan'},
          {data: 'jumlah_realisasi', name: 'jumlah_realisasi'},
          {data: 'balance', name: 'balance', searchable:false, orderable:false},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 0, 3 ] }
        ]
      });

    });
  </script>
@endsection
