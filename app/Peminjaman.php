<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
	protected $table = 'peminjaman';
	protected $fillable = ['jumlah', 'tanggal', 'anggota_id', 'periode', 'status'];


	public function anggota() {
		return $this->belongsTo('App\Anggota');
	}

	public function angsuran() {
		return $this->hasMany('App\Angsuran');
	}
}
