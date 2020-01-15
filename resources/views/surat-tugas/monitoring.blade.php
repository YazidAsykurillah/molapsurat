@extends('layouts.app')

@section('pageTitle')
  Monitoring Surat Tugas
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Monitoring Surat Tugas</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('surat-tugas') }}">Surat Tugas</a></li>
        <li class="breadcrumb-item active">Monitoring</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Monitoring Surat Tugas</h3>
          <div class="card-tools">
            
          </div>
        </div>
        <div class="card-body">
          <form class="form-horizontal" id="form-filter">
            <div class="form-group row">
              <label for="filter_status_laporan_surat_tugas" class="col-sm-2 col-form-label">Satus Laporan ST</label>
              <div class="col-sm-5">
                <select name="filter_status_laporan_surat_tugas" id="filter_status_laporan_surat_tugas" class="form-control">
                  <option value="">--Semua Status---</option>
                  @foreach($status_laporan_surat_tugas_opt as $opt)
                    <option value="{{ $opt }}">{{ status_laporan_surat_tugas($opt) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-5">
                <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </div>
          </form>
          <div class="table-responsive">
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 7%; text-align: center;">#</th>
                  <th style="width: 10%;"></th>
                  <th>Nomor</th>
                  <th>Tanggal Surat Tugas</th>
                  <th>Jenis Kegiatan</th>
                  <th>Tujuan</th>
                  <th>Uraian</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Laporan Surat Tugas</th>
                  <th>Status Laporan Surat Tugas</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <div class="card-footer clearfix">
          <a class="btn btn-default btn-xs" id="btn-export-excel" href="{{ url('surat-tugas/export') }}">
              <i class="fa fa-file-export"></i> Export XLSX
            </a>
        </div>
      </div>
    </div>
  </div>

  <!--Modal Delete Surat Tugas-->
  <div class="modal fade" id="modal-delete-surat-tugas">
    <div class="modal-dialog">
      <div class="modal-content bg-warning">
        <form id="form-delete-surat-tugas" class="form form-horizontal" method="POST" action="{{ url('surat-tugas/delete') }}">
          @csrf
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="confirmation_text">Konfirmasi</p>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="id_to_delete" id="id_to_delete" value="">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-light btn-danger">Hapus</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--ENDModal Delete Surat Tugas-->
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      var table = $('#table').DataTable({
        processing :true,
        serverSide : true,
        //ajax : '{!! url('surat-tugas/monitoring-datatables') !!}',
        ajax : {
          url : '{!! url('surat-tugas/monitoring-datatables') !!}',
          data: function(d){
            d.filter_status_laporan_surat_tugas = $('select[name=filter_status_laporan_surat_tugas]').val();
          }
        },
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'background_type', name: 'background_type', searchable:false, orderable:false, render:function(data, type, row, meta){
            var color = '<div class="'+data+' color-palette" style="width:100%;"><span>&nbsp;&nbsp;</span></div>';
            return color;
          }},
          {data: 'nomor', name: 'nomor', render:function(data, type, row, meta){
            return '<a href="{{ url('surat-tugas') }}/'+row.id+'">'+data+'</a>';
          }},
          {data: 'tanggal', name: 'tanggal'},
          {data: 'judul_jenis_surat_tugas', name: 'jenis_surat_tugas.judul'},
          {data: 'nama_tujuan_surat_tugas', name: 'tujuan_surat_tugas.nama'},
          {data: 'uraian', name: 'uraian'},
          {data: 'tanggal_mulai', name: 'tanggal_mulai'},
          {data: 'tanggal_selesai', name: 'tanggal_selesai'},
          {data: 'laporan_surat_tugas_id', name: 'laporan_surat_tugas.id', render:function(data, type, row, meta){
            if(data == 'exists'){
              return '<a href="{{ url('laporan-surat-tugas') }}/'+row.laporan_surat_tugas.id+'">Lihat Laporan</a>';
            }else{
              return '-';
            }
          }},
          {data:'status_laporan_surat_tugas', name:'status_laporan_surat_tugas'},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 0 ] }
        ],
      });


      $('#form-filter').on('submit', function(e) {
        table.draw();
        e.preventDefault();
      });

    });
  </script>
@endsection
