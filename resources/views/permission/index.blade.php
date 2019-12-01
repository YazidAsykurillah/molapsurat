@extends('layouts.app')

@section('pageTitle')
  Permissions
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Permissions</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Permissions</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Permissions</h3>
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
                  <th style="width: 7%;">#</th>
                  <th>Slug</th>
                  <th>Description</th>
                  <th style="text-align: center;">Action</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
        <div class="card-footer clearfix">
          <a class="btn btn-info btn-sm" href="{{ url('permission/create') }}">
            Create Permission
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
        ajax : '{!! url('permission/datatables') !!}',
        columns :[
          {data: 'rownum', name: 'rownum', searchable:false},
          {data: 'slug', name: 'slug', render:function(data, type, row, meta){
            return '<a href="{{ url('permission') }}/'+row.id+'">'+data+'</a>';
          }},
          {data: 'description', name: 'description'},
          {data: 'action', name: 'action', searchable:false, orderable:false},
        ],
        columnDefs: [
          { className: "text-center", "targets": [ 3 ] }
        ]
      });
    });
  </script>
@endsection
