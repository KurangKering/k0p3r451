<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Peminjaman dan Angsuran</title>
	<link rel="stylesheet" href="">

	<link href="{{ asset('templates/material/assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	<head>
		<style type="text/css">
		.text-center {
			text-align: center;
		}

		.title {
			text-align: center;
			font-size: 18px;
			font-weight: bolder;
			text-transform: uppercase;

			letter-spacing: 1px;
			margin-bottom: 35px;
		}
		.table {
			border-spacing: 0;
			border-collapse: collapse;
			width: 100%;
		}
		.table th {
			vertical-align: middle;
			text-align: center;
		}
		table th, table td {
			white-space: nowrap;
			border: 1px solid;
			padding: 5px;
		}

		#table-footer {
			margin-top: 30px;
			margin-left: auto;
			margin-right: auto;
			width: 80%;
		}

		#table-footer tr, #table-footer td {
			border: none;
		}
		.breakNow { page-break-inside:avoid; }


	</style>
</head>
</head>
<body>
	<p class="title">LAPORAN PEMINJAMAN DAN ANGSURAN <br>
		BULAN {{ Config::get('enums.bulan')[$bulan] . " " . $tahun  }}
	</p>

	<table class="table">
		<thead>
			<tr class="">
				<th rowspan="2" width="1%" style="white-space: nowrap">No</th>
				<th rowspan="2">Peminjaman</th>
				<th rowspan="2">Angsuran</th>
				<th rowspan="2">Bunga</th>
				<th rowspan="2">Jumlah</th>
				<th colspan="2">Periode</th>
				<th rowspan="2">Sisa Angsuran</th>
			</tr>
			<tr>
				<th>Ke</th>
				<th>Dari</th>
			</tr>
		</thead>
		
		<tbody>
			@php
			$no = 1;
			@endphp
			@foreach ($angsurans as $angsuran)
			@php
			
			$jumlahAngsuran = $angsuran->bunga + $angsuran->jumlah;
			$sisaAngsuran = $angsuran->peminjaman->jumlah - $angsuran->peminjaman->angsuran->sum('jumlah');

			$sisa_periode = $angsuran->peminjaman->periode - count($angsuran->peminjaman->angsuran->where('id', '<=', $angsuran->id));
			$bunga = $angsuran->bunga;
			$jumlah = $jumlahAngsuran;
			$sisa = $jumlahAngsuran * $sisa_periode;

			@endphp
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ rupiah($angsuran->peminjaman->jumlah) }}</td>
				<td>{{ rupiah($angsuran->jumlah) }}</td>
				<td>{{ rupiah($angsuran->bunga) }}</td>
				<td>{{ rupiah($jumlahAngsuran) }}</td>
				<td>{{ $angsuran->periode_ke }}</td>
				<td>{{ $angsuran->peminjaman->periode }}</td>
				<td>{{ rupiah($sisa) }}</td>
			</tr>
			@endforeach
		</tbody>

	</table>
	
	
	<table id="table-footer" class="breakNow">
		<tr style="">
			<td>Ketua Koperasi</td>
			<td ></td>
			<td>Bendahara</td>
		</tr>
		<tr style="">
			<td>
				<div style="height: 50px">

				</div>
			</td>
			<td></td>
			<td></td>
		</tr>
		<tr>
			<td>Syahrul</td>
			<td></td>
			<td>Epik</td>
		</tr>
	</table>
</body>
</html>