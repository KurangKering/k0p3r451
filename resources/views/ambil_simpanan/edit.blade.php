@extends('layouts.template')
@section('title', 'Ubah Data Pengambilan Simpanan')
@section('custom_css')

@endsection

@section('header-title', 'Ubah Data Pengambilan Simpanan')
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
 <form class="form-horizontal" action="{{ route('ambil_simpanan.update', $ambil->id) }}" method="POST">
  @csrf
  {{ method_field("PATCH") }}
  {{ Form::hidden('val_sisa', $ambil->anggota->sisa_simpanan) }}
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
    <label class="control-label col-lg-2">Tanggal Pengambilan</label>
    <div class="col-lg-10">
      {{ Form::date('tanggal', $ambil->tanggal, ['class' => 'form-control']  ) }}

    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Sisa Simpanan</label>
    <div class="col-lg-10">
      {{ Form::text('sisa_simpanan', rupiah($ambil->anggota->sisa_simpanan), ['class' => 'form-control', 'readonly' => true]) }}
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-2">Jumlah Pengambilan</label>
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
<script>

 $(document).on('click', 'button[type=submit]', function(event) {
  event.preventDefault();
  let $inputJumlah = $("input[name=jumlah]");
  let $inputSisa = $("input[name=val_sisa]");
  if ($inputSisa.val() < $inputJumlah.val())
  {
    console.log($inputSisa.val());
    console.log($inputJumlah.val());
    swal('Gagal, Cek Nominal', {
      buttons : false,
      timer : 1000,
    });
    return;
  } else {
    $('form').submit();

  }
});
</script>
@endsection
