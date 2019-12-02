@extends('layouts.app')

@section('pageTitle')
  Buat Laporan Surat Tugas
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-md-6">
      <h1 class="m-0 text-dark">Buat Laporan Surat Tugas</h1>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('laporan-surat-tugas') }}">Laporan Surat Tugas</a></li>
        <li class="breadcrumb-item active">Create</li>
      </ol>
    </div>
  </div>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-7">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Buat Laporan Surat Tugas</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" id="form-create" action="{{ url('laporan-surat-tugas') }}" class="form form-horizontal" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="surat_tugas_id" class="col-md-6 col-form-label">{{ __('Surat Tugas') }}</label>
              <div class="col-md-6">
                <select name="surat_tugas_id" id="surat_tugas_id" class="form-control"></select>
                @if ($errors->has('surat_tugas_id'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('surat_tugas_id') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_approve_ketua_tim" class="col-md-6 col-form-label">{{ __('Tanggal Approve Ketua Tim') }}</label>
              <div class="col-md-6">
                <input id="tanggal_approve_ketua_tim" type="text" class="form-control{{ $errors->has('tanggal_approve_ketua_tim') ? ' is-invalid' : '' }}" name="tanggal_approve_ketua_tim" value="{{ old('tanggal_approve_ketua_tim') }}">
                @if ($errors->has('tanggal_approve_ketua_tim'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal_approve_ketua_tim') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_approve_pengendali_mutu" class="col-md-6 col-form-label">{{ __('Tanggal Approve Pengendali Mutu') }}</label>
              <div class="col-md-6">
                <input id="tanggal_approve_pengendali_mutu" type="text" class="form-control{{ $errors->has('tanggal_approve_pengendali_mutu') ? ' is-invalid' : '' }}" name="tanggal_approve_pengendali_mutu" value="{{ old('tanggal_approve_pengendali_mutu') }}">
                @if ($errors->has('tanggal_approve_pengendali_mutu'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal_approve_pengendali_mutu') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_approve_pengendali_teknis" class="col-md-6 col-form-label">{{ __('Tanggal Approve Pengendali Teknis') }}</label>
              <div class="col-md-6">
                <input id="tanggal_approve_pengendali_teknis" type="text" class="form-control{{ $errors->has('tanggal_approve_pengendali_teknis') ? ' is-invalid' : '' }}" name="tanggal_approve_pengendali_teknis" value="{{ old('tanggal_approve_pengendali_teknis') }}">
                @if ($errors->has('tanggal_approve_pengendali_teknis'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal_approve_pengendali_teknis') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="attachment" class="col-md-6 col-form-label">{{ __('Attachment') }}</label>
              <div class="col-md-6">
                <input type="file" name="attachment" class="form-control">
                @if ($errors->has('attachment'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('attachment') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="" class="col-md-6 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('laporan-surat-tugas') }}" class="btn btn-default">
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

    <!--Column selected surat tugas-->
    <div class="col-md-5">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Surat Tugas Terpilih</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body" id="card-body-selected-surat-tugas"></div>
      </div>
    </div>
    <!--ENDColumn selected surat tugas-->
  </div>
@endsection


@section('additional_scripts')
  <script type="text/javascript">
    $(document).ready(function(){
      $('#tanggal_approve_ketua_tim,#tanggal_approve_pengendali_mutu,#tanggal_approve_pengendali_teknis').daterangepicker({
        locale: {
          format: 'YYYY-MM-DD',
        },
        singleDatePicker: true,
      });
      
      //Select Surat Tugas
      $('#surat_tugas_id').select2({
        placeholder: '----Select----',
        ajax: {
          url: '{!! url('laporan-surat-tugas/select2SuratTugas') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function(data){
            return {
              results: $.map(data, function(item){
                  return {
                      text: item.nomor,
                      id: item.id,
                      uraian: item.uraian,
                      tanggal_mulai: item.tanggal_mulai,
                      tanggal_selesai: item.tanggal_selesai,
                      jenis_surat_tugas:item.jenis_surat_tugas,
                      tujuan_surat_tugas:item.tujuan_surat_tugas,
                      users:item.users
                  }
                })
            };
          },
          cache: true
        },
        allowClear : true,
      }).on('select2:select', function(){
        // $('#card-body-selected-surat-tugas').html('GGG');
        var selected_surat_tugas = $('#surat_tugas_id').select2('data')[0];
        console.log(selected_surat_tugas);
        //define selected surat_tugas_html
        var sshtml ='';
            sshtml+='<p class=""> Nomor Surat Tugas';
            sshtml+=  '<b class="d-block">';
            sshtml+=    selected_surat_tugas.text;
            sshtml+=  '</b>';
            sshtml+='</p>';
            sshtml+='<p class=""> Jenis Surat Tugas';
            sshtml+=  '<b class="d-block">';
            sshtml+=    selected_surat_tugas.jenis_surat_tugas.judul;
            sshtml+=  '</b>';
            sshtml+='</p>';
            sshtml+='<p class=""> Tujuan Surat Tugas';
            sshtml+=  '<b class="d-block">';
            sshtml+=    selected_surat_tugas.tujuan_surat_tugas.nama;
            sshtml+=  '</b>';
            sshtml+='</p>';
            sshtml+='<p class=""> Tanggal Mulai';
            sshtml+=  '<b class="d-block">';
            sshtml+=    selected_surat_tugas.tanggal_mulai;
            sshtml+=  '</b>';
            sshtml+='</p>';
            sshtml+='<p class=""> Tanggal Selesai';
            sshtml+=  '<b class="d-block">';
            sshtml+=    selected_surat_tugas.tanggal_selesai;
            sshtml+=  '</b>';
            sshtml+='</p>';
            sshtml+='<p class="">Team</p>';
            sshtml+='<table class="table">';
            sshtml+=  '<thead>';
            sshtml+=    '<tr>';
            sshtml+=      '<th>Nama</th>';
            sshtml+=      '<th>Posisi</th>';
            sshtml+=    '</tr>';
            sshtml+=  '</thead>';
            sshtml+=  '<tbody>';
            if(selected_surat_tugas.users.length){
              $.each(selected_surat_tugas.users, function(k,v){
                sshtml+='<tr>';
                sshtml+=  '<td>'+v.name+'</td>';
                sshtml+=  '<td>'+v.pivot.position+'</td>';    
                sshtml+='</tr>';
              });
            }
            sshtml+=  '</tbody>';
            sshtml+='</table>';
        $('#card-body-selected-surat-tugas').html(sshtml);

      }).on('select2:unselecting', function(){
        $('#card-body-selected-surat-tugas').html('');
      });


    });
  </script>
@endsection
