<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Angsuran extends Model
{

	protected $table = 'angsuran';
	protected $fillable = ['jumlah', 'tanggal', 'periode_ke', 'peminjaman_id'];



	public function peminjaman() {
		return $this->belongsTo('App\Peminjaman');
	}
}
