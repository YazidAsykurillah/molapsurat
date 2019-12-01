@extends('layouts.app')

@section('pageTitle')
  Jabatan
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Jabatan</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Jabatan</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Jabatan</h3>
          <div class="card-tools">
            <a class="btn btn-info btn-xs" href="{{ url('role/create') }}" data-toggle="tooltip" title="Buat role">
              <i class="fa fa-plus-circle"></i> Input Jabatan
            </a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 7%;">#</th>
                  <th>Code</th>
                  <th>Name</th>
                  <th>Label</th>
                  <th style="width:10%; text-align: center;">Action</th>
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
        ajax : '{!! url('role/datatables') !!}',
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'code', name: 'code', render:function(data, type, row, meta){
            return '<a href="{{ url('role') }}/'+row.id+'">'+data+'</a>';
          }},
          {data: 'name', name: 'name'},
          {data: 'label', name: 'label'},
          {data: 'action', name: 'action', searchable:false, orderable:false},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 4 ] }
        ]
      });
    });
  </script>
@endsection
