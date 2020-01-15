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
        <span class="info-box-icon bg-blue elevation-1"><i class="fas fa-book"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Laporan Surat Tugas</span>
          <span class="info-box-number">
            {{ $laporan_surat_tugas_count }}
          </span>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-red elevation-1"><i class="fas fa-book"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Laporan Belum Selesai</span>
          <span class="info-box-number">
            {{ $laporan_surat_tugas_belum_selesai_count }}
          </span>
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-green elevation-1"><i class="fas fa-book"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Laporan Selesai</span>
          <span class="info-box-number">
            {{ $laporan_surat_tugas_selesai_count }}
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
          <h3 class="card-title">Anggaran</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="anggaranChart" style="height: 230px; min-height: 230px; display: block; width: 470px;" width="470" height="230" class="chartjs-render-monitor"></canvas>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){


      $.ajax({
         type:'GET',
         url:'/chart-data-anggaran',
         success:function(response) {

            var anggaranChartCanvas = $('#anggaranChart').get(0).getContext('2d');
            var anggaranChart = new Chart(anggaranChartCanvas, {
              type: 'bar',
              data: {
                  labels: response.labels,
                  datasets: [{
                      label: '# Anggaran',
                      data: response.data,
                      borderWidth: 1,
                      backgroundColor: response.backgroundColor,
                  }]
              },
              options: {
                  scales: {
                      yAxes: [{
                          ticks: {
                              beginAtZero: true
                          }
                      }]
                  }
              }
               
            });

         }
      });

      
      

    });
  </script>
@endsection
