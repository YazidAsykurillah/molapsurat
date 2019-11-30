@extends('layouts.app')

@section('pageTitle')
  Jenis Surat Tugas :: {{ $jenis_surat_tugas->judul }}
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Detail Jenis Surat Tugas</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('jenis-surat-tugas') }}">Jenis Surat Tugas</a></li>
        <li class="breadcrumb-item active">Show</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Jenis Surat Tugas</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td style="width: 20%;">Judul</td>
                <td style="width: 5%;">:</td>
                <td style="">{{ $jenis_surat_tugas->judul }}</td>
              </tr>
              <tr>
                <td style="width: 20%;">Deskripsi</td>
                <td style="width: 5%;">:</td>
                <td style="">{{ $jenis_surat_tugas->deskripsi }}</td>
              </tr>
            </tbody>
          </table>
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
