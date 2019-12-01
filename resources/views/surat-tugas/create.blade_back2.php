@extends('layouts.app')

@section('pageTitle')
  Buat Surat Tugas
@endsection

@section('additional_styles')
  <style type="text/css"></style>
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Buat Surat Tugas</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('surat-tugas') }}">Surat Tugas</a></li>
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
          <h3 class="card-title">Form Buat Surat Tugas</h3>
          <div class="card-tools"></div>
        </div>
        <div class="card-body">
          <form method="POST" id="form-create" action="{{ url('surat-tugas') }}" class="form form-horizontal" enctype="multipart/form-data">
            @csrf

            <div class="form-group row">
              <label for="nomor" class="col-sm-2 col-form-label">{{ __('Nomor') }}</label>
              <div class="col-md-4">
                <input id="nomor" type="text" class="form-control{{ $errors->has('nomor') ? ' is-invalid' : '' }}" name="nomor" value="{{ old('nomor') }}">
                @if ($errors->has('nomor'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nomor') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="tanggal" class="col-sm-2 col-form-label">{{ __('Tanggal') }}</label>
              <div class="col-md-4">
                <input id="tanggal" type="text" class="form-control{{ $errors->has('tanggal') ? ' is-invalid' : '' }}" name="tanggal" value="{{ old('tanggal') }}">
                @if ($errors->has('tanggal'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="jenis_surat_tugas_id" class="col-sm-2 col-form-label">{{ __('Jenis Surat Tugas') }}</label>
              <div class="col-md-4">
                <select name="jenis_surat_tugas_id" id="jenis_surat_tugas_id" class="form-control"></select>
                @if ($errors->has('jenis_surat_tugas_id'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('jenis_surat_tugas_id') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tujuan_surat_tugas_id" class="col-sm-2 col-form-label">{{ __('Tujuan Surat Tugas') }}</label>
              <div class="col-md-4">
                <select name="tujuan_surat_tugas_id" id="tujuan_surat_tugas_id" class="form-control"></select>
                @if ($errors->has('tujuan_surat_tugas_id'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tujuan_surat_tugas_id') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_mulai" class="col-sm-2 col-form-label">{{ __('Tanggal Mulai') }}</label>
              <div class="col-md-4">
                <input id="tanggal_mulai" type="text" class="form-control{{ $errors->has('tanggal_mulai') ? ' is-invalid' : '' }}" name="tanggal_mulai" value="{{ old('tanggal_mulai') }}">
                @if ($errors->has('tanggal_mulai'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal_mulai') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="tanggal_selesai" class="col-sm-2 col-form-label">{{ __('Tanggal Selesai') }}</label>
              <div class="col-md-4">
                <input id="tanggal_selesai" type="text" class="form-control{{ $errors->has('tanggal_selesai') ? ' is-invalid' : '' }}" name="tanggal_selesai" value="{{ old('tanggal_selesai') }}">
                @if ($errors->has('tanggal_selesai'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('tanggal_selesai') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="team" class="col-sm-2 col-form-label">{{ __('Team') }}</label>
              <div class="col-md-8">
               <table class="table" id="table-team">
                 <thead>
                   <tr>
                     <th>User</th>
                     <th style="width: 40%;">Posisi</th>
                     <th style="width: 10%;">
                      <button type="button" id="btn-add-team" class="btn btn-info btn-xs">
                        <i class="fa fa-plus-circle"></i>
                      </button>
                     </th>
                   </tr>
                 </thead>
                 <tbody>
                   <tr>
                     <td>
                      <select name="user_id[]" class="form-control select2-user" required></select>
                     </td>
                     <td>
                      <select name="position[]" class="form-control select2-position" required>
                        <option value="">---Select Position--</option>
                        @if(count($position_options))
                          @foreach($position_options as $pos)
                          <option value="{{ $pos }}">{{$pos}}</option>
                          @endforeach
                        @endif
                      </select>
                     </td>
                   </tr>
                 </tbody>
               </table>
              </div>
            </div>

            <div class="form-group row">
              <label for="uraian" class="col-sm-2 col-form-label">{{ __('Uraian') }}</label>
              <div class="col-md-8">
                <textarea name="uraian" class="form-control"></textarea>
                <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('uraian') }}</strong>
                    </span>
              </div>
            </div>

            <div class="form-group row">
              <label for="attachment" class="col-sm-2 col-form-label">{{ __('Attachment') }}</label>
              <div class="col-md-4">
                <input type="file" name="attachment" class="form-control">
                @if ($errors->has('attachment'))
                    <span class="d-block invalid-feedback" role="alert">
                        <strong>{{ $errors->first('attachment') }}</strong>
                    </span>
                @endif
              </div>
            </div>
            
            <div class="form-group row">
              <label for="" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <a href="{{ url('surat-tugas') }}" class="btn btn-default">
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
      $('#tanggal,#tanggal_mulai,#tanggal_selesai').daterangepicker({
        locale: {
          format: 'YYYY-MM-DD',
        },
        singleDatePicker: true,
      });

      //Select Jenis Surat Id
      $('#jenis_surat_tugas_id').select2({
        placeholder: '----Select----',
        ajax: {
          url: '{!! url('jenis-surat-tugas/select2') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.judul,
                        id: item.id,
                    }
                })
            };
          },
          cache: true
        },
        allowClear : true,
      }).on('select2:select', function(){
        
      });

      //Select Tujuan Surat Tugas
      $('#tujuan_surat_tugas_id').select2({
        placeholder: '----Select----',
        ajax: {
          url: '{!! url('tujuan-surat-tugas/select2') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.nama,
                        id: item.id,
                    }
                })
            };
          },
          cache: true
        },
        allowClear : true,
      }).on('select2:select', function(){
        
      });

      //Select User Handling
      $('.select2-user').select2({
        placeholder: '----Select User----',
        ajax: {
          url: '{!! url('user/select2') !!}',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id,
                    }
                })
            };
          },
          cache: true
        },
        allowClear : true,
      }).on('select2:select', function(){
        
      });

      //Add Team handler
      $('#btn-add-team').on('click', function(event){
        event.preventDefault();
        $('.select2-user').select2("destroy");
        var firstSelect2Position = $('#table-team').find('.select2-position').first().clone(true);

        var markupteam = '<tr>';
            markupteam+=  '<td>';
            markupteam+=    '<select name="user_id[]" class="form-control select2-user" required>';
            markupteam+=    '</select>';
            markupteam+=  '</td>';
            markupteam+=  '<td>';
            markupteam+=  '</td>';
            markupteam+=  '<td>';
            markupteam+=    '<button type="button" class="btn btn-danger btn-xs btn-delete-team">';
            markupteam+=      '<i class="fa fa-trash"></i>';
            markupteam+=    '</button>';
            markupteam+=  '</td>';
            markupteam+= '</tr>';
            
            console.log($(markupteam).find('td:eq(1)'));

        $("#table-team tbody").append(markupteam);

        //Reinitilaze select2
        $('.select2-user').select2({
          placeholder: '----Select User----',
          ajax: {
            url: '{!! url('user/select2') !!}',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
              return {
                results:  $.map(data, function (item) {
                      return {
                          text: item.name,
                          id: item.id,
                      }
                  })
              };
            },
            cache: true
          },
          allowClear : true,
        }).on('select2:select', function(){
          
        });
        //ENDReinitilaze select2

      });


      //Form create submission handling
      $('#form-create').on('submit', function(){
        $('#btn-submit').prop('disabled', true);
      });

    });
  </script>
@endsection
