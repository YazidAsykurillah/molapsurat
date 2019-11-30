@extends('layouts.app')

@section('pageTitle')
  Surat Tugas :: {{ $surat_tugas->nomor }}
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Detail Surat Tugas</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('surat-tugas') }}">Surat Tugas</a></li>
        <li class="breadcrumb-item active">Show</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-9">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Informasi Surat Tugas</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <p class="">Nomor Surat Tugas
            <b class="d-block">{{ $surat_tugas->nomor }}</b>
          </p>
          <p class="">Jenis Surat
            <b class="d-block">{{ $surat_tugas->jenis_surat_tugas->judul }}</b>
          </p>
          <p class="">Tujuan Surat
            <b class="d-block">{{ $surat_tugas->tujuan_surat_tugas->nama }}</b>
          </p>
          <p class="">Tanggal Mulai
            <b class="d-block">{{ $surat_tugas->tanggal_mulai }}</b>
          </p>
          <p class="">Tanggal Selesai
            <b class="d-block">{{ $surat_tugas->tanggal_selesai }}</b>
          </p>
          <p class="">Uraian
            <b class="d-block">{{ $surat_tugas->uraian }}</b>
          </p>
        </div>
        <div class="card-footer clearfix"></div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Attachment</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          @if($surat_tugas->attachment)
            <a href="{{ url('files/surat-tugas') }}/{{$surat_tugas->attachment}}">
              <i class="fa fa-file"></i>
            </a>
          @endif
        </div>
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
