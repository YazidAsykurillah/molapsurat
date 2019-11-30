@extends('layouts.app')

@section('pageTitle')
  Input Tujuan Surat Tugas
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Input Tujuan Surat Tugas</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('tujuan-surat-tugas') }}">Input Tujuan Surat Tugas</a></li>
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
          <h3 class="card-title">Input Tujuan Surat Tugas</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" id="form-create" action="{{ url('tujuan-surat-tugas') }}" class="form form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="nama" class="col-sm-2 col-form-label">{{ __('Nama') }}</label>
              <div class="col-md-4">
                <input id="nama" type="text" class="form-control{{ $errors->has('nama') ? ' is-invalid' : '' }}" name="nama" value="{{ old('nama') }}">
                @if ($errors->has('nama'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('nama') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="alamat" class="col-sm-2 col-form-label">{{ __('Alamat') }}</label>
              <div class="col-md-8">
                <textarea name="alamat" class="form-control {{ $errors->has('alamat') ? ' is-invalid' : '' }}"></textarea>
                <span class="d-block invalid-feedback" role="alert">
                    <strong>{{ $errors->first('alamat') }}</strong>
                </span>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('tujuan-surat-tugas') }}" class="btn btn-default">
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
