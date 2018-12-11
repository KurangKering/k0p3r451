@extends('layouts.template')
@section('title', 'Daftar Angsuran')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Angsuran')
@section('heading-elements')
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
						<th>Periode Ke</th>
						<th>Jumlah</th>
						<th>Bunga</th>
						<th width="1%" class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($angsuran as $angsur)
					<tr>
						<td>{{ $angsur->peminjaman->anggota->user->nip }}</td>
						<td>{{ $angsur->peminjaman->anggota->user->name }}</td>
						<td>
							<a href="{{ Storage::url($angsur->peminjaman->anggota->user->foto) ?? '' }}">
								<img src="{{ Storage::url($angsur->peminjaman->anggota->user->foto_small) ?? '' }}" alt="">
								
							</a>
						</td>
						<td>{{ indonesian_date($angsur->tanggal, 'd-m-Y') }}</td>
						<td>{{ $angsur->periode_ke }}</td>
						<td>{{ rupiah($angsur->jumlah) }}</td>
						<td>{{ rupiah($angsur->bunga) }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<a target="_blank" href="{{ route('angsuran.cetak', $angsur->id) }}" class="btn btn-xs btn-info">Cetak</a>

							<a href="{{ route('angsuran.edit', $angsur->id) }}" class="btn btn-success btn-xs">Edit</a>
							<a onclick="deleteAngsuran({{ $angsur->id }})" class="btn btn-warning btn-xs">Delete</a>
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


	function deleteAngsuran(id) {
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
				axios.post("{{ route('angsuran.index') }}"+"\/"+id, {
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
