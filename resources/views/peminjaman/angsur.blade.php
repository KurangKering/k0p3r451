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
			@php
			$jumlah_perbulan = $pinjam->jumlah / $pinjam->periode;
			$bunga = $jumlah_perbulan * 0.1;

			$jumlah_seluruh = $jumlah_perbulan + $bunga;
			@endphp
			{{ Form::hidden('id', $pinjam->id) }}
			{{ Form::hidden('val_sisa', $pinjam->sisa_angsuran) }}
			{{ Form::hidden('periode_ke', (count($pinjam->angsuran) + 1)) }}
			{{ Form::hidden('bunga', $bunga) }}
			{{ Form::hidden('jumlah', $jumlah_perbulan) }}

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
					<p class="form-control-static">{{ (count($pinjam->angsuran) + 1) . " dari " . $pinjam->periode }}</p>
				
				</div>
			</div>


			<div class="form-group">
				<label class="control-label col-lg-2">Angsuran Per Bulan</label>
				<div class="col-lg-10">
					{{ Form::text('', rupiah($pinjam->jumlah / $pinjam->periode), ['class' => 'form-control', 'readonly' => true]) }}
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Bunga 10%</label>
				<div class="col-lg-10">
					{{ Form::text('', rupiah($bunga), ['class' => 'form-control', 'readonly' =>true]) }}
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-lg-2">Jumlah Pembayaran</label>
				<div class="col-lg-10">
					{{ Form::text('', rupiah($jumlah_seluruh), ['class' => 'form-control', 'readonly' => true]) }}
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
