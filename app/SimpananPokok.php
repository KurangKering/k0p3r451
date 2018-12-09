<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SimpananPokok extends Model
{
	protected $table = 'simpanan_pokok';
	protected $fillable = [
		'jumlah',
		'bulan',
		'tahun',
		'tanggal',
		'anggota_id',
	];

	
	public function anggota() {
		return $this->belongsTo('App\Anggota');
	}
}
