@extends('layouts.template')
@section('title', 'Daftar Pengambilan Simpanan')
@section('custom_css')

@endsection

@section('header-title', 'Daftar Pengambilan Simpanan')
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
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($ambil_simpanan as $ambil)
					<tr>
						<td>{{ indonesian_date($ambil->tanggal, 'd-m-Y') }}</td>
						<td>{{ rupiah($ambil->jumlah) }}</td>
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
