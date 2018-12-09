<html>
<head>
	<title>Cetak Angsuran</title>
	<link href="{{ asset('css/custom_print.css') }}" rel="stylesheet" type="text/css">
	<style>
	th {
		width: 1%;
		white-space: nowrap;
	}

	.tipis {
		width: 1%;
		white-space: nowrap;
	}
	h2 {
		margin-top: 0;
	}
</style>
</head>
<body>
	<h2 class="text-center"><strong>DETAIL ANGSURAN</strong></h2>
	<table class="table">
		<tr>
			<th>TANGGAL</th>
			<td class=".tipis">:</td>
			<td>{{ indonesian_date($angsuran->tanggal, 'j F Y') }}</td>
		</tr>
		<tr>
			<th>NAMA</th>
			<td width="1%">:</td>
			<td>{{ $angsuran->peminjaman->anggota->user->name }}</td>
		</tr>
		<tr>
			<th>NIP</th>
			<td class=".tipis">:</td>
			<td>{{ $angsuran->peminjaman->anggota->user->nip }}</td>
		</tr>
		
		<tr>
			<th>JUMLAH ANGSURAN</th>
			<td class=".tipis">:</td>
			<td>{{ rupiah($angsuran->jumlah) }}</td>
		</tr>
	</table>
	<p class="text-center">TERIMA KASIH</p>

</body>
</html>