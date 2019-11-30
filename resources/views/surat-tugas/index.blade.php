@extends('layouts.app')

@section('pageTitle')
  Daftar Surat Tugas
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Daftar Surat Tugas</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('surat-tugas') }}">Surat Tugas</a></li>
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
          <h3 class="card-title">Daftar Surat Tugas</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 7%; text-align: center;">#</th>
                  <th>Nomor</th>
                  <th>Jenis Surat</th>
                  <th>Tujuan</th>
                  <th>Uraian</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th style="">Attachment</th>
                  <th style="width:10%;text-align: center;">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <div class="card-footer clearfix">
          <a class="btn btn-info btn-sm" href="{{ url('surat-tugas/create') }}">
            Buat Surat Tugas
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#table').DataTable({
        processing :true,
        serverSide : true,
        ajax : '{!! url('surat-tugas/datatables') !!}',
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'nomor', name: 'nomor', render:function(data, type, row, meta){
            return '<a href="{{ url('surat-tugas') }}/'+row.id+'">'+data+'</a>';
          }},
          {data: 'judul_jenis_surat_tugas', name: 'jenis_surat_tugas.judul'},
          {data: 'nama_tujuan_surat_tugas', name: 'tujuan_surat_tugas.nama'},
          {data: 'uraian', name: 'uraian'},
          {data: 'tanggal_mulai', name: 'tanggal_mulai'},
          {data: 'tanggal_selesai', name: 'tanggal_selesai'},
          {data: 'attachment', name: 'attachment', render:function(data, type, row, meta){
            if(data!=null){
              return '<a href="{{ url('files')}}/surat-tugas/'+data+'">View</a>';  
            }else{
              return null;
            }
            
          }},
          {data: 'action', name: 'action', searchable:false, orderable:false},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 0,8 ] }
        ]
      });
    });
  </script>
@endsection
