@extends('layouts.app')

@section('pageTitle')
  Daftar Pengguna
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Daftar Pengguna</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Pengguna</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pengguna</h3>
          <div class="card-tools">
            <a href="{{ url('user/import') }}" class="btn btn-default btn-xs" id="btn-import">
              <i class="fa fa-upload"></i> Import
            </a>
            <a class="btn btn-info btn-xs" href="{{ url('user/create') }}">
              <i class="fa fa-plus-circle"></i> Tambah Pengguna
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 7%;">#</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Jabatan</th>
                  <th style="text-align: center;">Action</th>
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
      $('#table').DataTable({
        processing :true,
        serverSide : true,
        ajax : '{!! url('user/datatables') !!}',
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'name', name: 'name', render:function(data, type, row, meta){
            return '<a href="{{ url('user') }}/'+row.id+'">'+data+'</a>';
          }},
          {data: 'email', name: 'email'},
          {data: 'roles', name: 'roles.name'},
          {data: 'action', name: 'action', searchable:false, orderable:false},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 4 ] }
        ]
      });
    });
  </script>
@endsection
