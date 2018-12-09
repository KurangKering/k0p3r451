<html>
<head>
	<title>Cetak Ambil Simpanan Pokok</title>
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
	<h2 class="text-center"><strong>DETAIL PENGAMBILAN SIMPANAN POKOK</strong></h2>
	<table class="table">
		<tr>
			<th>TANGGAL</th>
			<td class=".tipis">:</td>
			<td>{{ indonesian_date($simpanan->tanggal, 'j F Y') }}</td>
		</tr>
		<tr>
			<th>NAMA</th>
			<td width="1%">:</td>
			<td>{{ $simpanan->anggota->user->name }}</td>
		</tr>
		<tr>
			<th>NIP</th>
			<td class=".tipis">:</td>
			<td>{{ $simpanan->anggota->user->nip }}</td>
		</tr>
		<tr>
			<th>JUMLAH SIMPANAN POKOK</th>
			<td class=".tipis">:</td>
			<td>{{ rupiah($simpanan->simpanan_pokok) }}</td>
		</tr>
		<tr>
			<th>JUMLAH AMBIL</th>
			<td class=".tipis">:</td>
			<td>{{ rupiah($simpanan->jumlah) }}</td>
		</tr>
		<tr>
			<th>SISA SIMPANAN POKOK</th>
			<td class=".tipis">:</td>
			<td>{{ rupiah($simpanan->seluruhnya) }}</td>
		</tr>
	</table>
	<p class="text-center">TERIMA KASIH</p>

</body>
</html>