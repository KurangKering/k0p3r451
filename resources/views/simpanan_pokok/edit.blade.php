@extends('layouts.template')
@section('title', 'Ubah Simpanan Pokok')
@section('custom_css')

@endsection

@section('header-title', 'Ubah Simpanan Pokok')
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
 <form class="form-horizontal" action="{{ route('simpanan_pokok.update', $simpanan->id) }}" method="POST">
  @csrf
  {{ method_field("PATCH") }}
  {{ Form::hidden('id', $simpanan->anggota_id) }}
  <div class="form-group">
    <label class="control-label col-lg-2">NIP</label>
    <div class="col-lg-10">
      <div class="input-group">
        {{ Form::text('nip', $simpanan->anggota->user->nip, ['class' => 'form-control', 'readonly' => true]) }}
        
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-lg-2 col-xs-12">Nama</label>
    <div class="col-lg-10">
      {{ Form::text('name', $simpanan->anggota->user->name, ['class' => 'form-control', 'readonly' => true]) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2 col-xs-12">Bulan</label>
    <div class="col-lg-2">
      {{ Form::select('bulan', Config::get('enums.bulan'), $simpanan->bulan, ['class' => 'form-control']  ) }}

    </div>
    <label class="control-label col-lg-2 col-xs-12">Tahun</label>
    <div class="col-lg-2">
      {{ Form::text('tahun', $simpanan->tahun , ['class' => 'form-control']  ) }}

    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Tanggal Bayar</label>
    <div class="col-lg-10">
      {{ Form::date('tanggal', $simpanan->tanggal, ['class' => 'form-control']  ) }}

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-lg-2">Jumlah Bayar</label>
    <div class="col-lg-10">
      {{ Form::number('jumlah', $simpanan->jumlah, ['class' => 'form-control']) }}
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
