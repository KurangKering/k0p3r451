@extends('layouts.template')
@section('title', 'Ubah Data Angsuran')
@section('custom_css')

@endsection

@section('header-title', 'Ubah Data Angsuran')
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
 <form class="form-horizontal" action="{{ route('angsuran.update', $angsuran->id) }}" method="POST">
  @csrf
  {{ method_field("PATCH") }}
  {{ Form::hidden('val_sisa', $angsuran->peminjaman->anggota->user->sisa_simpanan) }}
  <div class="form-group">
    <label class="control-label col-lg-2">NIP</label>
    <div class="col-lg-10">
      <div class="input-group">
        {{ Form::text('nip', $angsuran->peminjaman->anggota->user->nip, ['class' => 'form-control', 'readonly' => true]) }}
        
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-lg-2 col-xs-12">Nama</label>
    <div class="col-lg-10">
      {{ Form::text('name', $angsuran->peminjaman->anggota->user->name, ['class' => 'form-control', 'readonly' => true]) }}
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-lg-2">Tanggal Angsuran</label>
    <div class="col-lg-10">
      {{ Form::date('tanggal', $angsuran->tanggal, ['class' => 'form-control']  ) }}

    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Periode Ke</label>
    <div class="col-lg-10">
      {{ Form::text('periode_ke', $angsuran->periode_ke, ['class' => 'form-control', 'readonly' => true]  ) }}

    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Sisa Angsuran</label>
    <div class="col-lg-10">
      {{ Form::text('sisa_simpanan', rupiah($angsuran->peminjaman->sisa_angsuran), ['class' => 'form-control', 'readonly' => true]) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Jumlah Angsuran</label>
    <div class="col-lg-10">
      {{ Form::number('jumlah', $angsuran->jumlah, ['class' => 'form-control']) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Status</label>
    <div class="col-lg-10">
      {{ Form::select('status', Config::get('enums.status_bayar'), $angsuran->peminjaman->status, ['class' => 'form-control']) }}
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
