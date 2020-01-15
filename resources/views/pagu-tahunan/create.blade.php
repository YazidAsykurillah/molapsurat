@extends('layouts.app')

@section('pageTitle')
  Input Pagu Tahunan
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Input Pagu Tahunan</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
        <li class="breadcrumb-item"><a href="{{ url('pagu-tahunan') }}">Pagu Tahunan</a></li>
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
          <h3 class="card-title">Form Input Pagu Tahunan</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" id="form-create" action="{{ url('pagu-tahunan') }}" class="form form-horizontal" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
              <label for="tahun" class="col-sm-2 col-form-label">{{ __('Tahun') }}</label>
              <div class="col-md-4">
                <select class="form-control" name="tahun">
                  <option value="">--SELECT--</option>
                  @foreach($year_options as $year)
                  <option value="{{ $year }}" {{ old('tahun') == $year ? 'selected': '' }}>{{$year}}</option>
                  @endforeach
                </select>
                @if ($errors->has('tahun'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('tahun') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="jumlah_anggaran" class="col-sm-2 col-form-label">{{ __('Jumlah Anggaran') }}</label>
              <div class="col-md-4">
                <input id="jumlah_anggaran" type="text" class="form-control{{ $errors->has('jumlah_anggaran') ? ' is-invalid' : '' }}" name="jumlah_anggaran" value="{{ old('jumlah_anggaran') }}">
                @if ($errors->has('jumlah_anggaran'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('jumlah_anggaran') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="target_output" class="col-sm-2 col-form-label">{{ __('Target Output') }}</label>
              <div class="col-md-4">
                <input id="target_output" type="text" class="form-control{{ $errors->has('target_output') ? ' is-invalid' : '' }}" name="target_output" value="{{ old('target_output') }}">
                @if ($errors->has('target_output'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('target_output') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('pagu-tahunan') }}" class="btn btn-default">
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
      $('#jumlah_anggaran').autoNumeric('init',{
        aSep:',',
        aDec:'.'
      });
      $('#target_output').autoNumeric('init',{
        aSep:',',
        aDec:'.',
        mDec: '0'
      });

      $('#form-create').on('submit', function(){
        $('#btn-submit').prop('disabled', true);
      });

    });
  </script>
@endsection
