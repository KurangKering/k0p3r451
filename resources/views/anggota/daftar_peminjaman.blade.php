@extends('layouts.template')
@section('title', 'Daftar Peminjaman')
@section('custom_css')
<style>
th,td {
	white-space: nowrap;
}
</style>
@endsection

@section('header-title', 'Daftar Peminjaman')
@section('heading-elements')

@endsection

@section('content')

<div class="panel panel-flat">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Periode</th>
						<th>Status</th>
						<th>Jumlah</th>
						<th>Sisa</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($peminjaman as $pinjam)
					<tr>
						<td>{{ indonesian_date($pinjam->tanggal, 'd-m-Y') }}</td>
						<td>{{ count($pinjam->angsuran) . '/'.$pinjam->periode }}</td>
						<td>{{ Config::get('enums.status_bayar')[$pinjam->status] }}</td>
						<td>{{ rupiah($pinjam->jumlah) }}</td>
						<td>{{ rupiah($pinjam->sisa_angsuran) }}</td>
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
