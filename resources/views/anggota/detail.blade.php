@extends('layouts.template')
@section('title', 'Detail Anggota')
@section('custom_css')
<style> 

</style>
@endsection

@section('header-title', 'Detail Anggota')
@section('heading-elements')
@endsection

@section('content')

<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<div class="panel panel-flat">
			<div class="panel-body">
				<form action="" class="form-horizontal">


					<div class="form-group">
						<label class="control-label col-lg-2">Username</label>
						<div class="col-lg-10">
							<div class="form-control-static">{{ $anggota->user->username }}</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-lg-2">Nama</label>
						<div class="col-lg-10">
							<div class="form-control-static">{{ $anggota->user->name }}</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Email</label>
						<div class="col-lg-10">
							<div class="form-control-static">{{ $anggota->user->email }}</div>
						</div>
					</div>


					<div class="form-group">
						<label class="control-label col-lg-2">NIP</label>
						<div class="col-lg-10">
							<div class="form-control-static">{{ $anggota->user->nip }}</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Tanggal Lahir</label>
						<div class="col-lg-10">
							<div class="form-control-static">{{ $anggota->user->tanggal_lahir }}</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Jenis Kelamin</label>
						<div class="col-lg-10">
							<div class="form-control-static">{{ $anggota->user->jenis_kelamin }}</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-lg-2">Alamat</label>
						<div class="col-lg-10">
							<div class="form-control-static">{{ $anggota->user->alamat }}</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">No Telepon</label>
						<div class="col-lg-10">
							<div class="form-control-static">{{ $anggota->user->no_telepon }}</div>
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-lg-2">Foto</label>
						<div class="col-lg-10">
							<img src="{{ Storage::url($anggota->user->foto_small) }}" alt="">

						</div>
					</div>


					


					


				</form>
			</div>
		</div>
	</div>
</div>


@endsection

@section('custom_js')

@endsection
