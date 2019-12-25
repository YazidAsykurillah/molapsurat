@extends('layouts.app')

@section('pageTitle')
  Edit Pengajuan Keuangan
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Edit Pengajuan Keuangan</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
        <li class="breadcrumb-item"><a href="{{ url('pengajuan-keuangan') }}">Pengajuan Keuangan</a></li>
        <li class="breadcrumb-item">
          <a href="{{ url('pengajuan-keuangan/'.$pengajuan_keuangan->id.'') }}">{{ $pengajuan_keuangan->id}}</a>
        </li>
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
          <h3 class="card-title">Form Edit Pengajuan Keuangan</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form id="form-edit" action="{{ url('pengajuan-keuangan', [$pengajuan_keuangan->id]) }}" class="form form-horizontal" method="POST">
            <input type="hidden" name="_method" value="PUT">
            @csrf
            <div class="form-group row">
              <label for="jenis_surat_tugas_id" class="col-sm-2 col-form-label">{{ __('Jenis Kegiatan') }}</label>
              <div class="col-md-4">
                <select class="form-control" name="jenis_surat_tugas_id" id="jenis_surat_tugas_id">
                  <option value="{{$pengajuan_keuangan->jenis_surat_tugas_id}}">{{ $pengajuan_keuangan->jenis_surat_tugas->judul }}</option>
                </select>
                @if ($errors->has('jenis_surat_tugas_id'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('jenis_surat_tugas_id') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="nama_kegiatan" class="col-sm-2 col-form-label">{{ __('Nama Kegiatan') }}</label>
              <div class="col-md-4">
                <input id="nama_kegiatan" type="text" class="form-control{{ $errors->has('nama_kegiatan') ? ' is-invalid' : '' }}" name="nama_kegiatan" value="{{ old('nama_kegiatan') ? old('nama_kegiatan') : $pengajuan_keuangan->nama_kegiatan }}">
                @if ($errors->has('nama_kegiatan'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('nama_kegiatan') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_mulai_kegiatan" class="col-sm-2 col-form-label">{{ __('Tanggal Mulai Kegiatan') }}</label>
              <div class="col-md-4">
                <input id="tanggal_mulai_kegiatan" type="text" class="form-control{{ $errors->has('tanggal_mulai_kegiatan') ? ' is-invalid' : '' }}" name="tanggal_mulai_kegiatan" value="{{ old('tanggal_mulai_kegiatan') ? old('tanggal_mulai_kegiatan') : $pengajuan_keuangan->tanggal_mulai_kegiatan }}">
                @if ($errors->has('tanggal_mulai_kegiatan'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('tanggal_mulai_kegiatan') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal_selesai_kegiatan" class="col-sm-2 col-form-label">{{ __('Tanggal Selesai Kegiatan') }}</label>
              <div class="col-md-4">
                <input id="tanggal_selesai_kegiatan" type="text" class="form-control{{ $errors->has('tanggal_selesai_kegiatan') ? ' is-invalid' : '' }}" name="tanggal_selesai_kegiatan" value="{{ old('tanggal_selesai_kegiatan') ? old('tanggal_selesai_kegiatan') : $pengajuan_keuangan->tanggal_selesai_kegiatan }}">
                @if ($errors->has('tanggal_selesai_kegiatan'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('tanggal_selesai_kegiatan') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="pic_id" class="col-sm-2 col-form-label">{{ __('Penanggung Jawab') }}</label>
              <div class="col-md-4">
                <select class="form-control" name="pic_id" id="pic_id">
                  <option value="{{ $pengajuan_keuangan->pic_id }}">{{ $pengajuan_keuangan->pic->name }}</option>
                </select>
                @if ($errors->has('pic_id'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('pic_id') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="jumlah_pengajuan" class="col-sm-2 col-form-label">{{ __('Jumlah Anggaran') }}</label>
              <div class="col-md-4">
                <input id="jumlah_pengajuan" type="text" class="form-control{{ $errors->has('jumlah_pengajuan') ? ' is-invalid' : '' }}" name="jumlah_pengajuan" value="{{ old('jumlah_pengajuan') ? old('jumlah_pengajuan') : $pengajuan_keuangan->jumlah_pengajuan }}">
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
      //Select Jenis Surat Tugas
      $('#jenis_surat_tugas_id').select2({
        placeholder: '----Select----',
        ajax: {
          url: '{!! url('pengajuan-keuangan/select2JenisSuratTugas') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function(data){
            return {
              results: $.map(data, function(item){
                  return {
                      text: item.judul,
                      id: item.id,
                  }
                })
            };
          },
          cache: true
        },
        allowClear : true,
      });

      $('#tanggal_mulai_kegiatan,#tanggal_selesai_kegiatan').daterangepicker({
        locale: {
          format: 'YYYY-MM-DD',
        },
        singleDatePicker: true,
      });

      //Select User Handling
      $('#pic_id').select2({
        placeholder: '----Select User----',
        ajax: {
          url: '{!! url('user/select2') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
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

      $('#jumlah_pengajuan').autoNumeric('init',{
        aSep:',',
        aDec:'.'
      });

      $('#form-edit').on('submit', function(){
        $('#btn-submit').prop('disabled', true);
      });

    });
  </script>
@endsection
