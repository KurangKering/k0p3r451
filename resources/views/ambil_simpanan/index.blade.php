@extends('layouts.template')
@section('title', 'Daftar Pengambilan Simpanan')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Pengambilan Simpanan')
@section('heading-elements')
<button class="btn btn-xs btn-primary" onclick="location.href='{{ route('ambil_simpanan.create') }}'">Tambah</button>
@endsection

@section('content')

<div class="panel panel-flat">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>NIP</th>
						<th>Nama</th>
						<th>Foto</th>
						<th>Tanggal</th>
						<th>Jumlah</th>
						<th width="1%" class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($simpanan as $ambil)
					<tr>
						<td>{{ $ambil->anggota->user->nip }}</td>
						<td>{{ $ambil->anggota->user->name }}</td>
						<td>
							<a href="{{ Storage::url($ambil->anggota->user->foto) ?? '' }}">
								<img src="{{ Storage::url($ambil->anggota->user->foto_small) ?? '' }}" alt="">
								
							</a>
						</td>
						<td>{{ indonesian_date($ambil->tanggal, 'd-m-Y') }}</td>
						<td>{{ rupiah($ambil->jumlah) }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<a href="{{ route('ambil_simpanan.cetak', $ambil->id) }}" class="btn btn-xs btn-info" target="_blank">Cetak</a>
							<a href="{{ route('ambil_simpanan.edit', $ambil->id) }}" class="btn btn-success btn-xs">Edit</a>
							<a onclick="deletePokok({{ $ambil->id }})" class="btn btn-warning btn-xs">Delete</a>
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
	$('table').DataTable({
		order : [],
		});


	function deletePokok(id) {
		swal({
			icon : 'warning',
			title : 'Hapus ?',
			text : 'Yakin Ingin Menghapus Data Ini ?',
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
				axios.post("{{ route('ambil_simpanan.index') }}"+"\/"+id, {
					_token : "{{ csrf_token() }}",
					_method : "DELETE",

				})
				.then(resp => {
					res = resp.data;
					location.href = '{{ request()->url() }}';
				})
			}
		})
	}
</script>
@endsection
