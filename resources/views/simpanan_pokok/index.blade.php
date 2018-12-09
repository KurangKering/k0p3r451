@extends('layouts.template')
@section('title', 'Daftar Simpanan Pokok')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Simpanan Pokok')
@section('heading-elements')
<button class="btn btn-xs btn-primary" onclick="location.href='{{ route('simpanan_pokok.create') }}'">Tambah</button>
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
						<th>Bulan</th>
						<th>Tahun</th>
						<th>Jumlah</th>
						<th width="1%" class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($simpanan_pokok as $pokok)
					<tr>
						<td>{{ $pokok->anggota->user->nip }}</td>
						<td>{{ $pokok->anggota->user->name }}</td>
						<td>
							<a href="{{ Storage::url($pokok->anggota->user->foto) ?? '' }}">
								<img src="{{ Storage::url($pokok->anggota->user->foto_small) ?? '' }}" alt="">
								
							</a>
						</td>
						<td>{{ indonesian_date($pokok->tanggal, 'd-m-Y') }}</td>
						<td>{{ Config::get('enums.bulan')[$pokok->bulan] }}</td>
						<td>{{ ($pokok->tahun) }}</td>
						<td>{{ rupiah($pokok->jumlah) }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<a target="_blank" href="{{ route('simpanan_pokok.cetak', $pokok->id) }}" class="btn btn-xs btn-info">Cetak</a>
							<a href="{{ route('simpanan_pokok.edit', $pokok->id) }}" class="btn btn-success btn-xs">Edit</a>
							<a onclick="deletePokok({{ $pokok->id }})" class="btn btn-warning btn-xs">Delete</a>
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
				axios.post("{{ route('simpanan_pokok.index') }}"+"\/"+id, {
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
