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
    <!--Col Laporan Surat Tugas-->
    <div class="col-md-8">
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
          <p class="">Status
            <b class="d-block">{{ status_laporan_surat_tugas($laporan_surat_tugas->status) }}</b>
          </p>
          <p class="">Nomor Routing Slip
            <b class="d-block">{{ $laporan_surat_tugas->nomor_routing_slip }}</b>
          </p>
        </div>
        <div class="card-footer clearfix">
          @if($laporan_surat_tugas->status == NULL)
            <button class="btn btn-primary" id="btn-approve-by-kasubag-tu">
              <i class="fa fa-check"></i> Approve By Kasubag TU
            </button>
          @elseif($laporan_surat_tugas->status == '1')
            <button class="btn btn-primary" id="btn-approve-by-inspektur">
              <i class="fa fa-check"></i> Approve By Inspektur
            </button>
          @elseif($laporan_surat_tugas->status == '2')
            <button class="btn btn-primary" id="btn-approve-by-tu-ses">
              <i class="fa fa-check"></i> Approve By TU SES
            </button>
          @elseif($laporan_surat_tugas->status == '3')
            <button class="btn btn-primary" id="btn-complete">
              <i class="fa fa-check"></i> Complete
            </button>
          @endif
        </div>
      </div>
    </div>
    <!--ENDCol Laporan Surat Tugas-->
    <!--Col Surat Tugas-->
    <div class="col-md-4">
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
    <!--ENDCol Laporan Surat Tugas-->
  </div>

  <!--Modal Approve By Kasubag TU-->
  <div class="modal fade" id="modal-approve-by-kasubag-tu">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <form id="form-approve-by-kasubag-tu" class="form form-horizontal" method="POST" action="{{ url('laporan-surat-tugas/'.$laporan_surat_tugas->id.'/approve-by-kasubag-tu') }}">
          @csrf
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="confirmation_text">Ubah Status ke Approve By Kasubag TU</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-light btn-danger">OK</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--ENDModal Approve By Kasubag TU-->

  <!--Modal Approve By Inspektur-->
  <div class="modal fade" id="modal-approve-by-inspektur">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <form id="form-approve-by-inspektur" class="form form-horizontal" method="POST" action="{{ url('laporan-surat-tugas/'.$laporan_surat_tugas->id.'/approve-by-inspektur') }}">
          @csrf
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="confirmation_text">Ubah Status ke Approve By Inspektur</p>
            <div class="form-group row">
              <label for="nomor_routing_slip" class="col-sm-4 col-form-label">{{ __('Nomor Routing Slip') }}</label>
              <div class="col-md-8">
                <input type="text" name="nomor_routing_slip" class="form-control" required>
                <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nomor_routing_slip') }}</strong>
                    </span>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-light btn-danger">OK</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--ENDModal Approve By Inspektur-->

  <!--Modal Approve By TU SES-->
  <div class="modal fade" id="modal-approve-by-tu-ses">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <form id="form-approve-by-tu-ses" class="form form-horizontal" method="POST" action="{{ url('laporan-surat-tugas/'.$laporan_surat_tugas->id.'/approve-by-tu-ses') }}">
          @csrf
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="confirmation_text">Ubah Status ke Approve By TU SES</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-light btn-danger">OK</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--ENDModal Approve By TU SES-->

  <!--Modal Complete-->
  <div class="modal fade" id="modal-complete">
    <div class="modal-dialog">
      <div class="modal-content bg-info">
        <form id="form-complete" class="form form-horizontal" method="POST" action="{{ url('laporan-surat-tugas/'.$laporan_surat_tugas->id.'/complete') }}">
          @csrf
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="confirmation_text">Ubah Status ke Completed</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-outline-light btn-danger">OK</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--ENDModal Complete-->
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      //Handling Approve By Kasubag TU
      $('#btn-approve-by-kasubag-tu').on('click', function(event){
        event.preventDefault();
        $('#modal-approve-by-kasubag-tu').modal('show');
      });
      //ENDHandling Approve By Kasubag TU

      //Handling Approve By Inspektur
      $('#btn-approve-by-inspektur').on('click', function(event){
        event.preventDefault();
        $('#modal-approve-by-inspektur').modal('show');
      });
      //ENDHandling Approve By Inspektur

      //Handling Approve By TU SES
      $('#btn-approve-by-tu-ses').on('click', function(event){
        event.preventDefault();
        $('#modal-approve-by-tu-ses').modal('show');
      });
      //ENDHandling Approve By TU SES

      //Handling Complete
      $('#btn-complete').on('click', function(event){
        event.preventDefault();
        $('#modal-complete').modal('show');
      });
      //ENDHandling Complete
      
    });
  </script>
@endsection
