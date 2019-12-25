@extends('layouts.app')

@section('pageTitle')
  Detail Pengajuan Keuangan
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Detail Pengajuan Keuangan</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="#">Keuangan</a></li>
        <li class="breadcrumb-item"><a href="{{ url('pengajuan-keuangan') }}">Pengajuan Keuangan</a></li>
        <li class="breadcrumb-item"><a href="{{ url('pengajuan-keuangan/'.$pengajuan_keuangan->id.'') }}">{{ $pengajuan_keuangan->id }}</a></li>
        <li class="breadcrumb-item active">Show</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Pengajuan Keuangan</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <p class="">Jenis Kegiatan
            <b class="d-block">{{ $pengajuan_keuangan->jenis_surat_tugas->judul }}</b>
          </p>
          <p class="">Nama Kegiatan
            <b class="d-block">{{ $pengajuan_keuangan->nama_kegiatan }}</b>
          </p>
          <p class="">Tanggal Mulai Kegiatan
            <b class="d-block">{{ $pengajuan_keuangan->tanggal_mulai_kegiatan }}</b>
          </p>
          <p class="">Tanggal Selesai Kegiatan
            <b class="d-block">{{ $pengajuan_keuangan->tanggal_selesai_kegiatan }}</b>
          </p>
          <p class="">Penanggung Jawab
            <b class="d-block">{{ $pengajuan_keuangan->pic->name }}</b>
          </p>
          <p class="">Jumlah Anggaran
            <b class="d-block">{{ number_format($pengajuan_keuangan->jumlah_pengajuan) }}</b>
          </p>
          
        </div>
        <div class="card-footer clearfix"></div>
      </div>
    </div>

    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Realisasi Keuangan</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <p class="">Jumlah Realisasi
            @if($pengajuan_keuangan->realisasi_keuangan)
            <b class="d-block">{{ number_format($pengajuan_keuangan->realisasi_keuangan->jumlah_realisasi, 2) }}</b>
            @else
            <b class="d-block">-</b>
            <button class="btn btn-primary btn-xs" id="btn-create-realisasi-keuangan">
              <i class="fa fa-plus-circle"></i>&nbsp;Input Realisasi
            </button>
            @endif
          </p>
        </div>
        <div class="card-footer clearfix"></div>
      </div>
    </div>

  </div>

  <!--Modal Create Realisasi Keuangan-->
  <div class="modal fade" id="modal-create-realisasi-keuangan">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <form id="form-create-realisasi-keuangan" class="form form-horizontal" method="POST" action="{{ url('realisasi-keuangan/store') }}">
          @csrf
          <div class="modal-header">
            <h4 class="modal-title">Input Realisasi Keuangan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="jumlah_realisasi" class="col-sm-4 col-form-label">{{ __('Jumlah Realisasi') }}</label>
              <div class="col-md-8">
                <input id="jumlah_realisasi" type="text" class="form-control{{ $errors->has('jumlah_realisasi') ? ' is-invalid' : '' }}" name="jumlah_realisasi" value="{{ old('jumlah_realisasi') }}">
                @if ($errors->has('jumlah_realisasi'))
                  <span class="d-block invalid-feedback" role="alert">
                      <strong>{{ $errors->first('jumlah_realisasi') }}</strong>
                  </span>
                @endif
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="pengajuan_keuangan_id" id="pengajuan_keuangan_id" value="{{ $pengajuan_keuangan->id }}">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-light btn-info" id="btn-submit-realisasi-keuangan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--ENDModal Create Realisasi Keuangan-->
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#btn-create-realisasi-keuangan').on('click', function(event){
        event.preventDefault();
        $('#modal-create-realisasi-keuangan').modal('show');
      });

      $('#jumlah_realisasi').autoNumeric('init',{
        aSep:',',
        aDec:'.'
      });

      $('#form-create-realisasi-keuangan').on('submit', function(){
        $('#btn-submit-realisasi-keuangan').prop('disabled', true);
      });
    });
  </script>
@endsection
