<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmbilSimpanan extends Model
{
	protected $table = 'ambil_simpanan';
	protected $fillable = ['tanggal', 'jumlah', 'anggota_id'];


	public function anggota() {
		return $this->belongsTo('App\Anggota');
	}

}
