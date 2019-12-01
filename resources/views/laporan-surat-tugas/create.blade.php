@extends('layouts.app')

@section('pageTitle')
  Buat Laporan Surat Tugas
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Buat Laporan Surat Tugas</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('laporan-surat-tugas') }}">Laporan Surat Tugas</a></li>
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
          <h3 class="card-title">Form Buat Laporan Surat Tugas</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" id="form-create" action="{{ url('laporan-surat-tugas') }}" class="form form-horizontal" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="surat_tugas_id" class="col-sm-2 col-form-label">{{ __('Surat Tugas') }}</label>
              <div class="col-md-4">
                <select name="surat_tugas_id" id="surat_tugas_id" class="form-control"></select>
                @if ($errors->has('surat_tugas_id'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('surat_tugas_id') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_approve_ketua_tim" class="col-sm-2 col-form-label">{{ __('Tanggal Approve Ketua Tim') }}</label>
              <div class="col-md-4">
                <input id="tanggal_approve_ketua_tim" type="text" class="form-control{{ $errors->has('tanggal_approve_ketua_tim') ? ' is-invalid' : '' }}" name="tanggal_approve_ketua_tim" value="{{ old('tanggal_approve_ketua_tim') }}">
                @if ($errors->has('tanggal_approve_ketua_tim'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal_approve_ketua_tim') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_approve_pengendali_mutu" class="col-sm-2 col-form-label">{{ __('Tanggal Approve Pengendali Mutu') }}</label>
              <div class="col-md-4">
                <input id="tanggal_approve_pengendali_mutu" type="text" class="form-control{{ $errors->has('tanggal_approve_pengendali_mutu') ? ' is-invalid' : '' }}" name="tanggal_approve_pengendali_mutu" value="{{ old('tanggal_approve_pengendali_mutu') }}">
                @if ($errors->has('tanggal_approve_pengendali_mutu'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal_approve_pengendali_mutu') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_approve_pengendali_teknis" class="col-sm-2 col-form-label">{{ __('Tanggal Approve Pengendali Teknis') }}</label>
              <div class="col-md-4">
                <input id="tanggal_approve_pengendali_teknis" type="text" class="form-control{{ $errors->has('tanggal_approve_pengendali_teknis') ? ' is-invalid' : '' }}" name="tanggal_approve_pengendali_teknis" value="{{ old('tanggal_approve_pengendali_teknis') }}">
                @if ($errors->has('tanggal_approve_pengendali_teknis'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal_approve_pengendali_teknis') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="attachment" class="col-sm-2 col-form-label">{{ __('Attachment') }}</label>
              <div class="col-md-4">
                <input type="file" name="attachment" class="form-control">
                @if ($errors->has('attachment'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('attachment') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('laporan-surat-tugas') }}" class="btn btn-default">
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
      $('#tanggal_approve_ketua_tim,#tanggal_approve_pengendali_mutu,#tanggal_approve_pengendali_teknis').daterangepicker({
        locale: {
          format: 'YYYY-MM-DD',
        },
        singleDatePicker: true,
      });
      
      //Select Surat Tugas
      $('#surat_tugas_id').select2({
        placeholder: '----Select----',
        ajax: {
          url: '{!! url('laporan-surat-tugas/select2SuratTugas') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nomor,
                        id: item.id,
                    }
                })
            };
          },
          cache: true
        },
        allowClear : true,
      }).on('select2:select', function(){
        
      });

    });
  </script>
@endsection
