@extends('layouts.template')
@section('title', 'Daftar Angsuran')
@section('custom_css')
<style>
th,td {
	white-space: nowrap;
}
</style>
@endsection

@section('header-title', 'Daftar Angsuran')
@section('heading-elements')
@endsection

@section('content')

<div class="panel panel-flat">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table datatable-basic " >
				<thead>
					<tr>
						<th>Tanggal</th>
						<th>Peminjaman ID</th>
						<th>Periode Ke</th>
						<th>Jumlah</th>
						<th>Bunga</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach ($angsuran as $angsur)
					<tr>
						<td>{{ indonesian_date($angsur->tanggal, 'd-m-Y') }}</td>
						<td>{{ $angsur->peminjaman->id }}</td>
						<td>{{ $angsur->periode_ke }}</td>
						<td>{{ rupiah($angsur->jumlah) }}</td>
						<td>{{ rupiah($angsur->bunga) }}</td>
						
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
