@extends('layouts.template')
@section('title', 'Daftar Verifikasi Anggota')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Verifikasi Anggota')
@section('heading-elements')
@endsection

@section('content')

<div class="panel panel-flat">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Nama</th>
						<th>NIP</th>
						<th>Jenis Kelamin</th>
						<th>No Telepon</th>
						<th>Foto</th>
						<th width="1%" class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($anggotas as $anggota)
					<tr>
						<td>{{ $anggota->user->name }}</td>
						<td>{{ $anggota->user->nip }}</td>
					<td>{{ Config::get('enums.jenis_kelamin')[$anggota->user->jenis_kelamin] }}</td>
						<td>{{ $anggota->user->no_telepon }}</td>
						<td>
							<a href="{{ Storage::url($anggota->user->foto) ?? '' }}" data-popup="lightbox">
								
								<img src="{{ Storage::url($anggota->user->foto_small) ?? '' }}" alt="">


							</a>
						</td>
						<td style="white-space: nowrap; width: 1%">
							<a  class="btn btn-info">Detail</a>
							<a  class="btn btn-success" onclick="verifikasi({{ $anggota->id }})">Verifikasi</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection

@section('custom_js')
<script>
	$('table').DataTable();
	

	function verifikasi(id)
	{
		swal({
			icon : 'warning',
			title : 'Verifikasi',
			text : 'Terima Anggota ?',
			closeOnClickOutside : false,
			buttons : {
				batal : {
					className : 'btn btn-info',
					text : 'Batal',
				},
				tolak : {
					className : 'btn btn-danger',
					text : 'Tolak !',
				},
				terima : {
					className : 'btn btn-primary',
					text : 'Terima !',

				}
			},
		})
		.then(clicked => {
			let status = '';
			let msg = '';
			if (clicked == 'tolak') {
				status = '-1';
				msg = 'Berhasil Menolak Anggota ';
			} else if (clicked == 'terima') {
				status = '2';
				msg = 'Berhasil Menerima Anggota ';

			} else {
				return;
			}

			axios.post("{{ route('anggota.verifikasi') }}", {
				id : id,
				status : status,
				_token : '{{ csrf_token() }}',
				_method : 'POST',
			})
			.then(resp => {
				res = resp.data;
				if (res.success) {
					swal.close();
					swal({
						icon : 'success',
						text : msg,
						buttons : false,
						timer : 1000,
						closeOnClickOutside : false,
					})
					.then(t => {
						location.href = '{{ request()->url() }}';
					})
				}
			})
			.then(err => {

			});


		})
	}
</script>
@endsection
