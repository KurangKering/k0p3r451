@extends('layouts.template')
@section('title', 'Ubah Data Peminjaman')
@section('custom_css')

@endsection

@section('header-title', 'Ubah Data Peminjaman')
@section('heading-elements')

@endsection

@section('content')

<div class="panel panel-default">

 <div class="panel-body">

  @if (count($errors) > 0)
  
  <div class="alert alert-danger">


    <ul>

     @foreach ($errors->all() as $error)

     <li>{{ $error }}</li>

     @endforeach

   </ul>

 </div>

 @endif
 <form class="form-horizontal" action="{{ route('peminjaman.update', $ambil->id) }}" method="POST">
  @csrf
  {{ method_field("PATCH") }}
  {{ Form::hidden('val_sisa', $ambil->anggota->user->sisa_simpanan) }}
  <div class="form-group">
    <label class="control-label col-lg-2">NIP</label>
    <div class="col-lg-10">
      <div class="input-group">
        {{ Form::text('nip', $ambil->anggota->user->nip, ['class' => 'form-control', 'readonly' => true]) }}
        
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-lg-2 col-xs-12">Nama</label>
    <div class="col-lg-10">
      {{ Form::text('name', $ambil->anggota->user->name, ['class' => 'form-control', 'readonly' => true]) }}
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-lg-2">Tanggal Pinjam</label>
    <div class="col-lg-10">
      {{ Form::date('tanggal', $ambil->tanggal, ['class' => 'form-control']  ) }}

    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Jumlah Periode</label>
    <div class="col-lg-10">
      {{ Form::select('periode', Config::get('enums.periode'), $ambil->periode, ['class' => 'form-control', 'readonly' => true]) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Jumlah Pinjam</label>
    <div class="col-lg-10">
      {{ Form::number('jumlah', $ambil->jumlah, ['class' => 'form-control']) }}
    </div>
  </div>


  
  <div class="text-right">
    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
  </div>


</form>

</div>
</div>


@endsection

@section('custom_js')
<script></script>
@endsection
