@extends('layouts.app')

@section('pageTitle')
  Detail Pengguna
@endsection

@section('content-header')
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Detail Pengguna</h1>
    </div>
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ url('home') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ url('user') }}">Pengguna</a></li>
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
          <h3 class="card-title">Detail Pengguna</h3>
        </div>
        <div class="card-body">
          <p class="">Nama
            <b class="d-block">{{ $user->name }}</b>
          </p>
          <p class="">Email
            <b class="d-block">{{ $user->email }}</b>
          </p>
          <p class="">Jabatan
            @if($user->roles->count())
            <b class="d-block">{{ $user->roles->first()->name }}</b>
            @endif
          </p>
        </div>
        <div class="card-footer clearfix">
          <a class="btn btn-info btn-xs" href="{{ url('user/'.$user->id.'/edit') }}">
            <i class="fa fa-edit"></i> Edit
          </a>
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
