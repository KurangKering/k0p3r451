@extends('layouts.template')
@section('title', 'Tambah Peminjaman')
@section('custom_css')

@endsection

@section('header-title', 'Tambah Peminjaman')
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
 <form class="form-horizontal" action="{{ route('peminjaman.store') }}" method="POST">
  @csrf
  {{ Form::hidden('id') }}
  <div class="form-group">
    <label class="control-label col-lg-2">NIP</label>
    <div class="col-lg-10">
      <div class="input-group">
        {{ Form::text('nip', null, ['class' => 'form-control', 'readonly' => true]) }}
        <span class="input-group-btn">
          <button class="btn btn-default" data-toggle="modal" data-target="#myModal" id="btn-search" type="button"><i class="icon-search4 text-size-base"></i></button>
        </span>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-lg-2 col-xs-12">Nama</label>
    <div class="col-lg-10">
      {{ Form::text('name', null, ['class' => 'form-control', 'readonly' => true]) }}
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-lg-2">Tanggal Pinjam</label>
    <div class="col-lg-10">
      {{ Form::date('tanggal', date('Y-m-d'), ['class' => 'form-control']  ) }}

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-lg-2">Jumlah Periode</label>
    <div class="col-lg-10">
      {{ Form::select('periode', Config::get('enums.periode'), null, ['class' => 'form-control', 'readonly' => true]) }}
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-lg-2">Jumlah Pinjam</label>
    <div class="col-lg-10">
      {{ Form::number('jumlah', null, ['class' => 'form-control']) }}
    </div>
  </div>

  <div class="text-right">
    <button type="submit" class="btn btn-primary">Submit <i class="icon-arrow-right14 position-right"></i></button>
  </div>


</form>

</div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width:800px">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Data Anggota</h4>
      </div>
      <div class="modal-body">
        <table id="lookup" class="table table-bordered table-hover table-striped">
          <thead>
            <tr>
              <th>NIP</th>
              <th>Nama</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($anggotas as $anggota)
            <tr 
            data-anggota-id="{{ $anggota->id }}" 
            data-nip="{{ $anggota->user->nip }}" 
            data-name="{{ $anggota->user->name }}"
            >
            <td>{{ $anggota->user->nip }}</td>
            <td>{{ $anggota->user->name }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>  
    </div>
  </div>
</div>
</div>

@endsection

@section('custom_js')
<script>
  $(function() {
    
    let $lookup  = $("#lookup");
    let $modal = $("#myModal");


    let dataTable = $lookup.DataTable();


    $lookup.find("tbody").on("click", "tr", function() {
      let id = $(this).data('anggota-id');
      let dataAnggota = dataTable.row(this).data();
      $("input[name=nip]").val(dataAnggota[0]);
      $("input[name=name]").val(dataAnggota[1]);
      $("input[name=id]").val(id);
      $modal.modal('hide');
    });


    

  });
</script>
@endsection
