@extends('layouts.app')

@section('pageTitle')
  Jenis Surat Tugas
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Jenis Surat Tugas</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('jenis-surat-tugas') }}">Jenis Surat Tugas</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Input Jenis Surat Tugas</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" id="form-create" action="{{ url('jenis-surat-tugas') }}" class="form form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="judul" class="col-sm-2 col-form-label">{{ __('Judul') }}</label>
              <div class="col-md-4">
                <input id="judul" type="text" class="form-control{{ $errors->has('judul') ? ' is-invalid' : '' }}" name="judul" value="{{ old('judul') }}">
                @if ($errors->has('judul'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('judul') }}</strong>
                  </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="deskripsi" class="col-sm-2 col-form-label">{{ __('Deskripsi') }}</label>
              <div class="col-md-8">
                <textarea name="deskripsi" class="form-control {{ $errors->has('deskripsi') ? ' is-invalid' : '' }}"></textarea>
                <span class="d-block invalid-feedback" role="alert">
                    <strong>{{ $errors->first('deskripsi') }}</strong>
                </span>
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('jenis-surat-tugas') }}" class="btn btn-default">
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
