@extends('layouts.template')
@section('title', 'Laporan')
@section('custom_css')

@endsection

@section('header-title', 'Laporan')
@section('heading-elements')
@endsection

@section('content')

<div class="panel panel-flat col-lg-4 col-lg-offset-4">
	<div class="panel-body">
		<form action="{{ route('laporan.generate_laporan') }}" method="GET" target="_blank">
			
			<div class="form-group">
				<label for="" class="control-label">Jenis Laporan</label>
				{{ Form::select('jenis_laporan', $jenis_laporan, null, ['class' => 'form-control'] ) }}
			</div>
			<div class="form-group">
				<label for="" class="control-label">Bulan</label>
				{{ Form::select('bulan', Config::get('enums.bulan'), date('m'), ['class' => 'form-control'] ) }}
				
			</div>
			<div class="form-group">
				<label for="" class="control-label">Tahun</label>
				{{ Form::select('tahun', $tahun, null, ['class' => 'form-control'] ) }}
				
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
