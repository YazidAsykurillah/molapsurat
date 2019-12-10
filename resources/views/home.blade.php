@extends('layouts.app')

@section('pageTitle')
  Dashboard
@endsection

@section('content-header')
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">.</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
@endsection

@section('content')
  <!--Row Info Boxes-->
  <div class="row">
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-olive elevation-1"><i class="fas fa-envelope"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Surat Tugas</span>
          <span class="info-box-number">
            {{ $surat_tugas_count }}
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-book"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Laporan Surat Tugas</span>
          <span class="info-box-number">
            {{ $laporan_surat_tugas_count }}
          </span>
        </div>
      </div>
    </div>

  </div>
  <!--ENDRow Info Boxes-->

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Dashboard</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          Welcome
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
