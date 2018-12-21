@extends('layouts.template')
@section('title', 'Daftar Simpanan Pokok')
@section('custom_css')
<style>
	th,td {
		white-space: nowrap;
	}
</style>
@endsection

@section('header-title', 'Daftar Simpanan Pokok')
@section('heading-elements')

@endsection

@section('content')

<div class="panel panel-flat">
	<div class="panel-body">
		<div class="table-responsive">
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th>Tanggal Bayar</th>
						<th>Bulan</th>
						<th>Tahun</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($simpanan_pokok as $simpanan)
					<tr>
						<td>{{ indonesian_date($simpanan->tanggal, 'd-m-Y') }}</td>
						<td>{{ Config::get('enums.bulan')[$simpanan->bulan] }}</td>
						<td>{{ $simpanan->tahun }}</td>
						<td>{{ rupiah($simpanan->jumlah) }}</td>
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
