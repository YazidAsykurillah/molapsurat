@extends('layouts.app')

@section('pageTitle')
  Laporan Surat Tugas :: {{ $surat_tugas->nomor }}
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Detail Laporan Surat Tugas</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('laporan-surat-tugas') }}">Laporan Surat Tugas</a></li>
        <li class="breadcrumb-item active">Show</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Surat Tugas</h3>
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
          <p class="">Attachment
            <b class="d-block">
              @if($surat_tugas->attachment)
              <a href="{{ url('files/surat-tugas') }}/{{$surat_tugas->attachment}}">
                <i class="fa fa-file"></i>
              </a>
            @endif
            </b>
          </p>
        </div>
        <div class="card-footer clearfix"></div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Laporan Surat Tugas
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <p class="">Tanggal Approve Ketua Tim
            <b class="d-block">{{ $laporan_surat_tugas->tanggal_approve_ketua_tim }}</b>
          </p>
          <p class="">Tanggal Approve Pengendali Mutu
            <b class="d-block">{{ $laporan_surat_tugas->tanggal_approve_pengendali_mutu }}</b>
          </p>
          <p class="">Tanggal Approve Pengendali Teknis
            <b class="d-block">{{ $laporan_surat_tugas->tanggal_approve_pengendali_teknis }}</b>
          </p>
          <p class="">Attachment
            <b class="d-block">
              @if($laporan_surat_tugas->attachment)
              <a href="{{ url('files/laporan-surat-tugas') }}/{{$laporan_surat_tugas->attachment}}">
                <i class="fa fa-file"></i>
              </a>
            @endif
            </b>
          </p>
        </div>
        <div class="card-footer clearfix"></div>
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
