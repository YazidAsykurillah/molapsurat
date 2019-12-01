@extends('layouts.app')

@section('pageTitle')
  Role :: {{ $role->nomor }}
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Role Detail</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('role') }}">Role</a></li>
        <li class="breadcrumb-item active">Show</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Role Information</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <p class="">Code
            <b class="d-block">{{ $role->code }}</b>
          </p>
          <p class="">Name
            <b class="d-block">{{ $role->name }}</b>
          </p>
          <p class="">Label
            <b class="d-block">{{ $role->label }}</b>
          </p>
          
        </div>
        <div class="card-footer clearfix"></div>
      </div>
    </div>

    <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Permission</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form id="form-update-role-permission" class="form-horizontal" action="{{ url('update-role-permission') }}" method="POST">
            <div class="table-responsive" style="max-height:500px">
              <table id="table" class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width:15%;text-align:center;">
                      <button id="btn-check-uncheck-all" type="button" data-state="1" class="btn btn-default btn-xs">
                        <text id="btn-check-uncheck-actor" style="color:black">Check ALL</text>
                      </button>
                    </th>
                    <th style="width:25%;">Permission Slug</th>
                    <th style="">Description</th>
                  </tr>
                </thead>

                <tbody>

                  @foreach($permissions as $permission)
                  <tr>
                    <td style="text-align:center">
                      @if($role->permissions->contains('slug', $permission->slug))
                        <input type="checkbox" name="permission_id[]" class="permission_id" value="{{ $permission->id }}" checked>
                      @else
                        <input type="checkbox" name="permission_id[]" class="permission_id" value="{{ $permission->id }}">
                      @endif
                    </td>
                    <td>{{ $permission->slug }}</td>
                    <td>{{ $permission->description }}</td>

                  </tr>

                  @endforeach
                </tbody>
              </table>
            </div>
            @csrf
            <input type="hidden" name="role_id" value="{{ $role->id }}" />
            <button type="submit" class="btn btn-info pull-right">Save</button>
          </form>
        </div>
        <div class="card-footer clearfix"></div>
      </div>
    </div>
  </div>
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#btn-check-uncheck-all').on('click', function(event){
        event.preventDefault();
        if($(this).attr('data-state') == "1"){
          $('.permission_id').prop('checked', true);
          $('#btn-check-uncheck-all').attr('data-state', '2');
          $('#btn-check-uncheck-actor').html("Uncheck All");
        }
        else{
          $('.permission_id').prop('checked', false);
          $('#btn-check-uncheck-all').attr('data-state', '1');
          $('#btn-check-uncheck-actor').html("Check All");
        }
      });
    });
  </script>
@endsection
