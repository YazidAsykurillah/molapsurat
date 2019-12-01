@extends('layouts.app')

@section('pageTitle')
  Input Jabatan
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Input Jabatan</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('role') }}">Jabatan</a></li>
        <li class="breadcrumb-item active">Input Jabatan</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Input Jabatan</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" id="form-create" action="{{ url('role') }}" class="form form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="code" class="col-sm-2 col-form-label">{{ __('Code') }}</label>
              <div class="col-md-4">
                <input id="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" name="code" value="{{ old('code') }}">
                @if ($errors->has('code'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('code') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
              <div class="col-md-4">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="label" class="col-sm-2 col-form-label">{{ __('Label') }}</label>
              <div class="col-md-8">
                <textarea name="label" class="form-control {{ $errors->has('label') ? ' is-invalid' : '' }}"></textarea>
                <span class="d-block invalid-feedback" role="alert">
                    <strong>{{ $errors->first('label') }}</strong>
                </span>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('role') }}" class="btn btn-default">
                  <i class="fa fa-window-close"></i> Batal
                </a>&nbsp;
                <button type="submit" class="btn btn-info" id="btn-submit">
                  <i class="fa fa-save"></i> Simpan
                </button>
              </div>
            </div>
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
      //Form create submission handling
      $('#form-create').on('submit', function(){
        $('#btn-submit').prop('disabled', true);
      });
    });
  </script>
@endsection
