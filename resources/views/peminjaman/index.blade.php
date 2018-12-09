@extends('layouts.template')
@section('title', 'Daftar Peminjaman')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Peminjaman')
@section('heading-elements')
<button class="btn btn-xs btn-primary" onclick="location.href='{{ route('peminjaman.create') }}'">Tambah</button>
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
						<th>Periode</th>
						<th>Status</th>
						<th>Jumlah</th>
						<th>Sisa</th>
						<th width="1%" class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($pinjaman as $pinjam)
					<tr>
						<td>{{ $pinjam->anggota->user->nip }}</td>
						<td>{{ $pinjam->anggota->user->name }}</td>
						<td>
							<a href="{{ Storage::url($pinjam->anggota->user->foto) ?? '' }}">
								<img src="{{ Storage::url($pinjam->anggota->user->foto_small) ?? '' }}" alt="">
								
							</a>
						</td>
						<td>{{ indonesian_date($pinjam->tanggal, 'd-m-Y') }}</td>
						<td>{{ $pinjam->periode }}</td>
						<td>
							@if ($pinjam->status == '1')
							<label class="badge badge-info">angsur</label>

							@elseif ($pinjam->status == '2')
							<label class="badge badge-success">lunas</label>

							@endif
							

						</td>
						<td>{{ rupiah($pinjam->jumlah) }}</td>
						<td>{{ rupiah($pinjam->sisa_angsuran) }}</td>
						<td style="white-space: nowrap; width: 1%;">
							<a href="{{ route('peminjaman.cetak', $pinjam->id) }}" target="_blank" class="btn btn-xs btn-info">Cetak</a>
							@if ($pinjam->status == '1')
							<a class="btn btn-xs btn-info" onclick="location.href='{{ route('peminjaman.angsur', $pinjam->id) }}'">Angsur</a>
							@endif
							<a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="btn btn-success btn-xs">Edit</a>
							<a onclick="deletePokok({{ $pinjam->id }})" class="btn btn-warning btn-xs">Delete</a>
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
				axios.post("{{ route('peminjaman.index') }}"+"\/"+id, {
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
