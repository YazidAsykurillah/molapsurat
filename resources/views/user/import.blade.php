@extends('layouts.app')

@section('pageTitle')
  Import Pengguna
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Import Pengguna</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ url('user') }}">Pengguna</a></li>
        <li class="breadcrumb-item active">Im,port</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Import Pengguna</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ url('user/import') }}" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="role_id" class="col-sm-2 col-form-label">{{ __('Jabatan') }}</label>
              <div class="col-md-6">
                  <select name="role_id" id="role_id" class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}">
                    <option value="{{old('role_id') ? old('role_id') : '' }}">
                      {{old('role_id') ? \App\Role::find(old('role_id'))->name : '---Select Role---'}}
                    </option>
                    @if($roles->count())
                      @foreach($roles as $role)
                      <option value="{{ $role->id}}">{{$role->name}}</option>
                      @endforeach
                    @endif
                  </select>
                  @if ($errors->has('role_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('role_id') }}</strong>
                    </span>
                  @endif
              </div>
            </div>
            
            <div class="form-group row">
              <label for="file" class="col-sm-2 col-form-label">{{ __('File') }}</label>
              <div class="col-md-6">
                  <input id="file" type="file" class="form-control{{ $errors->has('file') ? ' is-invalid' : '' }}" name="file">
                  @if ($errors->has('file'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('file') }}</strong>
                      </span>
                  @endif
              </div>
            </div>

            

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('user') }}" class="btn btn-default">
                  <i class="fa fa-window-close"></i> Batal
                </a>&nbsp;
                <button type="submit" class="btn btn-info">
                  <i class="fa fa-save"></i> Import
                </button>
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
  </div>
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      
    });
  </script>
@endsection
