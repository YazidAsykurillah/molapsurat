@extends('layouts.app')

@section('pageTitle')
  Edit Pengguna
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Edit Pengguna</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{ url('user') }}">Pengguna</a></li>
        <li class="breadcrumb-item active">Edit</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Edit Pengguna</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form id="form-edit" action="{{ url('user', [$user->id]) }}" class="form form-horizontal" method="POST">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
              <div class="col-md-6">
                  <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ? old('name') : $user->name }}" autofocus>
                  @if ($errors->has('name'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
              <div class="col-md-6">
                  <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') ? old('email') : $user->email }}">
                  @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="role_id" class="col-sm-2 col-form-label">{{ __('Jabatan') }}</label>
              <div class="col-md-6">
                  <select name="role_id" id="role_id" class="form-control {{ $errors->has('role_id') ? ' is-invalid' : '' }}">
                    <option value="{{old('role_id') ? old('role_id') : '' }}">
                      {{old('role_id') ? \App\Role::find(old('role_id'))->name : '---Select Role---'}}
                    </option>
                    @if($roles->count())
                      @if($user->roles->count())
                        @foreach($roles as $role)
                          @if($role->id == $user->roles->first()->id)
                          <option value="{{ $role->id}}" selected="selected">{{$role->name}}</option>
                          @else  
                          <option value="{{ $role->id}}">{{$role->name}}</option>
                          @endif
                        @endforeach
                      @else
                        @foreach($roles as $role)
                          <option value="{{ $role->id}}">{{$role->name}}</option>
                        @endforeach
                      @endif
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
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('user') }}" class="btn btn-default">
                  <i class="fa fa-window-close"></i> Batal
                </a>&nbsp;
                <button type="submit" class="btn btn-info">
                  <i class="fa fa-save"></i> Simpan
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
