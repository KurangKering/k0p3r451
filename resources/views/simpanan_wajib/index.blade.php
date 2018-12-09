@extends('layouts.template')
@section('title', 'Daftar Simpanan Wajib')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Simpanan Wajib')
@section('heading-elements')
<button class="btn btn-xs btn-primary" onclick="location.href='{{ route('simpanan_wajib.create') }}'">Tambah</button>
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
						<th>Tanggal Bayar</th>
						<th>Jumlah</th>
						<th width="1%" class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($simpanan_wajib as $wajib)
					<tr>
						<td>{{ $wajib->anggota->user->nip }}</td>
						<td>{{ $wajib->anggota->user->name }}</td>
						<td>
							<a href="{{ Storage::url($wajib->anggota->user->foto) ?? '' }}">
								<img src="{{ Storage::url($wajib->anggota->user->foto_small) ?? '' }}" alt="">
								
							</a>
						</td>
						<td>{{ indonesian_date($wajib->tanggal, 'd-m-Y') }}</td>
						<td>{{ rupiah($wajib->jumlah) }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<a target="_blank" href="{{ route('simpanan_wajib.cetak', $wajib->id) }}" class="btn btn-xs btn-info">Cetak</a>
							<a href="{{ route('simpanan_wajib.edit', $wajib->id) }}" class="btn btn-success btn-xs">Edit</a>
							<a onclick="deleteWajib({{ $wajib->id }})" class="btn btn-warning btn-xs">Delete</a>
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
		order : []
	});


	function deleteWajib(id) {
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
				axios.post("{{ route('simpanan_wajib.index') }}"+"\/"+id, {
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
