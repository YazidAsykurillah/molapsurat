@extends('layouts.app')

@section('pageTitle')
  Pagu Tahunan
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Pagu Tahunan</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
        <li class="breadcrumb-item active"><a href="{{ url('keuangan/pagu-tahunan') }}">Pagu Tahunan</a></li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pagu Tahunan</h3>
          <div class="card-tools">
            <a class="btn btn-info btn-xs" href="{{ url('pagu-tahunan/create') }}" data-toggle="tooltip" title="Buat Pagu Tahunan">
              <i class="fa fa-plus-circle"></i> Input PAGU Tahunan
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 7%; text-align: center;">#</th>
                  <th>Tahun</th>
                  <th>Jumlah Anggaran</th>
                  <th>Kasubag</th>
                  <th style="width:10%;text-align: center;">Action</th>
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
        ajax : '{!! url('pagu-tahunan/datatables') !!}',
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'tahun', name: 'tahun'},
          {data: 'jumlah_anggaran', name: 'jumlah_anggaran'},
          {data: 'kasubag', name: 'kasubag', searchable:false, orderable:false},
          {data: 'action', name: 'action', searchable:false, orderable:false},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 0, 4 ] }
        ]
      });

    });
  </script>
@endsection
