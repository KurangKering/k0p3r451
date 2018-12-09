@extends('layouts.template')
@section('title', 'Tambah Angsuran')
@section('custom_css')

@endsection

@section('header-title', 'Tambah Angsuran')
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
		<form class="form-horizontal" action="{{ route('angsuran.store') }}" method="POST">
			@csrf
			{{ Form::hidden('id', $pinjam->id) }}
			{{ Form::hidden('val_sisa', $pinjam->sisa_angsuran) }}
			<div class="form-group">
				<label class="control-label col-lg-2">NIP</label>
				<div class="col-lg-10">
					{{ Form::text('nip', $pinjam->anggota->user->nip, ['class' => 'form-control', 'readonly' => true]) }}
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2 col-xs-12">Nama</label>
				<div class="col-lg-10">
					{{ Form::text('name', $pinjam->anggota->user->name, ['class' => 'form-control', 'readonly' => true]) }}
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Tanggal Angsuran</label>
				<div class="col-lg-10">
					{{ Form::date('tanggal', date('Y-m-d'), ['class' => 'form-control']  ) }}

				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Angsuran Ke</label>
				<div class="col-lg-10">
					@php
					$arr = [];
					for($i = 1 ; $i < ($pinjam->periode + 1) ; $i++) {
						$arr[$i] = $i;
					}
					@endphp
					{{ Form::select('periode_ke', $arr , (count($pinjam->angsuran) + 1), ['class' => 'form-control', 'readonly' => true]  ) }}

				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-lg-2">Sisa Angsuran</label>
				<div class="col-lg-10">
					{{ Form::text('sisa_angsuran', rupiah($pinjam->sisa_angsuran), ['class' => 'form-control', 'readonly' => true]) }}
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Jumlah Angsuran</label>
				<div class="col-lg-10">
					{{ Form::number('jumlah', null, ['class' => 'form-control']) }}
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Status</label>
				<div class="col-lg-10">
					{{ Form::select('status', Config::get('enums.status_bayar'), null, ['class' => 'form-control']) }}
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
	
</script>
@endsection
