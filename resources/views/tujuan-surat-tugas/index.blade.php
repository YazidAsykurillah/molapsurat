@extends('layouts.app')

@section('pageTitle')
  Tujuan Surat Tugas
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Tujuan Surat Tugas</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('tujuan-surat-tugas') }}">Tujuan Surat Tugas</a></li>
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
          <h3 class="card-title">Tujuan Surat Tugas</h3>
          <div class="card-tools">
            <a class="btn btn-info btn-xs" href="{{ url('tujuan-surat-tugas/create') }}" data-toggle="tooltip" title="Buat Tujuan Surat Tugas baru">
              <i class="fa fa-plus-circle"></i> Tambah
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 7%; text-align: center;">#</th>
                  <th>Nama</th>
                  <th>Alamat</th>
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

  <!--Modal Delete Tujuan Surat Tugas-->
  <div class="modal fade" id="modal-delete-tujuan-surat-tugas">
    <div class="modal-dialog">
      <div class="modal-content bg-warning">
        <form id="form-delete-tujuan-surat-tugas" class="form form-horizontal" method="POST" action="{{ url('tujuan-surat-tugas/delete') }}">
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
  <!--ENDModal Delete Tujuan Surat Tugas-->
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      var table = $('#table').DataTable({
        processing :true,
        serverSide : true,
        ajax : '{!! url('tujuan-surat-tugas/datatables') !!}',
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'nama', name: 'nama', render:function(data, type, row, meta){
            return '<a href="{{ url('tujuan-surat-tugas') }}/'+row.id+'">'+data+'</a>';
          }},
          {data: 'alamat', name: 'alamat'},
          {data: 'action', name: 'action', searchable:false, orderable:false},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 0,3 ] }
        ]
      });

      table.on('click', '.btn-delete', function(e){
        event.preventDefault();
        var id = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        $('.confirmation_text').html('Tujuan Surat Tugas <strong>'+nama+'</strong> akan dihapus');
        $('#form-delete-tujuan-surat-tugas').find('#id_to_delete').val(id);
        $('#modal-delete-tujuan-surat-tugas').modal('show');
      });

    });
  </script>
@endsection
