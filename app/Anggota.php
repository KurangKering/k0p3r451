<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
	protected $table = 'anggota';
	protected $fillable = ['nominal_simpanan_pokok','status','user_id', 'tanggal_masuk'];
	protected $dates = ['tanggal_masuk'];
	

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function simpanan_pokok() {
		return $this->hasMany('App\SimpananPokok');
	}

	public function ambil_simpanan() {
		return $this->hasMany('App\AmbilSimpanan');
	}

	public function peminjaman() {
		return $this->hasMany('App\Peminjaman');
	}
	public function simpanan_wajib() {
		return $this->hasOne('App\SimpananWajib');
	}


	public function getFotoSmallAttribute() {

		$fullPath = '';
		if ($this->foto) {
			$pathPhoto = $this->foto;
			$fileName = File::name($pathPhoto);
			$fileExt = File::extension($pathPhoto);
			$dirName = File::dirname($pathPhoto);
			$fullPath = "$dirName/$fileName-small.$fileExt"; 
		}

		return $fullPath;
	}
}
