@extends('layouts.app')

@section('pageTitle')
  Input Pengajuan Keuangan
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Input Pengajuan Keuangan</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
        <li class="breadcrumb-item"><a href="{{ url('pengajuan-keuangan') }}">Pengajuan Keuangan</a></li>
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
          <h3 class="card-title">Form Input Pengajuan Keuangan</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" id="form-create" action="{{ url('pengajuan-keuangan') }}" class="form form-horizontal" enctype="multipart/form-data">
            @csrf
             <div class="form-group row">
              <label for="surat_tugas_id" class="col-sm-2 col-form-label">{{ __('Surat Tugas') }}</label>
              <div class="col-md-4">
                <select class="form-control" name="surat_tugas_id" id="surat_tugas_id"></select>
                @if ($errors->has('surat_tugas_id'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('surat_tugas_id') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="jumlah_pengajuan" class="col-sm-2 col-form-label">{{ __('Jumlah Anggaran') }}</label>
              <div class="col-md-4">
                <input id="jumlah_pengajuan" type="text" class="form-control{{ $errors->has('jumlah_pengajuan') ? ' is-invalid' : '' }}" name="jumlah_pengajuan" value="{{ old('jumlah_pengajuan') }}">
                @if ($errors->has('jumlah_pengajuan'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('jumlah_pengajuan') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('pengajuan-keuangan') }}" class="btn btn-default">
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
      //Select Surat Tugas
      $('#surat_tugas_id').select2({
        placeholder: '----Select----',
        ajax: {
          url: '{!! url('pengajuan-keuangan/select2SuratTugas') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function(data){
            return {
              results: $.map(data, function(item){
                  return {
                      text: item.nomor,
                      id: item.id,
                      uraian: item.uraian,
                      tanggal_mulai: item.tanggal_mulai,
                      tanggal_selesai: item.tanggal_selesai
                  }
                })
            };
          },
          cache: true
        },
        allowClear : true,
      });

      $('#jumlah_pengajuan').autoNumeric('init',{
        aSep:',',
        aDec:'.'
      });

      $('#form-create').on('submit', function(){
        $('#btn-submit').prop('disabled', true);
      });

    });
  </script>
@endsection
