@extends('layouts.app')

@section('pageTitle')
  Detail Tujuan Surat Tugas
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Detail Tujuan Surat Tugas</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('tujuan-surat-tugas') }}">Tujuan Surat Tugas</a></li>
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
          <h3 class="card-title">Detail Tujuan Surat Tugas</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <td style="width: 20%;">Nama</td>
                <td style="width: 5%;">:</td>
                <td style="">{{ $tujuan_surat_tugas->nama }}</td>
              </tr>
              <tr>
                <td style="width: 20%;">Alamat</td>
                <td style="width: 5%;">:</td>
                <td style="">{{ $tujuan_surat_tugas->alamat }}</td>
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
