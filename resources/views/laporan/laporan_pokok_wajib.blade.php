<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Laporan Simpanan Pokok dan Wajib</title>
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
	@include('laporan.header')
	<p class="title">SIMPANAN POKOK DAN SIMPANAN WAJIB <br>
		BULAN {{ Config::get('enums.bulan')[$bulan] . " " . $tahun  }}
	</p>

	<table class="table">
		<thead>
			<tr class="">
				<th>No</th>
				<th>Nama</th>
				<th>NIP</th>
				<th>Simpanan Wajib</th>
				<th>Simpanan Pokok</th>
				<th>Tanggal Masuk</th>
				<th>Jumlah Bulan</th>
				<th>Jumlah Simpanan Pokok</th>
				<th>Jumlah Keseluruhan</th>
			</tr>
		</thead>
		<tbody>
			@php
			$no = 1;
			$sumTotalWajib = 0;
			$sumTotalPokok = 0;
			$sumTotalPokok = 0;
			$sumTotalSeluruh = 0;
			@endphp
			@foreach ($anggotas as $anggota)
			@php
			$jumlahPokok = $anggota->simpanan_pokok->sum('jumlah');
			$jumlahSeluruh = $jumlahPokok + ($anggota->simpanan_wajib ? $anggota->simpanan_wajib->jumlah : 0);

			$sumTotalWajib += $anggota->simpanan_wajib ? $anggota->simpanan_wajib->jumlah : 0 ;
			$sumTotalPokok += $anggota->nominal_simpanan_pokok;
			$sumTotalPokok += $anggota->jumlahPokok;
			$sumTotalSeluruh += $jumlahSeluruh;
			@endphp
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $anggota->user->name }}</td>
				<td>{{ $anggota->user->nip }}</td>
				<td>{{ rupiah($anggota->simpanan_wajib ? $anggota->simpanan_wajib->jumlah : 0) }}</td>
				<td>{{ rupiah($anggota->nominal_simpanan_pokok) }}</td>
				<td>{{ indonesian_date($anggota->tanggal_masuk, 'j F Y') }}</td>
				<td>{{ $input_date->diffInMonths($anggota->tanggal_masuk) + 1  }}</td>
				<td>{{ rupiah($jumlahPokok)  }}</td>
				<td>{{ rupiah($jumlahSeluruh) }}</td>
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
			<td>{{ $ketua }}</td>
			<td></td>
			<td>{{ $bendahara }}</td>
		</tr>
	</table>
</body>
</html>