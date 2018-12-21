@extends('layouts.template')
@section('title', 'Daftar Anggota')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Anggota')
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
						<td style="white-space: nowrap; width: 1%;">
							<a href="{{ route('anggota.show', $anggota->id) }}" class="btn btn-xs btn-info">Detail</a>
							<a class="btn btn-xs btn-warning" onclick="deleteAnggota({{ $anggota->id }})">Delete</a>

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


	function deleteAnggota(id) {
		swal({
			icon : 'warning',
			title : 'Hapus ?',
			text : 'Yakin Ingin Menghapus Anggota Ini ?',
			buttons : {
				tidak : {
					className : 'btn btn-default',
					text : 'Tidak'
				},
				yakin : {
					className : 'btn btn-warning',
					text : 'Yakin'

				}
			}
		})
		.then(clicked => {
			if (clicked == 'yakin') {
				axios.post("{{ route('anggota.hapus') }}", {
					id : id,
					_token : "{{ csrf_token() }}",
					_method : "POST",

				})
				.then(resp => {
					res => resp.data;
					location.href = '{{ request()->url() }}';
				})
			}
		})
	}
</script>
@endsection
